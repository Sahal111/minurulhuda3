<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom:
     * - no_kk          : Nomor Kartu Keluarga (dibutuhkan DAPODIK)
     * - golongan_darah : A / B / AB / O / tidak diketahui
     * - tinggi_badan   : dalam cm
     * - berat_badan    : dalam kg
     * - riwayat_penyakit : catatan penyakit / kondisi khusus
     * - kebutuhan_khusus : ABK / berkebutuhan khusus
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('no_kk', 16)->nullable()->after('nik');
            $table->string('golongan_darah', 5)->nullable()->after('agama');
            $table->unsignedSmallInteger('tinggi_badan')->nullable()->after('golongan_darah');
            $table->unsignedSmallInteger('berat_badan')->nullable()->after('tinggi_badan');
            $table->text('riwayat_penyakit')->nullable()->after('berat_badan');
            $table->string('kebutuhan_khusus')->nullable()->after('riwayat_penyakit');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn([
                'no_kk',
                'golongan_darah',
                'tinggi_badan',
                'berat_badan',
                'riwayat_penyakit',
                'kebutuhan_khusus',
            ]);
        });
    }
};
