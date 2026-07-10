<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->string('jenjang'); // SD, SMP, SMA, D3, S1, S2, S3
            $table->string('nama_sekolah');
            $table->string('jurusan')->nullable();
            $table->year('tahun_lulus');
            $table->string('no_ijazah')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_pendidikans');
    }
};
