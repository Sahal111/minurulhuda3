<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn([
                'pendidikan_s1', 'jurusan_s1', 'kampus_s1',
                'status_perkawinan', 'nama_pasangan', 'pekerjaan_pasangan', 'jumlah_anak'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('pendidikan_s1')->nullable();
            $table->string('jurusan_s1')->nullable();
            $table->string('kampus_s1')->nullable();
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'])->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
            $table->integer('jumlah_anak')->default(0);
        });
    }
};
