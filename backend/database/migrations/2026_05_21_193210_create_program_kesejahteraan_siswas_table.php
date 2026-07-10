<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_kesejahteraan_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->unique()->constrained('siswas')->cascadeOnDelete();
            $table->boolean('penerima_kps_pkh')->default(false);
            $table->string('no_kps_pkh', 100)->nullable();
            $table->boolean('layak_pip')->default(false);
            $table->text('alasan_layak_pip')->nullable();
            $table->boolean('penerima_kip')->default(false);
            $table->string('no_kip', 100)->nullable();
            $table->string('nama_tertera_di_kip', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_kesejahteraan_siswas');
    }
};
