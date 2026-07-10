<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (\Illuminate\Support\Facades\DB::getDriverName() === 'sqlite') {
            return;
        }

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE riwayat_kelas MODIFY COLUMN jenis_perubahan ENUM('naik_kelas','turun_kelas','pindah_kelas','masuk_baru','mutasi_masuk','mutasi_keluar','lulus','masuk_kembali')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (\Illuminate\Support\Facades\DB::getDriverName() === 'sqlite') {
            return;
        }

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE riwayat_kelas MODIFY COLUMN jenis_perubahan ENUM('naik_kelas','turun_kelas','pindah_kelas','masuk_baru','mutasi_masuk','mutasi_keluar','lulus')");
    }
};
