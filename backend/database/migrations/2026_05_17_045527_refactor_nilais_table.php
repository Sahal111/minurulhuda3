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
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['mapel_id']);
            
            $table->dropColumn(['guru_id', 'mapel_id', 'nilai_harian', 'nilai_uts', 'nilai_uas']);
            
            $table->foreignId('plot_guru_mapel_id')->after('siswa_id')->nullable()->constrained('plot_guru_mapels')->nullOnDelete();
            $table->foreignId('komponen_penilaian_id')->after('plot_guru_mapel_id')->nullable()->constrained('komponen_penilaians')->nullOnDelete();
            $table->decimal('nilai', 5, 2)->after('komponen_penilaian_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['plot_guru_mapel_id']);
            $table->dropForeign(['komponen_penilaian_id']);
            
            $table->dropColumn(['plot_guru_mapel_id', 'komponen_penilaian_id', 'nilai']);
            
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->nullOnDelete();
            $table->foreignId('mapel_id')->nullable()->constrained('mapels')->nullOnDelete();
            $table->decimal('nilai_harian', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();
        });
    }
};
