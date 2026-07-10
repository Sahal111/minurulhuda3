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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_ajaran_id')
                  ->constrained('tahun_ajarans')
                  ->cascadeOnDelete();
            $table->enum('nama', ['Ganjil', 'Genap']);
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            // Satu tahun ajaran hanya bisa punya 1 Ganjil dan 1 Genap
            $table->unique(['tahun_ajaran_id', 'nama']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
