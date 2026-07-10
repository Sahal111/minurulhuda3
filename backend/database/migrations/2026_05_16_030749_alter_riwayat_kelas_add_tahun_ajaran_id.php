<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_kelas', function (Blueprint $table) {
            // Drop kolom lama yang berupa string
            $table->dropColumn('tahun_ajaran');
            // Tambah kolom baru FK
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajarans')->nullOnDelete();
            
            // Ubah semester menjadi enum
            // Karena SQLite/beberapa versi MySQL mungkin bermasalah dengan enum change secara langsung jika data tidak sesuai,
            // lebih baik ubah type. Namun kita gunakan dbal ->change().
            $table->enum('semester_baru', ['Ganjil', 'Genap'])->nullable();
        });

        // Copy data jika diperlukan (Asumsi data lama 1 -> Ganjil, 2 -> Genap)
        DB::statement("UPDATE riwayat_kelas SET semester_baru = 'Ganjil' WHERE semester = '1'");
        DB::statement("UPDATE riwayat_kelas SET semester_baru = 'Genap' WHERE semester = '2'");

        Schema::table('riwayat_kelas', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('riwayat_kelas', function (Blueprint $table) {
            $table->renameColumn('semester_baru', 'semester');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_kelas', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable();
            $table->dropForeign(['tahun_ajaran_id']);
            $table->dropColumn('tahun_ajaran_id');
            
            $table->enum('semester_lama', ['1', '2'])->nullable();
        });

        DB::statement("UPDATE riwayat_kelas SET semester_lama = '1' WHERE semester = 'Ganjil'");
        DB::statement("UPDATE riwayat_kelas SET semester_lama = '2' WHERE semester = 'Genap'");

        Schema::table('riwayat_kelas', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('riwayat_kelas', function (Blueprint $table) {
            $table->renameColumn('semester_lama', 'semester');
        });
    }
};
