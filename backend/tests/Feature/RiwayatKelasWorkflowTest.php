<?php

use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\Role;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Support\Carbon;

function actingAsOperator(): User
{
    $user = User::forceCreate([
        'name' => 'Operator',
        'email' => 'operator@example.test',
        'password' => 'password',
        'is_active' => true,
    ]);

    $role = Role::forceCreate(['name' => 'operator']);
    $user->roles()->attach($role);

    test()->actingAs($user);

    return $user;
}

function createAcademicContext(): array
{
    $tahun = TahunAjaran::forceCreate([
        'tahun' => '2025/2026',
        'is_active' => true,
    ]);

    Semester::forceCreate([
        'tahun_ajaran_id' => $tahun->id,
        'nama' => 'Ganjil',
        'is_active' => true,
    ]);

    $kelasSatu = Kelas::forceCreate([
        'nama_kelas' => 'A',
        'tingkat' => 1,
        'tahun_ajaran_id' => $tahun->id,
    ]);

    $kelasDua = Kelas::forceCreate([
        'nama_kelas' => 'A',
        'tingkat' => 2,
        'tahun_ajaran_id' => $tahun->id,
    ]);

    return [$tahun, $kelasSatu, $kelasDua];
}

function createSiswaInKelas(Kelas $kelas, int $index = 1): Siswa
{
    return Siswa::forceCreate([
        'nis' => 'NIS-' . $index,
        'nisn' => 'NISN-' . $index,
        'nama' => 'Siswa ' . $index,
        'jenis_kelamin' => 'L',
        'kelas_id' => $kelas->id,
        'tingkat' => $kelas->tingkat,
        'status' => 'aktif',
        'tahun_ajaran_id' => $kelas->tahun_ajaran_id,
    ]);
}

it('menutup riwayat aktif lama dan membuat riwayat pindah kelas saat data siswa diupdate', function () {
    Carbon::setTestNow('2026-05-20 10:00:00');
    actingAsOperator();
    [$tahun, $kelasSatu, $kelasDua] = createAcademicContext();
    $siswa = createSiswaInKelas($kelasSatu);

    $riwayatLama = RiwayatKelas::forceCreate([
        'siswa_id' => $siswa->id,
        'kelas_id' => $kelasSatu->id,
        'tahun_ajaran_id' => $tahun->id,
        'semester' => 'Ganjil',
        'nama_kelas_snapshot' => '1 A',
        'tanggal_masuk' => '2026-05-01',
        'jenis_perubahan' => 'masuk_baru',
    ]);

    $this->put(route('operator.dataSiswa.update', $siswa), [
        'nis' => $siswa->nis,
        'nisn' => $siswa->nisn,
        'nama' => $siswa->nama,
        'jenis_kelamin' => 'L',
        'kelas_id' => $kelasDua->id,
        'status' => 'aktif',
        'tahun_ajaran_id' => $tahun->id,
    ])->assertRedirect();

    expect($riwayatLama->fresh()->tanggal_keluar->toDateString())->toBe('2026-05-20');

    $this->assertDatabaseHas('riwayat_kelas', [
        'siswa_id' => $siswa->id,
        'kelas_id' => $kelasDua->id,
        'jenis_perubahan' => 'pindah_kelas',
        'tanggal_masuk' => '2026-05-20 00:00:00',
        'tanggal_keluar' => null,
    ]);
});

it('mencatat mutasi sebagai event terminal satu tanggal', function () {
    actingAsOperator();
    [$tahun, $kelasSatu] = createAcademicContext();
    $siswa = createSiswaInKelas($kelasSatu);

    RiwayatKelas::forceCreate([
        'siswa_id' => $siswa->id,
        'kelas_id' => $kelasSatu->id,
        'tahun_ajaran_id' => $tahun->id,
        'semester' => 'Ganjil',
        'nama_kelas_snapshot' => '1 A',
        'tanggal_masuk' => '2026-05-01',
        'jenis_perubahan' => 'masuk_baru',
    ]);

    $this->put(route('operator.dataSiswa.mutasi', $siswa), [
        'jenis_mutasi' => 'mutasi_keluar',
        'tanggal_keluar' => '2026-05-10',
        'no_surat' => '421/001',
        'alasan_mutasi' => 'Pindah domisili',
        'sekolah_tujuan' => 'MTs Tujuan',
    ])->assertRedirect();

    expect($siswa->fresh()->status)->toBe('pindah');

    $this->assertDatabaseHas('riwayat_kelas', [
        'siswa_id' => $siswa->id,
        'kelas_id' => null,
        'nama_kelas_snapshot' => 'Mutasi Keluar',
        'jenis_perubahan' => 'mutasi_keluar',
        'tanggal_masuk' => '2026-05-10 00:00:00',
        'tanggal_keluar' => '2026-05-10 00:00:00',
    ]);
});

