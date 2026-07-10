<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');

            $table->string('kategori');  // enum kategori dokumen
            $table->string('nama_dokumen');  // nama custom dari user
            $table->string('nomor_dokumen')->nullable();  // nomor SK, nomor ijazah, dll
            $table->date('tanggal_dokumen')->nullable();  // tanggal terbit dokumen
            $table->date('tanggal_berlaku')->nullable();  // tanggal berlaku (untuk sertifikat yg expire)
            $table->date('tanggal_kadaluarsa')->nullable();  // untuk dokumen yang expire
            $table->string('penerbit')->nullable();  // instansi penerbit dokumen
            $table->string('file_path');
            $table->string('file_type')->nullable();  // pdf, jpg, png
            $table->bigInteger('file_size')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('is_verified')->default(false);  // sudah diverifikasi operator
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_dokumens');
    }
};
