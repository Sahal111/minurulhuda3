<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Siswa extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // ─── SOFT DELETE (Recycle Bin) ─────────────────────────
        // Ikut masuk recycle bin: riwayat_kelas, nilais, absensis, rapors, catatan_walis, perkembangan_siswas
        // TIDAK ikut soft-delete: pembayarans (standar auditing keuangan — catatan uang masuk harus tetap utuh di laporan)
        static::deleting(function (Siswa $siswa) {
            $now = now();
            $siswa->riwayatKelas()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $siswa->nilais()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $siswa->absensis()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            \App\Models\Rapor::where('siswa_id', $siswa->id)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            \App\Models\CatatanWali::where('siswa_id', $siswa->id)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $siswa->perkembangans()->whereNull('deleted_at')->update(['deleted_at' => $now]);
        });

        // ─── RESTORE (Pulihkan dari Recycle Bin) ──────────────
        static::restoring(function (Siswa $siswa) {
            $deletedAt = $siswa->deleted_at->copy()->subSeconds(5);
            $siswa->riwayatKelas()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $siswa->nilais()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $siswa->absensis()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            \App\Models\Rapor::withTrashed()->where('siswa_id', $siswa->id)->where('deleted_at', '>=', $deletedAt)->restore();
            \App\Models\CatatanWali::withTrashed()->where('siswa_id', $siswa->id)->where('deleted_at', '>=', $deletedAt)->restore();
            $siswa->perkembangans()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
        });

        // ─── FORCE DELETE (Hapus Permanen) ────────────────────
        // Semua data transaksional lenyap total, termasuk pembayarans
        // Akun login siswa (users) juga dihapus agar tidak menjadi akun hantu
        static::forceDeleting(function (Siswa $siswa) {
            // 1. Hapus foto profil dari storage public
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }

            // 2. Hapus semua file fisik dokumen digital & record di berkas_siswas
            // Karena tabel belum menggunakan SoftDeletes, kita panggil dan delete satu per satu
            $berkas = \App\Models\BerkasSiswa::where('siswa_id', $siswa->id)->get();
            foreach ($berkas as $b) {
                if ($b->path_file) {
                    // File berkas disimpan di disk 'local' (private storage)
                    Storage::disk('local')->delete($b->path_file);
                }
                $b->delete();
            }

            // 3. Hapus relasi pivot orang_tua_siswa
            $siswa->orangTuas()->detach();

            // 4. Hapus permanen data transaksional
            $siswa->riwayatKelas()->withTrashed()->forceDelete();
            $siswa->nilais()->withTrashed()->forceDelete();
            $siswa->absensis()->withTrashed()->forceDelete();
            \App\Models\Rapor::withTrashed()->where('siswa_id', $siswa->id)->forceDelete();
            \App\Models\CatatanWali::withTrashed()->where('siswa_id', $siswa->id)->forceDelete();
            \App\Models\Pembayaran::withTrashed()->where('siswa_id', $siswa->id)->forceDelete();
            $siswa->perkembangans()->forceDelete();
            $siswa->mutasis()->forceDelete();

            // 5. Hapus akun login siswa agar tidak menjadi akun hantu
            if ($siswa->user_id) {
                \App\Models\User::where('id', $siswa->user_id)->delete();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'nisn',
        'nis',
        'nama',
        'tingkat',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'kelas_id',
        'agama',
        'golongan_darah',
        'riwayat_penyakit',
        'kebutuhan_khusus',
        'status',
        'foto',
        'tahun_ajaran_id',
        'asal_sekolah',
        'tanggal_masuk',
        // Dapodik: Alamat Domisili Siswa
        'alamat_siswa',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        // Dapodik: Data Keluarga
        'anak_ke',
        'jumlah_saudara',
        // Dapodik: Data Periodik / Geografis
        'jarak_tempat_tinggal',
        'waktu_tempuh',
        'moda_transportasi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orangTuas()
    {
        return $this->belongsToMany(OrangTua::class, 'orang_tua_siswa')->withPivot('hubungan_keluarga')->withTimestamps();
    }

    public function getOrangTuaAttribute()
    {
        return $this->orangTuas->first();
    }

    public function perkembangans()
    {
        return $this->hasMany(PerkembanganSiswa::class);
    }

    public function mutasis()
    {
        return $this->hasMany(MutasiSiswa::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function beasiswas()
    {
        return $this->hasMany(Beasiswa::class);
    }

    public function dataTambahan()
    {
        return $this->hasOne(DataTambahanSiswa::class);
    }

    public function programKesejahteraan()
    {
        return $this->hasOne(ProgramKesejahteraanSiswa::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function riwayatKelas()
    {
        return $this->hasMany(RiwayatKelas::class);
    }

    public function berkas()
    {
        return $this->hasMany(BerkasSiswa::class, 'siswa_id');
    }

    /**
     * Scope: pencarian berdasarkan nama, NIS, NISN, atau NIK.
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama', 'like', "%{$keyword}%")
              ->orWhere('nis', 'like', "%{$keyword}%")
              ->orWhere('nisn', 'like', "%{$keyword}%")
              ->orWhere('nik', 'like', "%{$keyword}%");
        });
    }
}
