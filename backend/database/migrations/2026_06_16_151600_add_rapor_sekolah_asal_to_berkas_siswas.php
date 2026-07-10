<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan 'rapor_sekolah_asal' ke enum jenis_berkas untuk berkas mutasi masuk
        DB::statement("ALTER TABLE berkas_siswas MODIFY jenis_berkas ENUM(
            'kartu_keluarga',
            'akte_kelahiran',
            'ktp_orang_tua',
            'ijazah_sebelumnya',
            'kip_pkh_kks',
            'pas_foto',
            'surat_mutasi',
            'rapor_sekolah_asal'
        )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus record dengan jenis_berkas = 'rapor_sekolah_asal' sebelum rollback
        DB::table('berkas_siswas')->where('jenis_berkas', 'rapor_sekolah_asal')->delete();
        
        // Kembalikan enum ke state sebelumnya
        DB::statement("ALTER TABLE berkas_siswas MODIFY jenis_berkas ENUM(
            'kartu_keluarga',
            'akte_kelahiran',
            'ktp_orang_tua',
            'ijazah_sebelumnya',
            'kip_pkh_kks',
            'pas_foto',
            'surat_mutasi'
        )");
    }
};
