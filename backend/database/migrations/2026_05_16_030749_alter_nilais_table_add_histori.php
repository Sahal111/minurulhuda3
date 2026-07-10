<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajarans')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->enum('semester_baru', ['Ganjil', 'Genap'])->nullable();
        });

        DB::statement("UPDATE nilais SET semester_baru = 'Ganjil' WHERE semester = '1' OR semester = 'Ganjil'");
        DB::statement("UPDATE nilais SET semester_baru = 'Genap' WHERE semester = '2' OR semester = 'Genap'");

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->renameColumn('semester_baru', 'semester');
        });
    }

    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['tahun_ajaran_id']);
            $table->dropColumn('tahun_ajaran_id');
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
            $table->string('semester_lama')->nullable();
        });

        DB::statement("UPDATE nilais SET semester_lama = '1' WHERE semester = 'Ganjil'");
        DB::statement("UPDATE nilais SET semester_lama = '2' WHERE semester = 'Genap'");

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->renameColumn('semester_lama', 'semester');
        });
    }
};
