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
        Schema::create('siswas', function (Blueprint $table) {

            $table->id();

            $table->string('nisn')->nullable();
            $table->string('nis')->unique();

            $table->string('nama');

            $table->string('nik')->nullable();

            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();

            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->foreignId('kelas_id')->nullable()->constrained('kelas');

            $table->string('status')->default('aktif');

            $table->timestamps();

            $table->string('foto')->nullable();
            $table->string('agama')->nullable()->after('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};