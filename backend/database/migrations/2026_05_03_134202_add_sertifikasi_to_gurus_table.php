<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Sertifikasi & NUPTK lanjutan
            $table->string('no_sertifikasi')->nullable()->after('nuptk');
            $table->year('tahun_sertifikasi')->nullable()->after('no_sertifikasi');
            $table->string('bidang_sertifikasi')->nullable()->after('tahun_sertifikasi');

            // Riwayat pendidikan lanjutan (multi-jenjang)
            $table->string('pendidikan_s1')->nullable()->after('kampus');
            $table->string('jurusan_s1')->nullable()->after('pendidikan_s1');
            $table->string('kampus_s1')->nullable()->after('jurusan_s1');
            $table->string('pendidikan_s2')->nullable()->after('kampus_s1');
            $table->string('jurusan_s2')->nullable()->after('pendidikan_s2');
            $table->string('kampus_s2')->nullable()->after('jurusan_s2');

            // Data kepegawaian tambahan
            $table->string('sk_pengangkatan')->nullable()->after('golongan');
            $table->date('tanggal_sk')->nullable()->after('sk_pengangkatan');
            $table->string('gaji_pokok')->nullable()->after('tanggal_sk');
            $table->string('npwp')->nullable()->after('gaji_pokok');
            $table->string('no_rekening')->nullable()->after('npwp');
            $table->string('nama_bank')->nullable()->after('no_rekening');
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn([
                'no_sertifikasi', 'tahun_sertifikasi', 'bidang_sertifikasi',
                'pendidikan_s1', 'jurusan_s1', 'kampus_s1',
                'pendidikan_s2', 'jurusan_s2', 'kampus_s2',
                'sk_pengangkatan', 'tanggal_sk', 'gaji_pokok',
                'npwp', 'no_rekening', 'nama_bank',
            ]);
        });
    }
};
