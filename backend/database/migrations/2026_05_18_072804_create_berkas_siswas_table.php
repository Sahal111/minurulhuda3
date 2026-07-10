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
        Schema::create('berkas_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            // Jenis berkas sesuai standar Dapodik
            $table->enum('jenis_berkas', [
                'kartu_keluarga',
                'akte_kelahiran',
                'ktp_orang_tua',
                'ijazah_sebelumnya',
                'kip_pkh_kks',
                'pas_foto',
                'surat_mutasi'
            ]);

            $table->string('nama_file_asli');     // Nama asli dari user
            $table->string('nama_file_sistem');   // Nama unik di storage
            $table->string('path_file');           // Path di storage private
            $table->string('ekstensi', 10);        // pdf, jpg, jpeg, png
            $table->integer('ukuran_file');         // Dalam bytes

            // Auditing
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index(['siswa_id', 'jenis_berkas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_siswas');
    }
};
