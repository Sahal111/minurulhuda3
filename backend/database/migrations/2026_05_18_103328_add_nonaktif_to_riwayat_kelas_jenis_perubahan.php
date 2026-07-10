<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("ALTER TABLE riwayat_kelas MODIFY COLUMN jenis_perubahan 
            ENUM('naik_kelas','turun_kelas','pindah_kelas','masuk_baru',
                 'mutasi_masuk','mutasi_keluar','lulus','masuk_kembali','nonaktif') NULL");
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("UPDATE riwayat_kelas SET jenis_perubahan = 'mutasi_keluar' 
            WHERE jenis_perubahan = 'nonaktif'");
            
        DB::statement("ALTER TABLE riwayat_kelas MODIFY COLUMN jenis_perubahan 
            ENUM('naik_kelas','turun_kelas','pindah_kelas','masuk_baru',
                 'mutasi_masuk','mutasi_keluar','lulus','masuk_kembali') NULL");
    }
};
