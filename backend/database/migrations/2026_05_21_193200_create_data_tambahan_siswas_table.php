<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_tambahan_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->unique()->constrained('siswas')->cascadeOnDelete();
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->nullable();
            $table->string('no_registrasi_akta_kelahiran', 100)->nullable();
            $table->decimal('lintang', 10, 8)->nullable();
            $table->decimal('bujur', 11, 8)->nullable();
            $table->string('kebutuhan_khusus_ayah', 100)->nullable();
            $table->string('kebutuhan_khusus_ibu', 100)->nullable();
            $table->string('hobi', 100)->nullable();
            $table->string('cita_cita', 100)->nullable();
            $table->string('no_telp_siswa', 20)->nullable();
            $table->string('hp_siswa', 20)->nullable();
            $table->string('email_siswa', 150)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_tambahan_siswas');
    }
};
