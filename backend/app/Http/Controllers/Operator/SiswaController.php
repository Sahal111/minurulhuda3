<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\MutasiSiswa;
use App\Services\RiwayatKelasService;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;

class SiswaController extends Controller
{
    public function __construct(private RiwayatKelasService $riwayatKelasService)
    {
    }

    // ─────────────────────────────────────────
    // INDEX
    // ─────────────────────────────────────────
    public function index()
    {
        $q = request('q');
        $kelasId = request('kelas');
        $status = request('status');
        $jenisMasuk = request('jenis_masuk'); // Filter: baru / mutasi / all

        $siswa = Siswa::with([
            'kelas.waliKelas',
            'kelas.tahunAjaran',
            'orangTuas',
            'dataTambahan',
            'programKesejahteraan',
            'perkembangans',
            'mutasis',
            'riwayatKelas' => function ($query) {
                $query->orderBy('tanggal_masuk', 'desc');
            }
        ])
            ->withCount([
                'absensis',
                'absensis as absensis_hadir_count' => function ($query) {
                    $query->where('status', 'hadir');
                },
                'nilais as nilai_valid_count' => function ($query) {
                    $query->whereNotNull('nilai');
                }
            ])
            ->withSum('nilais as total_nilai', 'nilai')
            ->when($q, fn($query) => $query->search($q))
            ->when($kelasId && $kelasId !== 'all', fn($query) => $query->where('kelas_id', $kelasId))
            ->when($jenisMasuk === 'mutasi', fn($query) => 
                $query->whereHas('mutasis', fn($q) => $q->where('jenis_mutasi', 'mutasi_masuk'))
            )
            ->when($jenisMasuk === 'baru', fn($query) => 
                $query->whereDoesntHave('mutasis', fn($q) => $q->where('jenis_mutasi', 'mutasi_masuk'))
            )
            ->when($status && $status !== 'all', fn($query) => $query->where('status', $status))
            ->orderBy('nama')
            ->paginate(20)
            ->appends(request()->only(['q', 'kelas', 'status', 'jenis_masuk']));

        $siswa->getCollection()->transform(function ($s) {
            // Data orang tua (sesuai standar Dapodik: Ayah, Ibu, Wali terpisah)
            $ayah = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ayah')->first();
            $ibu = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ibu')->first();
            $wali = $s->orangTuas->where('pivot.hubungan_keluarga', 'Wali')->first();

            // Data Ayah
            $s->nama_ayah = $ayah?->nama_ayah;
            $s->nik_ayah = $ayah?->nik_ayah;
            $s->tahun_lahir_ayah = $ayah?->tahun_lahir_ayah;
            $s->pendidikan_ayah = $ayah?->pendidikan_ayah;
            $s->pekerjaan_ayah = $ayah?->pekerjaan_ayah;
            $s->penghasilan_ayah = $ayah?->penghasilan_ayah;
            $s->status_ayah = $ayah?->status_ayah;
            $s->kewarganegaraan_ayah = $ayah?->kewarganegaraan_ayah;
            $s->tempat_lahir_ayah = $ayah?->tempat_lahir_ayah;
            $s->no_hp_ayah = $ayah?->no_hp_ayah;

            // Data Ibu
            $s->nama_ibu = $ibu?->nama_ibu;
            $s->nik_ibu = $ibu?->nik_ibu;
            $s->tahun_lahir_ibu = $ibu?->tahun_lahir_ibu;
            $s->pendidikan_ibu = $ibu?->pendidikan_ibu;
            $s->pekerjaan_ibu = $ibu?->pekerjaan_ibu;
            $s->penghasilan_ibu = $ibu?->penghasilan_ibu;
            $s->status_ibu = $ibu?->status_ibu;
            $s->kewarganegaraan_ibu = $ibu?->kewarganegaraan_ibu;
            $s->tempat_lahir_ibu = $ibu?->tempat_lahir_ibu;
            $s->no_hp_ibu = $ibu?->no_hp_ibu;

            // Data Wali
            $s->nama_wali = $wali?->nama_wali;
            $s->nik_wali = $wali?->nik_wali;
            $s->tahun_lahir_wali = $wali?->tahun_lahir_wali;
            $s->pekerjaan_wali = $wali?->pekerjaan_wali;
            $s->pendidikan_wali = $wali?->pendidikan_wali;
            $s->no_hp_wali = $wali?->no_hp_wali;
            $s->alamat_wali = $wali?->alamat_wali;
            $s->penghasilan_wali = $wali?->penghasilan_wali;
            $s->status_wali = $wali?->status_wali;
            $s->kewarganegaraan_wali = $wali?->kewarganegaraan_wali;
            $s->tempat_lahir_wali = $wali?->tempat_lahir_wali;

            // Data kontak orang tua (prioritas: ayah > ibu > wali)
            $s->no_hp_ortu = $ayah?->no_hp ?? $ibu?->no_hp ?? $wali?->no_hp_wali;
            $s->alamat = $ayah?->alamat ?? $ibu?->alamat ?? $wali?->alamat_wali;

            // Dapodik: data tambahan 1-to-1
            $tambahan = $s->dataTambahan;
            $s->kewarganegaraan = $tambahan?->kewarganegaraan;
            $s->no_registrasi_akta_kelahiran = $tambahan?->no_registrasi_akta_kelahiran;
            $s->lintang = $tambahan?->lintang;
            $s->bujur = $tambahan?->bujur;
            $s->kebutuhan_khusus_ayah = $tambahan?->kebutuhan_khusus_ayah;
            $s->kebutuhan_khusus_ibu = $tambahan?->kebutuhan_khusus_ibu;
            $s->hobi = $tambahan?->hobi;
            $s->cita_cita = $tambahan?->cita_cita;
            $s->no_telp_siswa = $tambahan?->no_telp_siswa;
            $s->hp_siswa = $tambahan?->hp_siswa;
            $s->email_siswa = $tambahan?->email_siswa;
            $s->lingkar_kepala = $tambahan?->lingkar_kepala;

            // Dapodik: program kesejahteraan 1-to-1
            $kesejahteraan = $s->programKesejahteraan;
            $s->penerima_kps_pkh = (int) ($kesejahteraan?->penerima_kps_pkh ?? false);
            $s->no_kps_pkh = $kesejahteraan?->no_kps_pkh;
            $s->layak_pip = (int) ($kesejahteraan?->layak_pip ?? false);
            $s->alasan_layak_pip = $kesejahteraan?->alasan_layak_pip;
            $s->penerima_kip = (int) ($kesejahteraan?->penerima_kip ?? false);
            $s->no_kip = $kesejahteraan?->no_kip;
            $s->nama_tertera_di_kip = $kesejahteraan?->nama_tertera_di_kip;

            // Data fisik (mengambil record terakhir)
            $fisik = $s->perkembangans->last();
            $s->tinggi_badan = $fisik?->tinggi_badan;
            $s->berat_badan = $fisik?->berat_badan;
            $s->catatan_kesehatan = $fisik?->catatan_kesehatan;

            // Kelas
            $s->kelas_level = $s->kelas?->tingkat ?? '-';
            $s->kelas_nama = $s->kelas?->nama_kelas ?? '-';

            $s->wali_kelas = $s->kelas?->waliKelas?->nama ?? '-';
            $s->tahun_ajaran = $s->kelas?->tahunAjaran?->tahun ?? '-';

            // Data Mutasi Terakhir (Keluar)
            $mutasiTerakhir = $s->mutasis->last();
            $s->tanggal_keluar = $mutasiTerakhir?->tanggal;
            $s->alasan_mutasi = $mutasiTerakhir?->alasan;
            $s->no_surat_mutasi = $mutasiTerakhir?->no_surat;
            $s->jenis_mutasi_keluar = $mutasiTerakhir?->jenis_label;
            $s->sekolah_tujuan = $mutasiTerakhir?->sekolah_asal_tujuan;

            // Data Mutasi Masuk (untuk siswa pindahan)
            $mutasiMasuk = $s->mutasis->where('jenis_mutasi', 'mutasi_masuk')->first();
            $s->is_mutasi_masuk = $mutasiMasuk ? true : false;
            $s->sekolah_asal_mutasi = $mutasiMasuk?->sekolah_asal_tujuan;
            $s->no_surat_masuk = $mutasiMasuk?->no_surat;
            $s->tanggal_mutasi_masuk = $mutasiMasuk?->tanggal;
            $s->alasan_mutasi_masuk = $mutasiMasuk?->alasan;

            // Kalkulasi Kehadiran (Agregasi SQL via withCount)
            $totalAbsen = $s->absensis_count ?? 0;
            $totalHadir = $s->absensis_hadir_count ?? 0;
            $s->persen_kehadiran = $totalAbsen > 0 ? round(($totalHadir / $totalAbsen) * 100) : 100;

            // Kalkulasi Rata-rata Nilai (Agregasi SQL via withCount & withSum)
            $totalNilaiValid = $s->nilai_valid_count ?? 0;
            $jumlahNilai = $s->total_nilai ?? 0;
            $s->rata_nilai = $totalNilaiValid > 0 ? round($jumlahNilai / $totalNilaiValid, 1) : '-';

            return $s;
        });

        $totalSiswaAktif = Siswa::where('status', 'aktif')->count();

        $stats = [
            'total' => Siswa::count(),
            'aktif' => $totalSiswaAktif,
            'laki' => Siswa::where('status', 'aktif')->where('jenis_kelamin', 'L')->count(),
            'perempuan' => Siswa::where('status', 'aktif')->where('jenis_kelamin', 'P')->count(),
            'lulus' => Siswa::where('status', 'lulus')->count(),
            'pindah' => Siswa::where('status', 'pindah')->count(),
        ];

        $kelas = Kelas::with('waliKelas')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        $tahunAjarans = TahunAjaran::orderByDesc('tahun')->get();

        $userSiswa = \App\Models\User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['siswa', 'ortu']);
        })->orWhereDoesntHave('roles')->orderBy('name')->get(['id', 'name', 'email']);

        return response()->json(compact('siswa', 'kelas', 'totalSiswaAktif', 'stats', 'tahunAjarans', 'userSiswa'));
    }

    // ─────────────────────────────────────────
    // SHOW  (GET /data-siswa/{id}/show)
    // ─────────────────────────────────────────
    public function show($id)
    {
        $siswa = Siswa::with([
            'kelas.waliKelas',
            'kelas.tahunAjaran',
            'orangTuas',
            'dataTambahan',
            'programKesejahteraan',
            'perkembangans',
            'mutasis',
            'riwayatKelas' => function ($query) {
                $query->orderBy('tanggal_masuk', 'desc');
            }
        ])
            ->withCount([
                'absensis',
                'absensis as absensis_hadir_count' => function ($query) {
                    $query->where('status', 'hadir');
                },
                'nilais as nilai_valid_count' => function ($query) {
                    $query->whereNotNull('nilai');
                }
            ])
            ->withSum('nilais as total_nilai', 'nilai')
            ->findOrFail($id);

        $ayah = $siswa->orangTuas->where('pivot.hubungan_keluarga', 'Ayah')->first();
        $ibu = $siswa->orangTuas->where('pivot.hubungan_keluarga', 'Ibu')->first();
        $wali = $siswa->orangTuas->where('pivot.hubungan_keluarga', 'Wali')->first();

        $siswa->nama_ayah = $ayah?->nama_ayah;
        $siswa->nik_ayah = $ayah?->nik_ayah;
        $siswa->tahun_lahir_ayah = $ayah?->tahun_lahir_ayah;
        $siswa->pendidikan_ayah = $ayah?->pendidikan_ayah;
        $siswa->pekerjaan_ayah = $ayah?->pekerjaan_ayah;
        $siswa->penghasilan_ayah = $ayah?->penghasilan_ayah;
        $siswa->status_ayah = $ayah?->status_ayah;
        $siswa->kewarganegaraan_ayah = $ayah?->kewarganegaraan_ayah;
        $siswa->tempat_lahir_ayah = $ayah?->tempat_lahir_ayah;
        $siswa->no_hp_ayah = $ayah?->no_hp_ayah;
        $siswa->nama_ibu = $ibu?->nama_ibu;
        $siswa->nik_ibu = $ibu?->nik_ibu;
        $siswa->tahun_lahir_ibu = $ibu?->tahun_lahir_ibu;
        $siswa->pendidikan_ibu = $ibu?->pendidikan_ibu;
        $siswa->pekerjaan_ibu = $ibu?->pekerjaan_ibu;
        $siswa->penghasilan_ibu = $ibu?->penghasilan_ibu;
        $siswa->status_ibu = $ibu?->status_ibu;
        $siswa->kewarganegaraan_ibu = $ibu?->kewarganegaraan_ibu;
        $siswa->tempat_lahir_ibu = $ibu?->tempat_lahir_ibu;
        $siswa->no_hp_ibu = $ibu?->no_hp_ibu;
        $siswa->nama_wali = $wali?->nama_wali;
        $siswa->nik_wali = $wali?->nik_wali;
        $siswa->tahun_lahir_wali = $wali?->tahun_lahir_wali;
        $siswa->pekerjaan_wali = $wali?->pekerjaan_wali;
        $siswa->pendidikan_wali = $wali?->pendidikan_wali;
        $siswa->no_hp_wali = $wali?->no_hp_wali;
        $siswa->alamat_wali = $wali?->alamat_wali;
        $siswa->penghasilan_wali = $wali?->penghasilan_wali;
        $siswa->status_wali = $wali?->status_wali;
        $siswa->kewarganegaraan_wali = $wali?->kewarganegaraan_wali;
        $siswa->tempat_lahir_wali = $wali?->tempat_lahir_wali;
        $siswa->no_hp_ortu = $ayah?->no_hp ?? $ibu?->no_hp ?? $wali?->no_hp_wali;
        $siswa->alamat = $ayah?->alamat ?? $ibu?->alamat ?? $wali?->alamat_wali;

        $tambahan = $siswa->dataTambahan;
        $siswa->kewarganegaraan = $tambahan?->kewarganegaraan;
        $siswa->no_registrasi_akta_kelahiran = $tambahan?->no_registrasi_akta_kelahiran;
        $siswa->lintang = $tambahan?->lintang;
        $siswa->bujur = $tambahan?->bujur;
        $siswa->kebutuhan_khusus_ayah = $tambahan?->kebutuhan_khusus_ayah;
        $siswa->kebutuhan_khusus_ibu = $tambahan?->kebutuhan_khusus_ibu;
        $siswa->hobi = $tambahan?->hobi;
        $siswa->cita_cita = $tambahan?->cita_cita;
        $siswa->no_telp_siswa = $tambahan?->no_telp_siswa;
        $siswa->hp_siswa = $tambahan?->hp_siswa;
        $siswa->email_siswa = $tambahan?->email_siswa;
        $siswa->lingkar_kepala = $tambahan?->lingkar_kepala;

        $kesejahteraan = $siswa->programKesejahteraan;
        $siswa->penerima_kps_pkh = (int) ($kesejahteraan?->penerima_kps_pkh ?? false);
        $siswa->no_kps_pkh = $kesejahteraan?->no_kps_pkh;
        $siswa->layak_pip = (int) ($kesejahteraan?->layak_pip ?? false);
        $siswa->alasan_layak_pip = $kesejahteraan?->alasan_layak_pip;
        $siswa->penerima_kip = (int) ($kesejahteraan?->penerima_kip ?? false);
        $siswa->no_kip = $kesejahteraan?->no_kip;
        $siswa->nama_tertera_di_kip = $kesejahteraan?->nama_tertera_di_kip;

        $fisik = $siswa->perkembangans->last();
        $siswa->tinggi_badan = $fisik?->tinggi_badan;
        $siswa->berat_badan = $fisik?->berat_badan;
        $siswa->catatan_kesehatan = $fisik?->catatan_kesehatan;

        $siswa->kelas_level = $siswa->kelas?->tingkat ?? '-';
        $siswa->kelas_nama = $siswa->kelas?->nama_kelas ?? '-';
        $siswa->wali_kelas = $siswa->kelas?->waliKelas?->nama ?? '-';
        $siswa->tahun_ajaran = $siswa->kelas?->tahunAjaran?->tahun ?? '-';

        $mutasiTerakhir = $siswa->mutasis->last();
        $siswa->tanggal_keluar = $mutasiTerakhir?->tanggal;
        $siswa->alasan_mutasi = $mutasiTerakhir?->alasan;
        $siswa->no_surat_mutasi = $mutasiTerakhir?->no_surat;
        $siswa->jenis_mutasi_keluar = $mutasiTerakhir?->jenis_label;
        $siswa->sekolah_tujuan = $mutasiTerakhir?->sekolah_asal_tujuan;

        $mutasiMasuk = $siswa->mutasis->where('jenis_mutasi', 'mutasi_masuk')->first();
        $siswa->is_mutasi_masuk = $mutasiMasuk ? true : false;
        $siswa->sekolah_asal_mutasi = $mutasiMasuk?->sekolah_asal_tujuan;
        $siswa->no_surat_masuk = $mutasiMasuk?->no_surat;
        $siswa->tanggal_mutasi_masuk = $mutasiMasuk?->tanggal;
        $siswa->alasan_mutasi_masuk = $mutasiMasuk?->alasan;

        $totalAbsen = $siswa->absensis_count ?? 0;
        $totalHadir = $siswa->absensis_hadir_count ?? 0;
        $siswa->persen_kehadiran = $totalAbsen > 0 ? round(($totalHadir / $totalAbsen) * 100) : 100;

        $totalNilaiValid = $siswa->nilai_valid_count ?? 0;
        $jumlahNilai = $siswa->total_nilai ?? 0;
        $siswa->rata_nilai = $totalNilaiValid > 0 ? round($jumlahNilai / $totalNilaiValid, 1) : '-';

        return response()->json(['siswa' => $siswa]);
    }

    // ─────────────────────────────────────────
    // STORE  (POST /data-siswa/store)
    // ─────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate($this->siswaValidationRules(null, true));

        // ── FIX BUG-01 & BUG-02: Upload foto dilakukan DALAM transaksi ──────────
        // Jika DB::transaction gagal, file foto yang sudah terbuat akan dihapus
        // secara manual agar tidak menjadi orphan di storage.
        // Variabel berkas juga dipisah menjadi $berkasPath agar tidak
        // menimpa $fotoPath yang dibuat di awal closure.
        DB::transaction(function () use ($request) {
            // Ambil tingkat dari kelas yang dipilih (satu query, dipakai dua kali)
            $kelasObj = $request->kelas_id ? Kelas::find($request->kelas_id) : null;
            $tingkat = $kelasObj?->tingkat ?? 1;

            // Upload foto di DALAM transaksi — jika DB gagal, hapus file via catch
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
            }

            try {
                $asal_sekolah_gabungan = $request->asal_sekolah;
                if ($request->npsn_asal) {
                    $asal_sekolah_gabungan .= ' (NPSN: ' . $request->npsn_asal . ')';
                }

                $siswa = Siswa::create([
                    'user_id' => $request->user_id,
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'nama' => $request->nama,
                    'tingkat' => $tingkat,
                    'nik' => $request->nik,
                    'no_kk' => $request->no_kk,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'kelas_id' => $request->kelas_id,
                    'status' => $request->status ?? 'aktif',
                    'foto' => $fotoPath,
                    'agama' => $request->agama,
                    'golongan_darah' => $request->golongan_darah,
                    'riwayat_penyakit' => $request->riwayat_penyakit,
                    'kebutuhan_khusus' => $request->kebutuhan_khusus,
                    'asal_sekolah' => $asal_sekolah_gabungan,
                    'tanggal_masuk' => $request->tanggal_masuk ?? now(),
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    // Dapodik: Alamat & Domisili
                    'alamat_siswa' => $request->alamat_siswa,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kode_pos' => $request->kode_pos,
                    // Dapodik: Data Keluarga
                    'anak_ke' => $request->anak_ke,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    // Dapodik: Data Periodik / Geografis
                    'jarak_tempat_tinggal' => $request->jarak_tempat_tinggal,
                    'waktu_tempuh' => $request->waktu_tempuh,
                    'moda_transportasi' => $request->moda_transportasi,
                    'kelas_pararel' => $request->kelas_pararel,
                    'no_absen' => $request->no_absen,
                    'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
                    'pembiaya_sekolah' => $request->pembiaya_sekolah,
                    'imunisasi' => $request->imunisasi,
                ]);

                $siswa->dataTambahan()->create($this->dataTambahanPayload($request));
                $siswa->programKesejahteraan()->create($this->programKesejahteraanPayload($request));

                // Handle Orang Tua & Pivot (Sesuai Standar Dapodik: Ayah, Ibu, Wali terpisah)
                // Minimal salah satu orang tua atau wali terisi
                if ($request->nama_ayah || $request->nama_ibu || $request->nama_wali) {
                    $this->handleOrangTuaRelation($siswa, $request);
                }

                // Handle Perkembangan Siswa (Validasi Tahun Ajaran)
                if ($request->tinggi_badan || $request->berat_badan || $request->catatan_kesehatan) {
                    // Ambil tahun ajaran yang dipilih atau fallback ke tahun ajaran aktif
                    $tahunAjaranId = $request->tahun_ajaran_id
                        ?? TahunAjaran::where('is_active', true)->value('id');

                    // Jika masih null, ambil tahun ajaran terbaru
                    if (!$tahunAjaranId) {
                        $tahunAjaranId = TahunAjaran::orderByDesc('tahun')->value('id');
                    }

                    // Cari semester dengan tahun ajaran yang valid
                    $semester = Semester::where('tahun_ajaran_id', $tahunAjaranId)
                        ->where('is_active', true)
                        ->value('nama') ?? 'Ganjil';

                    $siswa->perkembangans()->create([
                        'tahun_ajaran_id' => $tahunAjaranId,
                        'semester' => $semester,
                        'tinggi_badan' => $request->tinggi_badan,
                        'berat_badan' => $request->berat_badan,
                        'catatan_kesehatan' => $request->catatan_kesehatan,
                    ]);
                }

                if ($kelasObj) {
                    RiwayatKelas::create([
                        'siswa_id' => $siswa->id,
                        'kelas_id' => $kelasObj->id,
                        'tahun_ajaran_id' => $request->tahun_ajaran_id,
                        'semester' => Semester::where('tahun_ajaran_id', $request->tahun_ajaran_id)->where('is_active', true)->value('nama') ?? 'Ganjil',
                        'nama_kelas_snapshot' => $kelasObj->full_name,
                        'tanggal_masuk' => now(),
                        'jenis_perubahan' => $request->jenis_pendaftaran === 'pindahan' ? 'mutasi_masuk' : 'masuk_baru',
                        'catatan' => $request->jenis_pendaftaran === 'pindahan' ? 'Mutasi masuk dari ' . $asal_sekolah_gabungan : 'Pendaftaran siswa baru',
                    ]);
                }

                // Jika Mutasi Masuk, rekam ke tabel MutasiSiswa
                if ($request->jenis_pendaftaran === 'pindahan') {
                    \App\Models\MutasiSiswa::create([
                        'siswa_id' => $siswa->id,
                        'jenis_mutasi' => 'mutasi_masuk', // Asumsikan mutasi_masuk ada di schema (atau 'masuk')
                        'sekolah_asal_tujuan' => $asal_sekolah_gabungan,
                        'no_surat' => $request->no_surat_mutasi,
                        'tanggal' => $request->tanggal_masuk ?? now(),
                        'alasan' => $request->alasan_mutasi,
                    ]);
                }

                // Handle Berkas Uploads
                // FIX BUG-02: gunakan $berkasPath agar tidak menimpa $fotoPath di atas
                $berkasFields = [
                    'berkas_kk'     => 'kartu_keluarga',
                    'berkas_akte'   => 'akte_kelahiran',
                    'berkas_ijazah' => 'ijazah_sebelumnya',
                    'berkas_surat_mutasi' => 'surat_mutasi',
                    'berkas_rapor_asal'   => 'rapor_sekolah_asal',
                ];

                foreach ($berkasFields as $inputName => $jenisBerkas) {
                    if ($request->hasFile($inputName)) {
                        $file = $request->file($inputName);
                        $berkasPath = $file->store('berkas_siswa', 'local'); // Simpan di private storage

                        \App\Models\BerkasSiswa::create([
                            'siswa_id'        => $siswa->id,
                            'jenis_berkas'    => $jenisBerkas,
                            'nama_file_asli'  => $file->getClientOriginalName(),
                            'nama_file_sistem' => basename($berkasPath),
                            'path_file'       => $berkasPath,
                            'ekstensi'        => $file->getClientOriginalExtension(),
                            'ukuran_file'     => $file->getSize(),
                            'created_by'      => auth()->id() ?? $request->user_id,
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                // Rollback fisik: hapus foto yang sudah terlanjur terupload
                // agar tidak menjadi file orphan di storage
                if ($fotoPath) {
                    Storage::disk('public')->delete($fotoPath);
                }
                throw $e; // Lempar ulang agar DB::transaction melakukan rollback database
            }
        });

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil ditambahkan.'], 201);
    }

    // ─────────────────────────────────────────
    // UPDATE  (PUT /data-siswa/{id})
    // ─────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate($this->siswaValidationRules($id, false));

        $data = [
            'user_id' => $request->user_id,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status ?? 'aktif',
            'agama' => $request->agama,
            'golongan_darah' => $request->golongan_darah,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'kebutuhan_khusus' => $request->kebutuhan_khusus,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'asal_sekolah' => $request->npsn_asal
                ? ($request->asal_sekolah . ' (NPSN: ' . $request->npsn_asal . ')')
                : $request->asal_sekolah,
            'tanggal_masuk' => $request->tanggal_masuk,
            // Dapodik: Alamat & Domisili
            'alamat_siswa' => $request->alamat_siswa,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            // Dapodik: Data Keluarga
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            // Dapodik: Data Periodik / Geografis
            'jarak_tempat_tinggal' => $request->jarak_tempat_tinggal,
            'waktu_tempuh' => $request->waktu_tempuh,
            'moda_transportasi' => $request->moda_transportasi,
            'kelas_pararel' => $request->kelas_pararel,
            'no_absen' => $request->no_absen,
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'pembiaya_sekolah' => $request->pembiaya_sekolah,
            'imunisasi' => $request->imunisasi,
        ];

        $oldFoto = $siswa->foto; // Simpan path foto lama SEBELUM transaksi

        // ── FIX BUG-01 & BUG-02: Upload foto baru dilakukan DALAM transaksi ──────
        // Jika DB gagal, foto baru yang sudah terbuat akan dihapus (rollback fisik).
        // Foto lama dihapus SETELAH transaksi sukses agar tidak kehilangan foto
        // jika transaksi gagal di tengah jalan.
        DB::transaction(function () use ($request, $siswa, &$data, $oldFoto) {
            // Upload foto baru di DALAM transaksi
            if ($request->hasFile('foto')) {
                $newFotoPath = $request->file('foto')->store('foto_siswa', 'public');
                $data['foto'] = $newFotoPath;
            }

            try {
                // Cek jika pindah kelas via edit (termasuk dikosongkan)
                if ($request->has('kelas_id') && $request->kelas_id != $siswa->kelas_id) {
                    if ($request->kelas_id) {
                        $kelasObj = Kelas::find($request->kelas_id);
                        $this->riwayatKelasService->recordClassMove(
                            $siswa,
                            $kelasObj,
                            $request->tahun_ajaran_id,
                            now(),
                            'Perpindahan kelas via edit data'
                        );
                        $data['kelas_id'] = $request->kelas_id;
                        $data['tingkat'] = $kelasObj->tingkat;
                    } else {
                        $this->riwayatKelasService->closeLatestOpenHistory($siswa, now());
                        $data['kelas_id'] = null;
                        // Jika kelas dikosongkan, biarkan tingkat sebelumnya atau biarkan null (tergantung schema)
                        // Lebih aman tidak mengubah tingkat jika tidak ada referensi baru
                    }
                } elseif ($request->has('kelas_id') && $request->kelas_id && $siswa->kelas_id == $request->kelas_id) {
                    // Kelas tidak berubah, tapi pastikan tingkat tetap sinkron dengan database Kelas master
                    $kelasObj = Kelas::find($request->kelas_id);
                    $data['tingkat'] = $kelasObj?->tingkat ?? $siswa->tingkat;
                }

                $siswa->update($data);
                $siswa->dataTambahan()->updateOrCreate(
                    ['siswa_id' => $siswa->id],
                    $this->dataTambahanPayload($request)
                );
                $siswa->programKesejahteraan()->updateOrCreate(
                    ['siswa_id' => $siswa->id],
                    $this->programKesejahteraanPayload($request)
                );

                // Handle Orang Tua & Pivot
                if ($request->nama_ayah || $request->nama_ibu || $request->nama_wali) {
                    $this->handleOrangTuaRelationUpdate($siswa, $request);
                }

                // Handle Perkembangan Siswa (Validasi Tahun Ajaran)
                if ($request->tinggi_badan || $request->berat_badan || $request->catatan_kesehatan) {
                    // Ambil tahun ajaran yang dipilih atau fallback ke tahun ajaran aktif
                    $tahunAjaranId = $request->tahun_ajaran_id
                        ?? TahunAjaran::where('is_active', true)->value('id');

                    // Jika masih null, ambil tahun ajaran terbaru
                    if (!$tahunAjaranId) {
                        $tahunAjaranId = TahunAjaran::orderByDesc('tahun')->value('id');
                    }

                    // Cari semester dengan tahun ajaran yang valid
                    $semester = Semester::where('tahun_ajaran_id', $tahunAjaranId)
                        ->where('is_active', true)
                        ->value('nama') ?? 'Ganjil';

                    $siswa->perkembangans()->updateOrCreate(
                        [
                            'tahun_ajaran_id' => $tahunAjaranId,
                            'semester' => $semester,
                        ],
                        [
                            'tinggi_badan' => $request->tinggi_badan,
                            'berat_badan' => $request->berat_badan,
                            'catatan_kesehatan' => $request->catatan_kesehatan,
                        ]
                    );
                }

                // Handle Berkas Uploads
                // FIX BUG-02: gunakan $berkasPath agar tidak menimpa path foto di atas
                $berkasFields = [
                    'berkas_kk'     => 'kartu_keluarga',
                    'berkas_akte'   => 'akte_kelahiran',
                    'berkas_ijazah' => 'ijazah_sebelumnya',
                ];

                foreach ($berkasFields as $inputName => $jenisBerkas) {
                    if ($request->hasFile($inputName)) {
                        $file = $request->file($inputName);

                        // Cek apakah berkas dengan jenis ini sudah ada untuk siswa ini
                        $existingBerkas = \App\Models\BerkasSiswa::where('siswa_id', $siswa->id)
                            ->where('jenis_berkas', $jenisBerkas)
                            ->first();

                        if ($existingBerkas && $existingBerkas->path_file) {
                            \Illuminate\Support\Facades\Storage::disk('local')->delete($existingBerkas->path_file);
                        }

                        $berkasPath = $file->store('berkas_siswa', 'local'); // Simpan di private storage

                        \App\Models\BerkasSiswa::updateOrCreate(
                            [
                                'siswa_id'    => $siswa->id,
                                'jenis_berkas' => $jenisBerkas,
                            ],
                            [
                                'nama_file_asli'   => $file->getClientOriginalName(),
                                'nama_file_sistem' => basename($berkasPath),
                                'path_file'        => $berkasPath,
                                'ekstensi'         => $file->getClientOriginalExtension(),
                                'ukuran_file'      => $file->getSize(),
                                'updated_by'       => auth()->id() ?? $request->user_id,
                            ]
                        );
                    }
                }
            } catch (\Throwable $e) {
                // Rollback fisik: hapus foto BARU yang sudah terlanjur terupload
                // agar tidak menjadi file orphan di storage.
                // Foto LAMA dibiarkan tetap ada karena DB belum berubah.
                if (isset($newFotoPath)) {
                    Storage::disk('public')->delete($newFotoPath);
                }
                throw $e; // Lempar ulang agar DB::transaction melakukan rollback database
            }
        });

        // Hapus foto LAMA hanya setelah transaksi DB berhasil sepenuhnya
        if ($request->hasFile('foto') && $oldFoto) {
            Storage::disk('public')->delete($oldFoto);
        }

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil diperbarui.']);
    }

    // ─────────────────────────────────────────
    // DESTROY  (DELETE /data-siswa/{id})
    // ─────────────────────────────────────────
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete(); // Soft delete — cascade via boot() di Model Siswa

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil dihapus dan dipindahkan ke Recycle Bin.']);
    }

    // ─────────────────────────────────────────
    // TRASH, RESTORE, FORCE DELETE (RECYCLE BIN)
    // ─────────────────────────────────────────
    public function trash(Request $request)
    {
        $siswa = Siswa::onlyTrashed()
            ->with('kelas')
            ->latest('deleted_at')
            ->paginate(10);

        return response()->json([
            'siswa' => [
                'data' => $siswa->map(fn($s) => [
                    'id' => $s->id,
                    'nama' => $s->nama,
                    'foto' => $s->foto,
                    'nis' => $s->nis,
                    'nisn' => $s->nisn,
                    'kelas' => $s->kelas?->full_name ? 'Kelas ' . $s->kelas->full_name : 'Belum ada',
                    'deleted_at' => $s->deleted_at->format('d M Y, H:i'),
                ]),
                'total' => $siswa->total(),
                'current_page' => $siswa->currentPage(),
                'last_page' => $siswa->lastPage(),
                'from' => $siswa->firstItem(),
                'to' => $siswa->lastItem(),
            ]
        ]);
    }

    public function restore($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $siswa->restore(); // will cascade via boot method in model

        return response()->json([
            'success' => true,
            'message' => "Data siswa {$siswa->nama} berhasil dipulihkan."
        ]);
    }

    public function forceDelete($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $nama = $siswa->nama;
        $siswa->forceDelete(); // will cascade via boot method in model

        return response()->json([
            'success' => true,
            'message' => "Data siswa {$nama} dihapus permanen."
        ]);
    }

    // ─────────────────────────────────────────
    // EXPORT GABUNGAN  (GET /data-siswa/export)
    //
    // Query param  ?mode=zip  → ZIP berisi Excel + folder foto/
    // Query param  ?mode=pdf  → PDF kartu identitas semua siswa
    // (default)   ?mode=zip
    // ─────────────────────────────────────────
    public function exportData(Request $request)
    {
        $mode = $request->get('mode', 'zip');
        $status = $request->get('status', 'all');
        $kelas = $request->get('kelas');
        $kelasId = ($kelas && $kelas !== 'all' && is_numeric($kelas)) ? (int) $kelas : null;
        $keyword = $request->get('q', '');

        return match ($mode) {
            'pdf' => $this->exportPdf($status, $kelasId, $keyword),
            default => $this->exportZip($status, $kelasId, $keyword),
        };
    }

    // ─────────────────────────────────────────
    // EXPORT ZIP  (Excel + folder foto/)
    // ─────────────────────────────────────────
    private function exportZip(string $status, ?int $kelasId, string $keyword)
    {
        // 1. Buat file Excel sementara via Excel::raw()
        $excelTmp = tempnam(sys_get_temp_dir(), 'siakad_excel_') . '.xlsx';
        $excelContent = Excel::raw(
            new SiswaExport($status, $kelasId, $keyword),
            \Maatwebsite\Excel\Excel::XLSX
        );
        file_put_contents($excelTmp, $excelContent);

        // 2. Kumpulkan siswa yang akan di-export
        $siswas = Siswa::with(['kelas', 'orangTuas'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->when($kelasId, fn($q) => $q->where('kelas_id', $kelasId))
            ->when($keyword, fn($q) => $q->search($keyword))
            ->orderBy('nama')
            ->get();

        // 3. Buat ZIP
        $zipTmp = tempnam(sys_get_temp_dir(), 'siakad_zip_') . '.zip';
        $tanggal = now()->format('Ymd-His');
        $namaZip = "export-siswa-{$tanggal}.zip";

        $zip = new ZipArchive();
        if ($zip->open($zipTmp, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat file ZIP.');
        }

        // Masukkan Excel
        $zip->addFile($excelTmp, 'data_siswa.xlsx');

        // Masukkan foto ke subfolder foto/
        $fotoCount = 0;
        foreach ($siswas as $s) {
            if (!$s->foto)
                continue;

            $storagePath = storage_path('app/public/' . $s->foto);
            if (!file_exists($storagePath))
                continue;

            $ext = pathinfo($s->foto, PATHINFO_EXTENSION);
            $namaFile = ($s->nisn ?: $s->nis) . '.' . $ext;
            $zip->addFile($storagePath, 'foto/' . $namaFile);
            $fotoCount++;
        }

        // README singkat agar operator paham struktur ZIP
        $readme = $this->buildReadme($siswas->count(), $fotoCount, $tanggal);
        $zip->addFromString('README.txt', $readme);

        $zip->close();

        // Hapus file Excel sementara
        @unlink($excelTmp);

        // 4. Stream ZIP ke browser lalu hapus file sementara
        return response()->download($zipTmp, $namaZip, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    // ─────────────────────────────────────────
    // EXPORT PDF  (kartu identitas semua siswa)
    // ─────────────────────────────────────────
    private function exportPdf(string $status, ?int $kelasId, string $keyword)
    {
        $siswas = Siswa::with(['kelas.waliKelas', 'orangTuas'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->when($kelasId, fn($q) => $q->where('kelas_id', $kelasId))
            ->when($keyword, fn($q) => $q->search($keyword))
            ->orderBy('nama')
            ->get();

        if ($siswas->isEmpty()) {
            return redirect()->back()->with('warning', 'Tidak ada data siswa untuk di-export.');
        }

        $pdf = Pdf::loadView('operator.pdf.kartu-siswa', compact('siswas'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isPhpEnabled' => false,
                'chroot' => storage_path('app/public'),
                'dpi' => 150,
            ]);

        $tanggal = now()->format('Ymd-His');
        $filename = "kartu-identitas-siswa-{$tanggal}.pdf";

        return $pdf->download($filename);
    }

    // ─────────────────────────────────────────
    // EXPORT PDF SATU SISWA  (GET /data-siswa/{id}/pdf)
    // ─────────────────────────────────────────
    public function exportPdfSatu($id)
    {
        $siswa = Siswa::with(['kelas.waliKelas', 'orangTuas'])->findOrFail($id);
        $siswas = collect([$siswa]);

        $pdf = Pdf::loadView('operator.pdf.kartu-siswa', compact('siswas'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isPhpEnabled' => false,
                'chroot' => storage_path('app/public'),
                'dpi' => 150,
            ]);

        $namaFile = Str::slug($siswa->nama) . '-' . ($siswa->nisn ?? $siswa->nis) . '.pdf';

        return $pdf->download($namaFile);
    }

    // ─────────────────────────────────────────
    // EXPORT TEMPLATE EXCEL
    // ─────────────────────────────────────────
    public function exportTemplate()
    {
        return Excel::download(new SiswaTemplateExport, 'Template_Import_Siswa.xlsx');
    }

    // ─────────────────────────────────────────
    // IMPORT EXCEL
    // ─────────────────────────────────────────
    public function import(Request $request)
    {
        $request->validate([
            'file_import' => 'required|file|mimes:zip,xlsx,xls,csv|max:20480',
        ]);

        $file = $request->file('file_import');
        $ext = strtolower($file->getClientOriginalExtension());
        $fotoDir = null;
        $tmpDir = null;

        // ── JALUR 1: ZIP (Excel + folder foto) ──────────────────────
        if ($ext === 'zip') {
            [$excelPath, $fotoMap, $tmpDir] = $this->extractZip($file);

            if (!$excelPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'File ZIP tidak valid: tidak ditemukan file Excel (.xlsx/.xls/.csv) di dalamnya. Pastikan struktur ZIP sudah benar.'
                ], 422);
            }

            $import = new \App\Imports\SiswaImport($fotoMap);
            \Maatwebsite\Excel\Facades\Excel::import($import, $excelPath);

            // ── JALUR 2: Excel/CSV biasa (tanpa foto) ───────────────────
        } else {
            $import = new \App\Imports\SiswaImport([]);
            \Maatwebsite\Excel\Facades\Excel::import($import, $file);
        }

        // Bersihkan folder sementara ZIP
        if ($tmpDir && is_dir($tmpDir)) {
            File::deleteDirectory($tmpDir);
        }

        // Laporan
        $stats = $import->getStats();

        $msg = "Import selesai: {$stats['inserted']} siswa berhasil ditambahkan";
        if ($stats['updated'] > 0)
            $msg .= ", {$stats['updated']} siswa diperbarui";
        if ($stats['skipped'] > 0)
            $msg .= ", {$stats['skipped']} baris dilewati (NIS kosong)";
        if ($stats['foto_matched'] > 0)
            $msg .= ", {$stats['foto_matched']} foto berhasil dipasang";
        if ($stats['foto_avatar'] > 0)
            $msg .= ", {$stats['foto_avatar']} menggunakan avatar dari nama";
        $msg .= '.';

        $sessionKey = ($stats['inserted'] > 0 || $stats['updated'] > 0) ? 'success' : 'warning';
        return response()->json([
            'success' => $sessionKey === 'success',
            'message' => $msg
        ]);
    }

    // ─────────────────────────────────────────
    // HELPER: Extract ZIP ke folder sementara
    // ─────────────────────────────────────────
    private function extractZip($file): array
    {
        $zip = new \ZipArchive();
        $tmpDir = sys_get_temp_dir() . '/siakad_' . uniqid();
        mkdir($tmpDir, 0755, true);

        if ($zip->open($file->getRealPath()) !== true) {
            return [null, [], $tmpDir];
        }
        $zip->extractTo($tmpDir);
        $zip->close();

        $excelPath = null;
        $fotoMap = [];

        // Iterasi rekursif untuk cari Excel dan semua file gambar
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($tmpDir, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($it as $info) {
            if ($info->isFile()) {
                $ext = strtolower($info->getExtension());
                $path = $info->getRealPath();

                // Abaikan file sistem macOS
                if (strpos($path, '__MACOSX') !== false) {
                    continue;
                }

                if (!$excelPath && in_array($ext, ['xlsx', 'xls', 'csv'])) {
                    // Pastikan file excel bukan hidden file (dimulai dengan .~)
                    if (strpos($info->getFilename(), '.~') === false && strpos($info->getFilename(), '._') === false) {
                        $excelPath = $path;
                    }
                } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $filename = pathinfo($info->getFilename(), PATHINFO_FILENAME);
                    $fotoMap[strtolower(trim($filename))] = $path;
                }
            }
        }

        return [$excelPath, $fotoMap, $tmpDir];
    }

    // ─────────────────────────────────────────
    // MUTASI / LULUS
    // ─────────────────────────────────────────
    public function mutasiLulus(Request $request, $id)
    {
        $request->validate([
            'jenis_mutasi' => 'required|in:lulus,mutasi_keluar,nonaktif',
            'tanggal_keluar' => 'required|date',
            'no_surat' => 'nullable|string',
            'alasan_mutasi' => 'required|string',
            'sekolah_tujuan' => 'nullable|string',
        ]);

        $siswa = Siswa::findOrFail($id);

        DB::transaction(function () use ($request, $siswa) {

            // 1. Tentukan status baru
            $statusBaru = match ($request->jenis_mutasi) {
                'lulus' => 'lulus',
                'mutasi_keluar' => 'pindah',
                'nonaktif' => 'nonaktif',
            };

            // 2. Catat riwayat kelas (histori keluar) sebagai event satu tanggal
            $activeTa = TahunAjaran::where('is_active', true)->first();
            $activeSemester = $this->riwayatKelasService->activeSemesterName($activeTa?->id);

            $this->riwayatKelasService->recordTerminalEvent(
                $siswa,
                $request->jenis_mutasi,
                $request->tanggal_keluar,
                $activeTa?->id,
                $activeSemester,
                $request->alasan_mutasi . ($request->no_surat ? ' (Surat: ' . $request->no_surat . ')' : '')
            );

            // 3. Update status siswa, lepas dari kelas
            $siswa->update([
                'status' => $statusBaru,
                'kelas_id' => null,
            ]);

            // 4. Simpan record mutasi
            MutasiSiswa::create([
                'siswa_id' => $siswa->id,
                'jenis_mutasi' => $request->jenis_mutasi,
                'tanggal' => $request->tanggal_keluar,
                'no_surat' => $request->no_surat,
                'alasan' => $request->alasan_mutasi,
                'sekolah_asal_tujuan' => $request->sekolah_tujuan,
            ]);
        });

        return response()->json(['success' => true, 'message' => 'Status siswa berhasil diperbarui.']);
    }

    // ─────────────────────────────────────────
    // REACTIVATE (PUT /data-siswa/{id}/reactivate)
    // Mengaktifkan kembali siswa berstatus pindah/lulus/nonaktif
    // ─────────────────────────────────────────
    public function reactivate(Request $request, $id)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'semester' => 'required|in:Ganjil,Genap',
            'tanggal_masuk' => 'required|date|before_or_equal:today',
        ]);

        $siswa = Siswa::findOrFail($id);

        // Pastikan siswa memang bukan aktif saat ini
        if ($siswa->status === 'aktif') {
            return response()->json(['success' => false, 'message' => 'Siswa ini sudah berstatus aktif.'], 422);
        }

        DB::transaction(function () use ($request, $siswa) {
            $kelasObj = Kelas::findOrFail($request->kelas_id);
            $oldStatus = $siswa->status;

            // 1) UPDATE siswas - reset status + kosongkan kolom mutasi
            $siswa->update([
                'status' => 'aktif',
                'kelas_id' => $kelasObj->id,
                'tingkat' => $kelasObj->tingkat,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
            ]);

            // 2) INSERT riwayat_kelas - catat histori masuk kembali
            $this->riwayatKelasService->recordReactivation(
                $siswa,
                $kelasObj,
                $request->tahun_ajaran_id,
                $request->semester,
                $request->tanggal_masuk,
                $oldStatus
            );
        });

        return response()->json(['success' => true, 'message' => "Siswa {$siswa->nama} berhasil diaktifkan kembali."]);
    }

    // ─────────────────────────────────────────
    // API RIWAYAT KELAS (GET /data-siswa/{id}/riwayat-kelas)
    // ─────────────────────────────────────────
    public function riwayatKelas($id)
    {
        $riwayat = RiwayatKelas::with('tahunAjaran')
            ->where('siswa_id', $id)
            ->orderByDesc('tanggal_masuk')
            ->orderByDesc('id')
            ->get()
            ->map(function ($r) {
                $tanggalMasuk = $r->tanggal_masuk ? \Carbon\Carbon::parse($r->tanggal_masuk) : null;
                $tanggalKeluar = $r->tanggal_keluar ? \Carbon\Carbon::parse($r->tanggal_keluar) : null;

                return [
                    'nama_kelas_snapshot' => $r->nama_kelas_snapshot ?? 'Belum ada kelas',
                    'jenis_label' => $this->riwayatKelasService->labelFor($r->jenis_perubahan),
                    'tahun_ajaran' => $r->tahunAjaran->tahun ?? '-',
                    'semester' => $r->semester ?? '-',
                    'tanggal_masuk' => $tanggalMasuk?->toDateString(),
                    'tanggal_keluar' => $tanggalKeluar?->toDateString(),
                    'tanggal_masuk_label' => $tanggalMasuk?->translatedFormat('d M Y') ?? '-',
                    'tanggal_keluar_label' => $tanggalKeluar?->translatedFormat('d M Y') ?? 'Sekarang',
                    'keterangan' => $r->catatan ?? '',
                    'pencatat' => 'Sistem' // Placeholder for pencatat
                ];
            });

        return response()->json(['riwayat' => $riwayat]);
    }
    public function berkasIndex(Request $request, $siswaId)
    {

        $siswa = Siswa::findOrFail($siswaId);

        $berkas = \App\Models\BerkasSiswa::where('siswa_id', $siswaId)

            ->orderByDesc('updated_at')

            ->get()

            ->map(fn($b) => [

                'id' => $b->id,

                'jenis_label' => $b->jenis_label,

                'nama_file_asli' => $b->nama_file_asli,

                'ukuran' => $b->ukuran_readable,

                'updated_at' => $b->updated_at?->format('d M Y'),

            ]);



        return response()->json(['berkas' => $berkas]);

    }



    public function berkasStore(Request $request, $siswaId)
    {

        $request->validate([

            'jenis_berkas' => 'required|in:kartu_keluarga,akte_kelahiran,ktp_orang_tua,ijazah_sebelumnya,kip_pkh_kks,pas_foto,surat_mutasi',

            'berkas_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',

        ]);



        $siswa = Siswa::findOrFail($siswaId);

        $file = $request->file('berkas_file');



        $path = $file->store('berkas_siswa', 'local');

        \App\Models\BerkasSiswa::create(
            [
                'siswa_id' => $siswaId,
                'jenis_berkas' => $request->jenis_berkas,
                'nama_file_asli' => $file->getClientOriginalName(),
                'nama_file_sistem' => basename($path),
                'path_file' => $path,
                'ekstensi' => $file->getClientOriginalExtension(),
                'ukuran_file' => $file->getSize(),
                'updated_by' => auth()->id(),
            ]
        );



        return response()->json(['success' => true, 'message' => 'Berkas berhasil diunggah.'], 201);

    }



    public function berkasView($siswaId, $berkasId)
    {

        $berkas = \App\Models\BerkasSiswa::where('siswa_id', $siswaId)->findOrFail($berkasId);

        if (!Storage::disk('local')->exists($berkas->path_file))
            abort(404);



        $mime = in_array($berkas->ekstensi, ['jpg', 'jpeg', 'png']) ? 'image/' . $berkas->ekstensi : 'application/pdf';

        return response()->file(Storage::disk('local')->path($berkas->path_file), ['Content-Type' => $mime]);

    }



    public function berkasDownload($siswaId, $berkasId)
    {

        $berkas = \App\Models\BerkasSiswa::where('siswa_id', $siswaId)->findOrFail($berkasId);

        if (!Storage::disk('local')->exists($berkas->path_file))
            abort(404);



        return Storage::disk('local')->download($berkas->path_file, $berkas->nama_file_asli);

    }



    public function berkasDestroy($siswaId, $berkasId)
    {

        $berkas = \App\Models\BerkasSiswa::where('siswa_id', $siswaId)->findOrFail($berkasId);

        if ($berkas->path_file)
            Storage::disk('local')->delete($berkas->path_file);

        $berkas->delete();



        return response()->json(['success' => true, 'message' => 'Berkas berhasil dihapus.']);

    }

    // ─────────────────────────────────────────
    // HELPER: README untuk ZIP
    // ─────────────────────────────────────────
    private function buildReadme(int $jumlahSiswa, int $jumlahFoto, string $tanggal): string
    {
        return <<<TXT
EXPORT DATA SISWA — MI NURUL HUDA 3
======================================
Tanggal export : {$tanggal}
Jumlah siswa   : {$jumlahSiswa}
Jumlah foto    : {$jumlahFoto}

STRUKTUR FILE:
  data_siswa.xlsx      → Data lengkap semua siswa (bisa langsung re-import)
  foto/
    0012345678.jpg     → Foto siswa (nama file = NISN)
    0012345679.jpg     → Alternatif: NIS jika NISN kosong
    ...

CARA RE-IMPORT:
  ZIP ini dapat langsung di-import kembali via fitur
  "Import ZIP + Foto" di halaman Data Siswa.
  Sistem akan otomatis mencocokkan foto berdasarkan
  NISN, NIS, atau nama file yang sesuai.

KOLOM EXCEL (urutan sesuai template import):
  NISN, NIS, NAMA_LENGKAP, NIK, JENIS_KELAMIN_L_P,
  TEMPAT_LAHIR, TANGGAL_LAHIR, AGAMA, KELAS,
  STATUS_SISWA, NAMA_AYAH, PEKERJAAN_AYAH,
  NAMA_IBU, PEKERJAAN_IBU, NO_HP_ORTU,
  ALAMAT, ASAL_SEKOLAH, TANGGAL_MASUK
======================================
TXT;
    }

    // ─────────────────────────────────────────
    // PRESTASI SISWA
    // ─────────────────────────────────────────
    public function prestasiIndex($siswaId)
    {
        $prestasis = \App\Models\Prestasi::where('siswa_id', $siswaId)->latest()->get();
        return response()->json(['prestasi' => $prestasis]);
    }

    public function prestasiStore(Request $request, $siswaId)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tingkat' => 'nullable|string|max:100',
            'tahun' => 'nullable|string|max:4',
            'penyelenggara' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'file_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = time() . '_' . \Illuminate\Support\Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('prestasi_siswa', $fileName, 'local');
        }

        \App\Models\Prestasi::create([
            'siswa_id' => $siswaId,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'penyelenggara' => $request->penyelenggara,
            'keterangan' => $request->keterangan,
            'file_bukti' => $filePath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil ditambahkan.'], 201);
    }

    public function prestasiUpdate(Request $request, $siswaId, $prestasiId)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tingkat' => 'nullable|string|max:100',
            'tahun' => 'nullable|string|max:4',
            'penyelenggara' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'file_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $prestasi = \App\Models\Prestasi::where('siswa_id', $siswaId)->findOrFail($prestasiId);

        $filePath = $prestasi->file_bukti;
        if ($request->hasFile('file_bukti')) {
            // Hapus file lama jika ada
            if ($filePath && Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
            $file = $request->file('file_bukti');
            $fileName = time() . '_' . \Illuminate\Support\Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('prestasi_siswa', $fileName, 'local');
        }

        $prestasi->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'penyelenggara' => $request->penyelenggara,
            'keterangan' => $request->keterangan,
            'file_bukti' => $filePath,
        ]);

        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil diperbarui.']);
    }

    public function prestasiDestroy($siswaId, $prestasiId)
    {
        $prestasi = \App\Models\Prestasi::where('siswa_id', $siswaId)->findOrFail($prestasiId);
        if ($prestasi->file_bukti && Storage::disk('local')->exists($prestasi->file_bukti)) {
            Storage::disk('local')->delete($prestasi->file_bukti);
        }
        $prestasi->delete();
        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil dihapus.']);
    }

    public function prestasiViewBukti($siswaId, $prestasiId)
    {
        $prestasi = \App\Models\Prestasi::where('siswa_id', $siswaId)->findOrFail($prestasiId);
        if (!$prestasi->file_bukti || !Storage::disk('local')->exists($prestasi->file_bukti)) {
            abort(404);
        }

        $ext = pathinfo($prestasi->file_bukti, PATHINFO_EXTENSION);
        $mime = in_array(strtolower($ext), ['jpg', 'jpeg', 'png']) ? 'image/' . strtolower($ext) : 'application/pdf';
        return response()->file(Storage::disk('local')->path($prestasi->file_bukti), ['Content-Type' => $mime]);
    }

    public function prestasiDownloadBukti($siswaId, $prestasiId)
    {
        $prestasi = \App\Models\Prestasi::where('siswa_id', $siswaId)->findOrFail($prestasiId);
        if (!$prestasi->file_bukti || !Storage::disk('local')->exists($prestasi->file_bukti)) {
            abort(404);
        }

        $fileName = \Illuminate\Support\Str::slug($prestasi->nama) . '_bukti.' . pathinfo($prestasi->file_bukti, PATHINFO_EXTENSION);
        return Storage::disk('local')->download($prestasi->file_bukti, $fileName);
    }

    // ─────────────────────────────────────────
    // BEASISWA SISWA
    // ─────────────────────────────────────────
    public function beasiswaIndex($siswaId)
    {
        $beasiswas = \App\Models\Beasiswa::where('siswa_id', $siswaId)->latest()->get();
        return response()->json(['beasiswa' => $beasiswas]);
    }

    public function beasiswaStore(Request $request, $siswaId)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tahun_mulai' => 'nullable|string|max:4',
            'tahun_selesai' => 'nullable|string|max:4',
            'nominal' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $beasiswa = \App\Models\Beasiswa::create([
            'siswa_id' => $siswaId,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['success' => true, 'message' => 'Data beasiswa berhasil ditambahkan.'], 201);
    }

    public function beasiswaUpdate(Request $request, $siswaId, $beasiswaId)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:100',
            'tahun_mulai' => 'nullable|string|max:4',
            'tahun_selesai' => 'nullable|string|max:4',
            'nominal' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $beasiswa = \App\Models\Beasiswa::where('siswa_id', $siswaId)->findOrFail($beasiswaId);
        $beasiswa->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['success' => true, 'message' => 'Data beasiswa berhasil diperbarui.']);
    }

    public function beasiswaDestroy($siswaId, $beasiswaId)
    {
        $beasiswa = \App\Models\Beasiswa::where('siswa_id', $siswaId)->findOrFail($beasiswaId);
        $beasiswa->delete();
        return response()->json(['success' => true, 'message' => 'Data beasiswa berhasil dihapus.']);
    }

    /**
     * Validation rules standar Dapodik & Kemenag RI untuk data siswa.
     * Dipakai oleh store() dan update() agar konsisten.
     *
     * @param int|null $id  ID siswa untuk unique ignore (update), null untuk store
     * @param bool $isStore  True = store (perlu jenis_pendaftaran & berkas mutasi)
     * @return array
     */
    private function siswaValidationRules(?int $id = null, bool $isStore = true): array
    {
        // ── Enum standar Dapodik ──
        $agamaEnum = 'Islam,Kristen,Katolik,Hindu,Budha,Khonghucu';
        $pekerjaanEnum = 'Tidak Bekerja,Nelayan,Petani,Peternak,PNS/TNI/POLRI,Karyawan Swasta,Pedagang Kecil,Pedagang Besar,Wiraswasta,Wirausaha,Buruh,Pensiunan,Tenaga Kerja Indonesia,Karyawan BUMN,Tidak dapat diterapkan,Sudah Meninggal,Lainnya';
        $pendidikanEnum = 'Tidak Sekolah,Putus SD,SD / Sederajat,SMP / Sederajat,SMA / Sederajat,D1,D2,D3,D4 / S1,S2,S3';
        $penghasilanEnum = 'Kurang dari Rp 500.000,Rp 500.000 - Rp 999.999,Rp 1.000.000 - Rp 1.999.999,Rp 2.000.000 - Rp 4.999.999,Rp 5.000.000 - Rp 20.000.000,Lebih dari Rp 20.000.000,Tidak Berpenghasilan';
        $modaTransportasiEnum = 'Jalan Kaki,Sepeda,Sepeda Motor,Mobil Pribadi,Antar Jemput Sekolah,Angkutan Umum,Perahu / Sampan,Lainnya';
        $statusOrtuEnum = 'Masih Hidup,Sudah Meninggal';
        $pembiayaEnum = 'Orang Tua,Wali,Pemerintah,Swasta,Lainnya';
        $imunisasiEnum = 'Lengkap,Tidak Lengkap,Belum,Tidak Diketahui';

        $uniqueNisn = $id ? 'unique:siswas,nisn,' . $id : 'unique:siswas,nisn';
        $uniqueNis = $id ? 'unique:siswas,nis,' . $id : 'unique:siswas,nis';
        $maxTahun = date('Y');

        $rules = [
            // ── Identitas Siswa ──
            'user_id' => 'nullable|exists:users,id',
            'nisn' => 'required|digits:10|' . $uniqueNisn,
            'nis' => 'required|string|max:20|' . $uniqueNis,
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16',
            'no_kk' => 'required|digits:16',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'kelas_id' => 'nullable|exists:kelas,id',
            'status' => 'nullable|in:aktif,nonaktif,pindah,lulus',
            'tahun_ajaran_id' => 'nullable|exists:tahun_ajarans,id',
            'agama' => 'required|in:' . $agamaEnum,
            'golongan_darah' => 'required|in:A,B,AB,O,Tidak Diketahui',
            'tinggi_badan' => 'required|numeric|min:30|max:250',
            'berat_badan' => 'required|numeric|min:3|max:200',
            'catatan_kesehatan' => 'nullable|string',
            'riwayat_penyakit' => 'nullable|string',
            'kebutuhan_khusus' => 'nullable|string|max:100',
            'asal_sekolah' => 'nullable|string|max:255',
            'npsn_asal' => 'nullable|string|max:20',
            'tanggal_masuk' => 'required|date|before_or_equal:today',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // ── Dapodik: Identitas lanjutan & data tambahan ──
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'no_registrasi_akta_kelahiran' => 'nullable|string|max:100',
            'lintang' => 'nullable|numeric|between:-90,90',
            'bujur' => 'nullable|numeric|between:-180,180',
            'kebutuhan_khusus_ayah' => 'nullable|string|max:100',
            'kebutuhan_khusus_ibu' => 'nullable|string|max:100',
            'hobi' => 'nullable|string|max:100',
            'cita_cita' => 'nullable|string|max:100',
            'no_telp_siswa' => 'nullable|string|max:20',
            'hp_siswa' => 'nullable|string|max:20',
            'email_siswa' => 'nullable|email|max:150',
            'lingkar_kepala' => 'required|numeric|min:20|max:80',

            // ── Dapodik: Kesejahteraan ──
            'penerima_kps_pkh' => 'nullable|boolean',
            'no_kps_pkh' => 'required_if:penerima_kps_pkh,1|nullable|string|max:100',
            'layak_pip' => 'nullable|boolean',
            'alasan_layak_pip' => 'required_if:layak_pip,1|nullable|string',
            'penerima_kip' => 'nullable|boolean',
            'no_kip' => 'required_if:penerima_kip,1|nullable|string|max:100',
            'nama_tertera_di_kip' => 'required_if:penerima_kip,1|nullable|string|max:150',

            // ── Dapodik: Alamat & Domisili Siswa ──
            'alamat_siswa' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kode_pos' => 'required|digits:5',

            // ── Dapodik: Data Keluarga ──
            'anak_ke' => 'required|integer|min:1|max:20',
            'jumlah_saudara' => 'nullable|integer|min:0|max:20',

            // ── Dapodik: Data Periodik / Geografis ──
            'jarak_tempat_tinggal' => 'nullable|numeric|min:0|max:999',
            'waktu_tempuh' => 'nullable|integer|min:0|max:999',
            'moda_transportasi' => 'required|in:' . $modaTransportasiEnum,

            // ── Field Excel / Tambahan ──
            'kelas_pararel' => 'nullable|string|max:10',
            'no_absen' => 'nullable|string|max:10',
            'nama_kepala_keluarga' => 'nullable|string|max:255',
            'pembiaya_sekolah' => 'nullable|in:' . $pembiayaEnum,
            'imunisasi' => 'nullable|in:' . $imunisasiEnum,

            // ── Dapodik: Data Orang Tua — Ayah ──
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|digits:16',
            'tahun_lahir_ayah' => 'required|integer|min:1940|max:' . $maxTahun,
            'pendidikan_ayah' => 'required|in:' . $pendidikanEnum,
            'pekerjaan_ayah' => 'required|in:' . $pekerjaanEnum,
            'penghasilan_ayah' => 'required|in:' . $penghasilanEnum,
            'status_ayah' => 'nullable|in:' . $statusOrtuEnum,
            'kewarganegaraan_ayah' => 'nullable|in:WNI,WNA',
            'tempat_lahir_ayah' => 'nullable|string|max:100',
            'no_hp_ayah' => 'nullable|string|max:20',

            // ── Dapodik: Data Orang Tua — Ibu ──
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|digits:16',
            'tahun_lahir_ibu' => 'required|integer|min:1940|max:' . $maxTahun,
            'pendidikan_ibu' => 'required|in:' . $pendidikanEnum,
            'pekerjaan_ibu' => 'required|in:' . $pekerjaanEnum,
            'penghasilan_ibu' => 'required|in:' . $penghasilanEnum,
            'status_ibu' => 'nullable|in:' . $statusOrtuEnum,
            'kewarganegaraan_ibu' => 'nullable|in:WNI,WNA',
            'tempat_lahir_ibu' => 'nullable|string|max:100',
            'no_hp_ibu' => 'nullable|string|max:20',

            // ── Dapodik: Kontak & Alamat Orang Tua ──
            'no_hp_ortu' => 'required|string|max:20',
            'alamat' => 'required|string',

            // ── Dapodik: Data Wali (opsional) ──
            'nama_wali' => 'nullable|string|max:255',
            'nik_wali' => 'nullable|digits:16',
            'tahun_lahir_wali' => 'nullable|integer|min:1940|max:' . $maxTahun,
            'pekerjaan_wali' => 'nullable|in:' . $pekerjaanEnum,
            'pendidikan_wali' => 'nullable|in:' . $pendidikanEnum,
            'penghasilan_wali' => 'nullable|in:' . $penghasilanEnum,
            'no_hp_wali' => 'nullable|string|max:20',
            'alamat_wali' => 'nullable|string',
            'status_wali' => 'nullable|in:' . $statusOrtuEnum,
            'kewarganegaraan_wali' => 'nullable|in:WNI,WNA',
            'tempat_lahir_wali' => 'nullable|string|max:100',

            // ── Berkas Opsional ──
            'berkas_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'berkas_akte' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'berkas_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];

        // Store-only rules: jenis pendaftaran, mutasi, berkas mutasi
        if ($isStore) {
            $rules['jenis_pendaftaran'] = 'required|in:baru,pindahan';
            $rules['no_surat_mutasi'] = 'required_if:jenis_pendaftaran,pindahan|nullable|string|max:100';
            $rules['alasan_mutasi'] = 'required_if:jenis_pendaftaran,pindahan|nullable|string';
            $rules['berkas_surat_mutasi'] = 'required_if:jenis_pendaftaran,pindahan|nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['berkas_rapor_asal'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        return $rules;
    }

    private function dataTambahanPayload(Request $request): array
    {
        return [
            'kewarganegaraan' => $request->kewarganegaraan,
            'no_registrasi_akta_kelahiran' => $request->no_registrasi_akta_kelahiran,
            'lintang' => $request->lintang,
            'bujur' => $request->bujur,
            'kebutuhan_khusus_ayah' => $request->kebutuhan_khusus_ayah,
            'kebutuhan_khusus_ibu' => $request->kebutuhan_khusus_ibu,
            'hobi' => $request->hobi,
            'cita_cita' => $request->cita_cita,
            'no_telp_siswa' => $request->no_telp_siswa,
            'hp_siswa' => $request->hp_siswa,
            'email_siswa' => $request->email_siswa,
            'lingkar_kepala' => $request->lingkar_kepala,
        ];
    }

    private function programKesejahteraanPayload(Request $request): array
    {
        return [
            'penerima_kps_pkh' => $request->boolean('penerima_kps_pkh'),
            'no_kps_pkh' => $request->no_kps_pkh,
            'layak_pip' => $request->boolean('layak_pip'),
            'alasan_layak_pip' => $request->alasan_layak_pip,
            'penerima_kip' => $request->boolean('penerima_kip'),
            'no_kip' => $request->no_kip,
            'nama_tertera_di_kip' => $request->nama_tertera_di_kip,
        ];
    }

    /**
     * Handle relasi orang tua untuk siswa baru (store)
     * Sesuai standar Dapodik: Ayah, Ibu, Wali harus terpisah
     * 
     * @param Siswa $siswa
     * @param Request $request
     * @return void
     */
    private function handleOrangTuaRelation(Siswa $siswa, Request $request): void
    {
        // Hapus relasi lama jika ada (untuk memastikan data bersih)
        $siswa->orangTuas()->detach();

        // Buat record Ayah jika ada
        if ($request->nama_ayah) {
            $ayah = OrangTua::create([
                'nama_ayah' => $request->nama_ayah,
                'nik_ayah' => $request->nik_ayah,
                'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'status_ayah' => $request->status_ayah,
                'kewarganegaraan_ayah' => $request->kewarganegaraan_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'no_hp' => $request->no_hp_ortu ?: '-',
                'alamat' => $request->alamat,
                // Field ibu & wali dikosongkan
                'nama_ibu' => null,
                'nik_ibu' => null,
                'tahun_lahir_ibu' => null,
                'pendidikan_ibu' => null,
                'pekerjaan_ibu' => null,
                'penghasilan_ibu' => null,
                'nama_wali' => null,
                'nik_wali' => null,
                'tahun_lahir_wali' => null,
                'pekerjaan_wali' => null,
                'pendidikan_wali' => null,
                'no_hp_wali' => null,
                'alamat_wali' => null,
                'penghasilan_wali' => null,
            ]);
            $siswa->orangTuas()->attach($ayah->id, ['hubungan_keluarga' => 'Ayah']);
        }

        // Buat record Ibu jika ada
        if ($request->nama_ibu) {
            $ibu = OrangTua::create([
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'status_ibu' => $request->status_ibu,
                'kewarganegaraan_ibu' => $request->kewarganegaraan_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
                'no_hp' => $request->no_hp_ortu ?: '-',
                'alamat' => $request->alamat,
                // Field ayah & wali dikosongkan
                'nama_ayah' => null,
                'nik_ayah' => null,
                'tahun_lahir_ayah' => null,
                'pendidikan_ayah' => null,
                'pekerjaan_ayah' => null,
                'penghasilan_ayah' => null,
                'nama_wali' => null,
                'nik_wali' => null,
                'tahun_lahir_wali' => null,
                'pekerjaan_wali' => null,
                'pendidikan_wali' => null,
                'no_hp_wali' => null,
                'alamat_wali' => null,
                'penghasilan_wali' => null,
            ]);
            $siswa->orangTuas()->attach($ibu->id, ['hubungan_keluarga' => 'Ibu']);
        }

        // Buat record Wali jika ada
        if ($request->nama_wali) {
            $wali = OrangTua::create([
                'nama_wali' => $request->nama_wali,
                'nik_wali' => $request->nik_wali,
                'tahun_lahir_wali' => $request->tahun_lahir_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'pendidikan_wali' => $request->pendidikan_wali,
                'penghasilan_wali' => $request->penghasilan_wali,
                'status_wali' => $request->status_wali,
                'kewarganegaraan_wali' => $request->kewarganegaraan_wali,
                'tempat_lahir_wali' => $request->tempat_lahir_wali,
                'no_hp_wali' => $request->no_hp_wali,
                'alamat_wali' => $request->alamat_wali,
                // Field ayah & ibu dikosongkan
                'nama_ayah' => null,
                'nik_ayah' => null,
                'tahun_lahir_ayah' => null,
                'pendidikan_ayah' => null,
                'pekerjaan_ayah' => null,
                'penghasilan_ayah' => null,
                'no_hp' => $request->no_hp_wali ?: '-', // Gunakan no_hp_wali, fallback ke '-'
                'alamat' => $request->alamat_wali,
                'nama_ibu' => null,
                'nik_ibu' => null,
                'tahun_lahir_ibu' => null,
                'pendidikan_ibu' => null,
                'pekerjaan_ibu' => null,
                'penghasilan_ibu' => null,
            ]);
            $siswa->orangTuas()->attach($wali->id, ['hubungan_keluarga' => 'Wali']);
        }
    }

    /**
     * Handle update relasi orang tua untuk siswa existing (update)
     * Perbaikan Bug #1: Cek kakak-beradik sebelum update
     * Perbaikan Bug #2: Sesuai standar Dapodik (Ayah, Ibu, Wali terpisah)
     * 
     * @param Siswa $siswa
     * @param Request $request
     * @return void
     */
    private function handleOrangTuaRelationUpdate(Siswa $siswa, Request $request): void
    {
        // Ambil semua relasi orang tua yang ada
        $existingOrangTuas = $siswa->orangTuas;

        // Cek apakah ada record orang tua yang digunakan oleh siswa lain (kakak-beradik)
        $hasSharedParent = false;
        foreach ($existingOrangTuas as $ortu) {
            $jumlahSiswaBerelasi = $ortu->siswas()->count();
            if ($jumlahSiswaBerelasi > 1) {
                $hasSharedParent = true;
                break;
            }
        }

        // Jika ada kakak-beradik, buat record baru untuk siswa ini
        // Jika tidak, update record yang ada atau buat baru
        if ($hasSharedParent) {
            // KAKAK-BERADIK: Putuskan relasi lama dan buat record baru
            $siswa->orangTuas()->detach();
            $this->handleOrangTuaRelation($siswa, $request);
        } else {
            // ANAK TUNGGAL atau TIDAK ADA RELASI: Update atau buat baru
            
            // Ayah
            $ayah = $existingOrangTuas->where('pivot.hubungan_keluarga', 'Ayah')->first();
            if ($request->nama_ayah) {
                $dataAyah = [
                    'nama_ayah' => $request->nama_ayah,
                    'nik_ayah' => $request->nik_ayah,
                    'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'penghasilan_ayah' => $request->penghasilan_ayah,
                    'status_ayah' => $request->status_ayah,
                    'kewarganegaraan_ayah' => $request->kewarganegaraan_ayah,
                    'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                    'no_hp_ayah' => $request->no_hp_ayah,
                    'no_hp' => $request->no_hp_ortu ?: '-',
                    'alamat' => $request->alamat,
                ];
                if ($ayah) {
                    $ayah->update($dataAyah);
                } else {
                    $ayah = OrangTua::create($dataAyah);
                    $siswa->orangTuas()->attach($ayah->id, ['hubungan_keluarga' => 'Ayah']);
                }
            } elseif ($ayah) {
                $siswa->orangTuas()->detach($ayah->id);
                $ayah->delete();
            }

            // Ibu
            $ibu = $existingOrangTuas->where('pivot.hubungan_keluarga', 'Ibu')->first();
            if ($request->nama_ibu) {
                $dataIbu = [
                    'nama_ibu' => $request->nama_ibu,
                    'nik_ibu' => $request->nik_ibu,
                    'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'penghasilan_ibu' => $request->penghasilan_ibu,
                    'status_ibu' => $request->status_ibu,
                    'kewarganegaraan_ibu' => $request->kewarganegaraan_ibu,
                    'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                    'no_hp_ibu' => $request->no_hp_ibu,
                    'no_hp' => $request->no_hp_ortu ?: '-',
                    'alamat' => $request->alamat,
                ];
                if ($ibu) {
                    $ibu->update($dataIbu);
                } else {
                    $ibu = OrangTua::create($dataIbu);
                    $siswa->orangTuas()->attach($ibu->id, ['hubungan_keluarga' => 'Ibu']);
                }
            } elseif ($ibu) {
                $siswa->orangTuas()->detach($ibu->id);
                $ibu->delete();
            }

            // Wali
            $wali = $existingOrangTuas->where('pivot.hubungan_keluarga', 'Wali')->first();
            if ($request->nama_wali) {
                $dataWali = [
                    'nama_wali' => $request->nama_wali,
                    'nik_wali' => $request->nik_wali,
                    'tahun_lahir_wali' => $request->tahun_lahir_wali,
                    'pekerjaan_wali' => $request->pekerjaan_wali,
                    'pendidikan_wali' => $request->pendidikan_wali,
                    'penghasilan_wali' => $request->penghasilan_wali,
                    'status_wali' => $request->status_wali,
                    'kewarganegaraan_wali' => $request->kewarganegaraan_wali,
                    'tempat_lahir_wali' => $request->tempat_lahir_wali,
                    'no_hp_wali' => $request->no_hp_wali,
                    'alamat_wali' => $request->alamat_wali,
                    'no_hp' => $request->no_hp_wali ?: '-',
                    'alamat' => $request->alamat_wali,
                ];
                if ($wali) {
                    $wali->update($dataWali);
                } else {
                    $wali = OrangTua::create($dataWali);
                    $siswa->orangTuas()->attach($wali->id, ['hubungan_keluarga' => 'Wali']);
                }
            } elseif ($wali) {
                $siswa->orangTuas()->detach($wali->id);
                $wali->delete();
            }
        }
    }
}

