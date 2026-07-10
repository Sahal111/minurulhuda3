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
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->string('nama_wali')->nullable()->after('pekerjaan_ibu');
            $table->string('pekerjaan_wali')->nullable()->after('nama_wali');
            $table->string('no_hp_wali')->nullable()->after('pekerjaan_wali');
            $table->text('alamat_wali')->nullable()->after('no_hp_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->dropColumn(['nama_wali', 'pekerjaan_wali', 'no_hp_wali', 'alamat_wali']);
        });
    }
};
