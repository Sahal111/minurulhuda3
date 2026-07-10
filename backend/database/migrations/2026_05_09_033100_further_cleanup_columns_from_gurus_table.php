<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn([
                'jabatan', 'golongan', 'status_kepegawaian', 
                'sk_pengangkatan', 'tanggal_sk'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('jabatan')->nullable();
            $table->string('golongan')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->date('tanggal_sk')->nullable();
        });
    }
};
