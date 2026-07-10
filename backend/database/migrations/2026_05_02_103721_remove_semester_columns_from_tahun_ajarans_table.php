<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Langkah:
     * 1. Migrasi data existing dari tahun_ajarans ke semesters
     * 2. Hapus kolom semester, nama, tgl_mulai, tgl_selesai dari tahun_ajarans
     */
    public function up(): void
    {
        // --- Step 1: Migrasi data existing ---
        $existingData = DB::table('tahun_ajarans')->get();

        foreach ($existingData as $ta) {
            // Cek apakah sudah ada semester untuk tahun ajaran ini
            $exists = DB::table('semesters')
                ->where('tahun_ajaran_id', $ta->id)
                ->where('nama', $ta->semester ?? 'Ganjil')
                ->exists();

            if (!$exists) {
                DB::table('semesters')->insert([
                    'tahun_ajaran_id' => $ta->id,
                    'nama'            => $ta->semester ?? 'Ganjil',
                    'tgl_mulai'       => $ta->tgl_mulai,
                    'tgl_selesai'     => $ta->tgl_selesai,
                    'is_active'       => $ta->is_active,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }

        // --- Step 2: Hapus kolom dari tahun_ajarans ---
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->dropColumn(['nama', 'semester', 'tgl_mulai', 'tgl_selesai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('id');
            $table->enum('semester', ['Ganjil', 'Genap'])->nullable()->after('tahun');
            $table->date('tgl_mulai')->nullable()->after('semester');
            $table->date('tgl_selesai')->nullable()->after('tgl_mulai');
        });
    }
};
