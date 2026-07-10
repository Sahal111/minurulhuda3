<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_diklats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')
                  ->constrained('gurus')
                  ->cascadeOnDelete();

            $table->string('nama_diklat', 200);
            $table->string('penyelenggara', 150)->nullable();
            $table->string('jenis', 50)->default('diklat');
            // jenis: diklat | workshop | seminar | bimtek | pelatihan | magang | lainnya

            $table->string('tingkat', 30)->nullable();
            // tingkat: sekolah | kecamatan | kabupaten | provinsi | nasional | internasional

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedSmallInteger('jumlah_jam')->nullable(); // Jumlah JP (Jam Pelajaran)
            $table->string('no_sertifikat', 100)->nullable();
            $table->string('peran', 30)->default('peserta');
            // peran: peserta | narasumber | panitia | fasilitator

            $table->string('file_sertifikat')->nullable(); // path storage
            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->index('guru_id');
            $table->index(['guru_id', 'jenis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_diklats');
    }
};