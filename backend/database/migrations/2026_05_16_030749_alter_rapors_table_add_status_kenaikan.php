<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rapors', function (Blueprint $table) {
            $table->string('status_kenaikan')->nullable();
            $table->enum('semester_baru', ['Ganjil', 'Genap'])->nullable();
        });

        DB::statement("UPDATE rapors SET semester_baru = 'Ganjil' WHERE semester = '1' OR semester = 'Ganjil'");
        DB::statement("UPDATE rapors SET semester_baru = 'Genap' WHERE semester = '2' OR semester = 'Genap'");

        Schema::table('rapors', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('rapors', function (Blueprint $table) {
            $table->renameColumn('semester_baru', 'semester');
        });
    }

    public function down(): void
    {
        Schema::table('rapors', function (Blueprint $table) {
            $table->dropColumn('status_kenaikan');
            $table->string('semester_lama')->nullable();
        });

        DB::statement("UPDATE rapors SET semester_lama = '1' WHERE semester = 'Ganjil'");
        DB::statement("UPDATE rapors SET semester_lama = '2' WHERE semester = 'Genap'");

        Schema::table('rapors', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('rapors', function (Blueprint $table) {
            $table->renameColumn('semester_lama', 'semester');
        });
    }
};
