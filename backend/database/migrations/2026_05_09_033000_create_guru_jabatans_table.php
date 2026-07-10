<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_jabatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->string('jabatan');
            $table->string('golongan')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('sk_nomor')->nullable();
            $table->date('sk_tanggal')->nullable();
            $table->date('tmt_jabatan')->nullable();
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_jabatans');
    }
};
