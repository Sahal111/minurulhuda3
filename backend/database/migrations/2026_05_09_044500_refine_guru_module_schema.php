<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Refine Gurus
        Schema::table('gurus', function (Blueprint $table) {
            if (!Schema::hasColumn('gurus', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('status_aktif');
            }
            if (!Schema::hasColumn('gurus', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('is_verified');
            }
            if (!Schema::hasColumn('gurus', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->after('verified_at')->constrained('users')->nullOnDelete();
            }
        });

        // Refine Guru Mapels
        Schema::table('guru_mapels', function (Blueprint $table) {
            if (!Schema::hasColumn('guru_mapels', 'tahun_ajaran_id')) {
                $table->foreignId('tahun_ajaran_id')->nullable()->after('semester_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('guru_mapels', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('beban_jam');
            }
        });

        // Refine Guru Jabatans
        Schema::table('guru_jabatans', function (Blueprint $table) {
            if (!Schema::hasColumn('guru_jabatans', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->nullable()->after('tmt_jabatan');
            }
        });

        // Refine Guru Sertifikasis
        Schema::table('guru_sertifikasis', function (Blueprint $table) {
            if (!Schema::hasColumn('guru_sertifikasis', 'tanggal_terbit')) {
                $table->date('tanggal_terbit')->nullable()->after('file_sertifikat');
            }
            if (!Schema::hasColumn('guru_sertifikasis', 'expired_at')) {
                $table->date('expired_at')->nullable()->after('tanggal_terbit');
            }
        });
    }

    public function down(): void
    {
        // Down method remains same, it will just fail or we can add checks there too
    }
};
