<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('nik', 20)->nullable()->change();
            $table->string('no_kk', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('nik', 16)->nullable()->change();
            $table->string('no_kk', 16)->nullable()->change();
        });
    }
};
