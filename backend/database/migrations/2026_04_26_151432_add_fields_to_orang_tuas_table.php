<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable()->after('siswa_id');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
            $table->string('pekerjaan')->nullable()->after('nama_ibu');
        });
    }

    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->dropColumn(['nama_ayah', 'nama_ibu', 'pekerjaan']);
        });
    }
};