it('menutup event terminal terbuka lalu membuka riwayat masuk kembali', function () {
    actingAsOperator();
    [$tahun, $kelasSatu] = createAcademicContext();
    $siswa = createSiswaInKelas($kelasSatu);
    $siswa->update(['status' => 'pindah', 'kelas_id' => null]);

    $terminal = RiwayatKelas::forceCreate([
        'siswa_id' => $siswa->id,
        'kelas_id' => null,
        'tahun_ajaran_id' => $tahun->id,
        'semester' => 'Ganjil',
        'nama_kelas_snapshot' => 'Mutasi Keluar',
        'tanggal_masuk' => '2026-05-10',
        'tanggal_keluar' => null,
        'jenis_perubahan' => 'mutasi_keluar',
    ]);

    $this->put(route('operator.dataSiswa.reactivate', $siswa), [
        'kelas_id' => $kelasSatu->id,
        'tahun_ajaran_id' => $tahun->id,
        'semester' => 'Ganjil',
        'tanggal_masuk' => '2026-05-20',
    ])->assertRedirect();

    expect($terminal->fresh()->tanggal_keluar->toDateString())->toBe('2026-05-20');

    $this->assertDatabaseHas('riwayat_kelas', [
        'siswa_id' => $siswa->id,
        'kelas_id' => $kelasSatu->id,
        'jenis_perubahan' => 'masuk_kembali',
        'tanggal_masuk' => '2026-05-20 00:00:00',
        'tanggal_keluar' => null,
    ]);
});

it('mencatat riwayat naik kelas tinggal kelas dan lulus dari proses tahunan', function () {
    Carbon::setTestNow('2026-05-20 10:00:00');
    actingAsOperator();
    [$tahun, $kelasSatu, $kelasDua] = createAcademicContext();
    $siswaNaik = createSiswaInKelas($kelasSatu, 1);
    $siswaTinggal = createSiswaInKelas($kelasSatu, 2);
    $siswaLulus = createSiswaInKelas($kelasSatu, 3);

    foreach ([$siswaNaik, $siswaTinggal, $siswaLulus] as $siswa) {
        RiwayatKelas::forceCreate([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelasSatu->id,
            'tahun_ajaran_id' => $tahun->id,
            'semester' => 'Ganjil',
            'nama_kelas_snapshot' => '1 A',
            'tanggal_masuk' => '2026-05-01',
            'jenis_perubahan' => 'masuk_baru',
        ]);
    }

    $this->post(route('operator.tahunAjaran.promote'), [
        'ta_tujuan_id' => $tahun->id,
        'siswa' => [
            ['id' => $siswaNaik->id, 'status' => 'naik', 'rombelTujuan' => $kelasDua->id],
            ['id' => $siswaTinggal->id, 'status' => 'tinggal', 'rombelTujuan' => $kelasSatu->id],
            ['id' => $siswaLulus->id, 'status' => 'lulus', 'rombelTujuan' => '-'],
        ],
    ])->assertOk();

    $this->assertDatabaseHas('riwayat_kelas', ['siswa_id' => $siswaNaik->id, 'jenis_perubahan' => 'naik_kelas']);
    $this->assertDatabaseHas('riwayat_kelas', ['siswa_id' => $siswaTinggal->id, 'jenis_perubahan' => 'turun_kelas']);
    $this->assertDatabaseHas('riwayat_kelas', [
        'siswa_id' => $siswaLulus->id,
        'jenis_perubahan' => 'lulus',
        'tanggal_masuk' => '2026-05-20 00:00:00',
        'tanggal_keluar' => '2026-05-20 00:00:00',
    ]);
});

it('mengembalikan tanggal mentah dan label tanggal untuk modal kartu siswa', function () {
    actingAsOperator();
    [$tahun, $kelasSatu] = createAcademicContext();
    $siswa = createSiswaInKelas($kelasSatu);

    RiwayatKelas::forceCreate([
        'siswa_id' => $siswa->id,
        'kelas_id' => null,
        'tahun_ajaran_id' => $tahun->id,
        'semester' => 'Ganjil',
        'nama_kelas_snapshot' => 'Nonaktif',
        'tanggal_masuk' => '2026-05-10',
        'tanggal_keluar' => '2026-05-10',
        'jenis_perubahan' => 'nonaktif',
    ]);

    $this->getJson(route('operator.dataSiswa.riwayat', $siswa))
        ->assertOk()
        ->assertJsonPath('riwayat.0.jenis_label', 'Nonaktif')
        ->assertJsonPath('riwayat.0.tanggal_masuk', '2026-05-10')
        ->assertJsonPath('riwayat.0.tanggal_keluar', '2026-05-10')
        ->assertJsonPath('riwayat.0.tanggal_masuk_label', '10 May 2026')
        ->assertJsonPath('riwayat.0.tanggal_keluar_label', '10 May 2026');
});
