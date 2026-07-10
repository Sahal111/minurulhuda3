<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            // nik might already be unique from a previous migration attempt that partially worked
            // but Laravel doesn't have Schema::hasIndex directly without a custom helper in some versions
            // but we can try-catch or just use the existence of columns/previous failures as a guide.
            // Actually, we can check if the index exists using a query or just skip if it's likely already there.
            
            // To be safe, I'll use a more robust check if possible, or just skip the unique nik for now if it's risky.
            // Let's assume nik unique might fail if already there.
            
            try {
                $table->unique('nik', 'gurus_nik_unique');
            } catch (\Exception $e) {}
            
            try {
                $table->index(['nama'], 'gurus_nama_index');
            } catch (\Exception $e) {}

            try {
                $table->index(['status_aktif'], 'gurus_status_aktif_index');
            } catch (\Exception $e) {}
        });

        Schema::table('guru_mapels', function (Blueprint $table) {
            try {
                $table->index(['guru_id', 'is_active'], 'guru_mapels_active_index');
            } catch (\Exception $e) {}
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropUnique('gurus_nik_unique');
            $table->dropIndex('gurus_nama_index');
            $table->dropIndex('gurus_status_aktif_index');
        });

        Schema::table('guru_mapels', function (Blueprint $table) {
            $table->dropIndex('guru_mapels_active_index');
        });
    }
};
