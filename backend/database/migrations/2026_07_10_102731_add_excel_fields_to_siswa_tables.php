<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─── siswas ───
        Schema::table('siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('siswas', 'kelas_pararel')) {
                $table->string('kelas_pararel', 10)->nullable()->after('kelas_id');
            }
            if (!Schema::hasColumn('siswas', 'no_absen')) {
                $table->string('no_absen', 10)->nullable()->after('kelas_pararel');
            }
            if (!Schema::hasColumn('siswas', 'nama_kepala_keluarga')) {
                $table->string('nama_kepala_keluarga', 255)->nullable()->after('no_kk');
            }
            if (!Schema::hasColumn('siswas', 'pembiaya_sekolah')) {
                $table->string('pembiaya_sekolah', 100)->nullable()->after('nama_kepala_keluarga');
            }
            if (!Schema::hasColumn('siswas', 'imunisasi')) {
                $table->string('imunisasi', 100)->nullable()->after('pembiaya_sekolah');
            }
        });

        // ─── orang_tuas ───
        Schema::table('orang_tuas', function (Blueprint $table) {
            $cols = [
                'status_ayah', 'kewarganegaraan_ayah', 'tempat_lahir_ayah', 'no_hp_ayah',
                'status_ibu', 'kewarganegaraan_ibu', 'tempat_lahir_ibu', 'no_hp_ibu',
                'status_wali', 'kewarganegaraan_wali', 'tempat_lahir_wali',
            ];
            foreach ($cols as $c) {
                if (!Schema::hasColumn('orang_tuas', $c)) {
                    $table->string($c, 100)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['kelas_pararel', 'no_absen', 'nama_kepala_keluarga', 'pembiaya_sekolah', 'imunisasi']);
        });
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->dropColumn([
                'status_ayah', 'kewarganegaraan_ayah', 'tempat_lahir_ayah', 'no_hp_ayah',
                'status_ibu', 'kewarganegaraan_ibu', 'tempat_lahir_ibu', 'no_hp_ibu',
                'status_wali', 'kewarganegaraan_wali', 'tempat_lahir_wali',
            ]);
        });
    }
};
