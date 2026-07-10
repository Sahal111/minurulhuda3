<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    use HasFactory, SoftDeletes;
    protected static function boot()
    {
        parent::boot();

        // Cascade Soft Delete ke semua relasi
        static::deleting(function (Guru $guru) {
            $now = now();
            $guru->jabatans()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->pendidikans()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->sertifikasis()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->rekening()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->keluarga()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->guruMapels()->whereNull('deleted_at')->update(['deleted_at' => $now]);
            $guru->dokumens()->whereNull('deleted_at')->update(['deleted_at' => $now]);   // ← aktifkan
            $guru->diklats()->whereNull('deleted_at')->update(['deleted_at' => $now]);    // ← aktifkan
            $guru->inpassings()->whereNull('deleted_at')->update(['deleted_at' => $now]); // ← aktifkan
        });

        static::restoring(function (Guru $guru) {
            $deletedAt = $guru->deleted_at->copy()->subSeconds(5);

            $guru->jabatans()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->pendidikans()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->sertifikasis()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->rekening()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->keluarga()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->guruMapels()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();
            $guru->dokumens()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();   // ← aktifkan
            $guru->diklats()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore();    // ← aktifkan
            $guru->inpassings()->withTrashed()->where('deleted_at', '>=', $deletedAt)->restore(); // ← aktifkan
        });

        static::forceDeleting(function (Guru $guru) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }

            $guru->dokumens()->withTrashed()->each(function ($dok) {
                if ($dok->file_path) {
                    Storage::disk('public')->delete($dok->file_path);
                }
                $dok->forceDelete();
            });

            $guru->jabatans()->withTrashed()->forceDelete();
            $guru->pendidikans()->withTrashed()->forceDelete();
            $guru->sertifikasis()->withTrashed()->forceDelete();
            $guru->rekening()->withTrashed()->forceDelete();
            $guru->keluarga()->withTrashed()->forceDelete();
            $guru->guruMapels()->withTrashed()->forceDelete();
            $guru->diklats()->withTrashed()->forceDelete();    // ← aktifkan
            $guru->inpassings()->withTrashed()->forceDelete(); // ← aktifkan
        });
    }
    protected $table = 'gurus';

    protected $fillable = [
        'foto',
        'user_id',
        'nip',
        'nik',
        'no_kk',
        'no_karpeg',
        'no_karis_karsu',
        'nuptk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'agama',
        'nama_ibu_kandung',
        'alamat',
        'no_hp',
        'email',
        'status_aktif',
        'is_verified',
        'verified_at',
        'verified_by',
        'tmt_pns',
        'tmt_gty',
        'tanggal_bergabung',
        'created_by',
        'updated_by',
        'deleted_by',
        'mapel',
        'kelas',
        'tahun_mengajar',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_bergabung' => 'date',
        'tmt_pns' => 'date',
        'tmt_gty' => 'date',
        'tanggal_sk' => 'date',
        'status_aktif' => 'boolean',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'jumlah_anak' => 'integer',
    ];

    protected $appends = [
        'jabatan',
        'status_kepegawaian',
        'golongan',
        'sk_pengangkatan',
        'tanggal_sk',
        'npwp',
        'no_rekening',
        'nama_bank',
        'gaji_pokok',
        'status_perkawinan',
        'nama_pasangan',
        'pekerjaan_pasangan',
        'jumlah_anak',
        'pendidikan',
        'jurusan',
        'kampus',
        'no_sertifikasi',
        'tahun_sertifikasi',
        'bidang_sertifikasi',
        'masa_bakti',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    /**
     * Scope: pencarian berdasarkan nama, nuptk, nip, no_sertifikasi, email, mapel.
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q
                ->where('nama', 'like', "%{$keyword}%")
                ->orWhere('nuptk', 'like', "%{$keyword}%")
                ->orWhere('nip', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    /**
     * Accessor: Masa Bakti
     */
    public function getMasaBaktiAttribute(): string
    {
        if (!$this->tanggal_bergabung) {
            return '-';
        }

        $start = \Carbon\Carbon::parse($this->tanggal_bergabung)->startOfDay();
        $now = \Carbon\Carbon::now()->startOfDay();

        $years = (int) $start->diffInYears($now);
        $months = (int) $start->copy()->addYears($years)->diffInMonths($now);

        if ($years === 0 && $months === 0)
            return 'Baru Bergabung';
        if ($years === 0)
            return "{$months} Bulan";
        if ($months === 0)
            return "{$years} Tahun";

        return "{$years} Thn {$months} Bln";
    }

    public function getMasaGtyAttribute(): string
    {
        if (!$this->tmt_gty)
            return '-';

        $start = \Carbon\Carbon::parse($this->tmt_gty)->startOfDay();
        $now = \Carbon\Carbon::now()->startOfDay();
        $years = (int) $start->diffInYears($now);
        $months = (int) $start->copy()->addYears($years)->diffInMonths($now);

        if ($years === 0 && $months === 0)
            return 'Baru GTY';
        if ($years === 0)
            return "{$months} Bln GTY";
        if ($months === 0)
            return "{$years} Thn GTY";
        return "{$years} Thn {$months} Bln GTY";
    }

    public function dokumens()
    {
        return $this->hasMany(\App\Models\GuruDokumen::class);
    }

    public function diklats()
    {
        return $this->hasMany(\App\Models\GuruDiklat::class)->latest('tanggal_mulai');
    }

    public function inpassings()
    {
        return $this->hasMany(\App\Models\GuruInpassing::class)->latest('tmt_inpassing');
    }

    public function inpassingAktif()
    {
        return $this
            ->hasOne(\App\Models\GuruInpassing::class)
            ->where('status', 'aktif')
            ->latestOfMany('tmt_inpassing');
    }

    public function pendidikans()
    {
        return $this->hasMany(GuruPendidikan::class);
    }

    public function sertifikasis()
    {
        return $this->hasMany(GuruSertifikasi::class);
    }

    public function guruMapels()
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function rekening()
    {
        return $this->hasOne(GuruRekening::class);
    }

    public function jabatans()
    {
        return $this->hasMany(GuruJabatan::class);
    }

    public function currentJabatan()
    {
        return $this->hasOne(GuruJabatan::class)->where('is_current', true)->latestOfMany();
    }

    public function keluarga()
    {
        return $this->hasOne(GuruKeluarga::class);
    }

    // ==================== ACCESSORS (Relational Mapping) ====================

    // Accessor untuk jabatan (Backward Compatibility)
    public function getJabatanAttribute()
    {
        return $this->currentJabatan?->jabatan ?? 'Guru';
    }

    public function getStatusKepegawaianAttribute()
    {
        return $this->currentJabatan?->status_kepegawaian ?? 'Honorer';
    }

    public function getGolonganAttribute()
    {
        return $this->currentJabatan?->golongan;
    }

    public function getSkPengangkatanAttribute()
    {
        return $this->currentJabatan?->sk_nomor;
    }

    public function getTanggalSkAttribute()
    {
        return $this->currentJabatan?->sk_tanggal;
    }

    // Accessor untuk Rekening
    public function getNpwpAttribute()
    {
        return $this->rekening?->npwp;
    }

    public function getNoRekeningAttribute()
    {
        return $this->rekening?->no_rekening;
    }

    public function getNamaBankAttribute()
    {
        return $this->rekening?->nama_bank;
    }

    public function getGajiPokokAttribute()
    {
        return $this->rekening?->gaji_pokok;
    }

    // Accessor untuk Keluarga
    public function getStatusPerkawinanAttribute()
    {
        return $this->keluarga?->status_perkawinan;
    }

    public function getNamaPasanganAttribute()
    {
        return $this->keluarga?->nama_pasangan;
    }

    public function getPekerjaanPasanganAttribute()
    {
        return $this->keluarga?->pekerjaan_pasangan;
    }

    public function getJumlahAnakAttribute()
    {
        return $this->keluarga?->jumlah_anak ?? 0;
    }

    // Accessor untuk Pendidikan (S1 & S2)
    public function pendidikanTerakhir()
    {
        $order = ['S3 - Doktor' => 5, 'S2 - Magister' => 4, 'S1 - Sarjana' => 3, 'D3 - Diploma' => 2, 'SMA / MA' => 1];
        return $this->pendidikans
            ->filter(fn($p) => isset($order[$p->jenjang]))
            ->sortByDesc(fn($p) => $order[$p->jenjang])
            ->first();
    }

    public function getPendidikanAttribute()
    {
        return $this->pendidikanTerakhir()?->jenjang;
    }

    public function getJurusanAttribute()
    {
        return $this->pendidikanTerakhir()?->jurusan;
    }

    public function getKampusAttribute()
    {
        return $this->pendidikanTerakhir()?->nama_sekolah;
    }

    // Accessor untuk Sertifikasi
    public function getNoSertifikasiAttribute()
    {
        return $this->sertifikasis->first()?->no_sertifikat;
    }

    public function getTahunSertifikasiAttribute()
    {
        return $this->sertifikasis->first()?->tahun_sertifikasi;
    }

    public function getBidangSertifikasiAttribute()
    {
        return $this->sertifikasis->first()?->bidang_studi;
    }

    public function waliKelasHistory()
    {
        return $this->hasMany(WaliKelas::class);
    }

    public function absensiGuru()
    {
        return $this->hasMany(GuruAbsensi::class);
    }
}