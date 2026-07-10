<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('guru_absensis')) {
            Schema::create('guru_absensis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
                $table->date('tanggal');
                $table->time('jam_masuk')->nullable();
                $table->time('jam_pulang')->nullable();
                $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa'])->default('Hadir');
                $table->text('keterangan')->nullable();
                $table->timestamps();
                $table->softDeletes();
                
                $table->unique(['guru_id', 'tanggal']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_absensis');
    }
};
