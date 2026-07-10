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
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->string('tahun')->after('nama')->nullable(); // e.g. 2024/2025
            $table->enum('semester', ['Ganjil', 'Genap'])->after('tahun')->nullable();
            $table->date('tgl_mulai')->after('semester')->nullable();
            $table->date('tgl_selesai')->after('tgl_mulai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->dropColumn(['tahun', 'semester', 'tgl_mulai', 'tgl_selesai']);
        });
    }
};
