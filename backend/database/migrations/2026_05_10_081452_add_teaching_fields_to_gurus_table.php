// php artisan make:migration add_teaching_fields_to_gurus_table
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('mapel', 100)->nullable();
            $table->string('kelas', 50)->nullable();
            $table->unsignedSmallInteger('tahun_mengajar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn(['mapel', 'kelas', 'tahun_mengajar']);
        });
    }
};
