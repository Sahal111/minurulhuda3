<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('kelas', 'wali_kelas_id')) {
            Schema::table('kelas', function (Blueprint $table) {
                $table->unsignedBigInteger('wali_kelas_id')->nullable()->after('tingkat');
                $table->index('wali_kelas_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('wali_kelas_id');
        });
    }
};
