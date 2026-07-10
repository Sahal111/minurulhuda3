<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom standar Dapodik ke tabel orang_tuas:
     * - NIK Ayah & Ibu
     * - Tahun Lahir Ayah & Ibu
     * - Pendidikan Terakhir Ayah, Ibu, dan Wali
     */
    public function up(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            // Data Ayah
            $table->string('nik_ayah', 16)->nullable()->after('nama_ayah');
            $table->year('tahun_lahir_ayah')->nullable()->after('nik_ayah');
            $table->string('pendidikan_ayah', 50)->nullable()->after('tahun_lahir_ayah');

            // Data Ibu
            $table->string('nik_ibu', 16)->nullable()->after('nama_ibu');
            $table->year('tahun_lahir_ibu')->nullable()->after('nik_ibu');
            $table->string('pendidikan_ibu', 50)->nullable()->after('tahun_lahir_ibu');

            // Data Wali
            $table->string('pendidikan_wali', 50)->nullable()->after('pekerjaan_wali');
        });
    }

    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->dropColumn([
                'nik_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah',
                'nik_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu',
                'pendidikan_wali',
            ]);
        });
    }
};
