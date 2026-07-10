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
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['tinggi_badan', 'berat_badan', 'no_surat_mutasi', 'alasan_mutasi', 'tanggal_keluar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->string('no_surat_mutasi')->nullable();
            $table->text('alasan_mutasi')->nullable();
            $table->date('tanggal_keluar')->nullable();
        });
    }
};
