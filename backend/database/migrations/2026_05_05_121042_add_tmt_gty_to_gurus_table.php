<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            // TMT Guru Tetap Yayasan — hanya relevan jika sekolah di bawah yayasan
            $table->date('tmt_gty')->nullable()->after('tmt_pns')
                  ->comment('Terhitung Mulai Tugas sebagai Guru Tetap Yayasan');
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('tmt_gty');
        });
    }
};