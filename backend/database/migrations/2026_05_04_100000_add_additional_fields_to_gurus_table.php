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
        Schema::table('gurus', function (Blueprint $table) {
            // Data Identitas Tambahan
            $table->string('nik', 16)->nullable()->after('nip')->comment('NIK KTP 16 digit');
            $table->string('no_kk', 16)->nullable()->after('nik')->comment('Nomor Kartu Keluarga');
            
            // Data Keluarga
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'])
                  ->nullable()
                  ->after('agama');
            $table->string('nama_pasangan')->nullable()->after('status_perkawinan');
            $table->string('pekerjaan_pasangan')->nullable()->after('nama_pasangan');
            $table->integer('jumlah_anak')->default(0)->after('pekerjaan_pasangan');
            $table->string('nama_ibu_kandung')->nullable()->after('jumlah_anak')->comment('Untuk verifikasi');
            
            // Data Kepegawaian Tambahan
            $table->date('tmt_pns')->nullable()->after('tanggal_bergabung')->comment('Tanggal Mulai Tugas PNS');
            $table->string('no_karpeg')->nullable()->after('nip')->comment('Nomor Kartu Pegawai');
            $table->string('no_karis_karsu')->nullable()->after('no_karpeg')->comment('Nomor Karis/Karsu');
            
            // Data Kesehatan (Opsional)
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->default('-')->after('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'no_kk',
                'status_perkawinan',
                'nama_pasangan',
                'pekerjaan_pasangan',
                'jumlah_anak',
                'nama_ibu_kandung',
                'tmt_pns',
                'no_karpeg',
                'no_karis_karsu',
                'golongan_darah',
            ]);
        });
    }
};
