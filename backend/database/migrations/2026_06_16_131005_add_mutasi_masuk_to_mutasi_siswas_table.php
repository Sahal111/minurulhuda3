<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan 'mutasi_masuk' ke enum jenis_mutasi untuk rekam jejak siswa pindahan
        DB::statement("ALTER TABLE mutasi_siswas MODIFY jenis_mutasi ENUM('lulus', 'mutasi_keluar', 'nonaktif', 'mutasi_masuk')");
    }

    public function down(): void
    {
        // Hapus record mutasi_masuk sebelum rollback enum
        DB::table('mutasi_siswas')->where('jenis_mutasi', 'mutasi_masuk')->delete();
        
        DB::statement("ALTER TABLE mutasi_siswas MODIFY jenis_mutasi ENUM('lulus', 'mutasi_keluar', 'nonaktif')");
    }
};
