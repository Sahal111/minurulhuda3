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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();

            // IDENTITAS
            $table->string('nuptk')->nullable()->unique();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->string('foto')->nullable();

            // KONTAK
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable()->unique();

            // PENDIDIKAN
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('kampus')->nullable();

            // MENGAJAR
            $table->string('mapel')->nullable();
            $table->string('kelas')->nullable();
            $table->year('tahun_mengajar')->nullable();

            // STATUS
            $table->string('status_kepegawaian')->nullable();
            $table->string('jabatan')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->string('golongan')->nullable();
            $table->date('tanggal_bergabung')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};