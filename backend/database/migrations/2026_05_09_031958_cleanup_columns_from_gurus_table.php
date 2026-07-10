<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Drop Pendidikan fields
            $table->dropColumn([
                'pendidikan', 'jurusan', 'kampus', 
                'pendidikan_s2', 'jurusan_s2', 'kampus_s2'
            ]);

            // Drop Sertifikasi fields
            $table->dropColumn([
                'no_sertifikasi', 'tahun_sertifikasi', 'bidang_sertifikasi'
            ]);

            // Drop Mengajar fields
            $table->dropColumn([
                'mapel', 'kelas', 'tahun_mengajar'
            ]);

            // Drop Rekening & Payroll fields
            $table->dropColumn([
                'no_rekening', 'nama_bank', 'npwp', 'gaji_pokok'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('kampus')->nullable();
            $table->string('pendidikan_s2')->nullable();
            $table->string('jurusan_s2')->nullable();
            $table->string('kampus_s2')->nullable();
            $table->string('no_sertifikasi')->nullable();
            $table->string('tahun_sertifikasi')->nullable();
            $table->string('bidang_sertifikasi')->nullable();
            $table->string('mapel')->nullable();
            $table->string('kelas')->nullable();
            $table->year('tahun_mengajar')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('npwp')->nullable();
            $table->decimal('gaji_pokok', 15, 2)->default(0);
        });
    }
};
