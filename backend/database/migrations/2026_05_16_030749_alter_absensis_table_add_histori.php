<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajarans')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            
            // We change the enum status to Capitalized versions
            $table->enum('status_baru', ['Hadir', 'Sakit', 'Izin', 'Alpha'])->nullable();
        });

        DB::statement("UPDATE absensis SET status_baru = 'Hadir' WHERE status = 'hadir'");
        DB::statement("UPDATE absensis SET status_baru = 'Sakit' WHERE status = 'sakit'");
        DB::statement("UPDATE absensis SET status_baru = 'Izin' WHERE status = 'izin'");
        DB::statement("UPDATE absensis SET status_baru = 'Alpha' WHERE status = 'alfa' OR status = 'alpha'");

        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('absensis', function (Blueprint $table) {
            $table->renameColumn('status_baru', 'status');
        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropForeign(['tahun_ajaran_id']);
            $table->dropColumn('tahun_ajaran_id');
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
            
            $table->enum('status_lama', ['hadir', 'izin', 'sakit', 'alfa'])->nullable();
        });

        DB::statement("UPDATE absensis SET status_lama = 'hadir' WHERE status = 'Hadir'");
        DB::statement("UPDATE absensis SET status_lama = 'sakit' WHERE status = 'Sakit'");
        DB::statement("UPDATE absensis SET status_lama = 'izin' WHERE status = 'Izin'");
        DB::statement("UPDATE absensis SET status_lama = 'alfa' WHERE status = 'Alpha'");

        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('absensis', function (Blueprint $table) {
            $table->renameColumn('status_lama', 'status');
        });
    }
};
