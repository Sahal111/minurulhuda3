<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_inpassings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')
                  ->constrained('gurus')
                  ->cascadeOnDelete();

            // Nomor SK Inpassing
            $table->string('no_sk', 100);

            // Tanggal SK dan TMT berlaku
            $table->date('tanggal_sk');
            $table->date('tmt_inpassing');

            // Hasil penyetaraan
            $table->string('golongan_sebelum', 20)->nullable();  // misal: sebelum inpassing
            $table->string('golongan_sesudah', 20);              // misal: III/b
            $table->string('jabatan_fungsional', 100)->default('Guru Pertama');
            // Guru Pertama / Guru Muda / Guru Madya / Guru Utama

            $table->string('angka_kredit', 20)->nullable();      // misal: 150.00
            $table->string('pejabat_penetap', 150)->nullable();  // Nama pejabat yang menandatangani SK
            $table->string('instansi_penetap', 150)->nullable(); // Kemenag / BKN / dll

            $table->string('status', 20)->default('aktif');
            // aktif = inpassing yang sedang berlaku, nonaktif = sudah digantikan

            $table->string('file_sk')->nullable();               // path storage scan SK
            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->index('guru_id');
            $table->index(['guru_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_inpassings');
    }
};
