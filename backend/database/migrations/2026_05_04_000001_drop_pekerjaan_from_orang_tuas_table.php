<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom 'pekerjaan' lama yang sudah digantikan oleh
     * 'pekerjaan_ayah' dan 'pekerjaan_ibu'.
     */
    public function up(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            if (Schema::hasColumn('orang_tuas', 'pekerjaan')) {
                $table->dropColumn('pekerjaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->string('pekerjaan')->nullable()->after('nama_ibu');
        });
    }
};
