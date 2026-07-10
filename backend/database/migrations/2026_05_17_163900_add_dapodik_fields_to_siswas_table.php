<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom standar Dapodik ke tabel siswas:
     * - Alamat tempat tinggal siswa (mandiri, bisa beda dari orang tua)
     * - Data keluarga (anak ke-berapa, jumlah saudara)
     * - Data periodik/geografis (jarak, waktu tempuh, moda transportasi)
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // Alamat tempat tinggal siswa
            $table->text('alamat_siswa')->nullable()->after('kebutuhan_khusus');
            $table->string('rt', 5)->nullable()->after('alamat_siswa');
            $table->string('rw', 5)->nullable()->after('rt');
            $table->string('kelurahan', 100)->nullable()->after('rw');
            $table->string('kecamatan', 100)->nullable()->after('kelurahan');
            $table->string('kode_pos', 10)->nullable()->after('kecamatan');

            // Data keluarga
            $table->unsignedSmallInteger('anak_ke')->nullable()->after('kode_pos');
            $table->unsignedSmallInteger('jumlah_saudara')->nullable()->after('anak_ke');

            // Data periodik / geografis
            $table->decimal('jarak_tempat_tinggal', 5, 1)->nullable()->after('jumlah_saudara');
            $table->unsignedSmallInteger('waktu_tempuh')->nullable()->after('jarak_tempat_tinggal');
            $table->string('moda_transportasi', 50)->nullable()->after('waktu_tempuh');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn([
                'alamat_siswa', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
                'anak_ke', 'jumlah_saudara',
                'jarak_tempat_tinggal', 'waktu_tempuh', 'moda_transportasi',
            ]);
        });
    }
};
