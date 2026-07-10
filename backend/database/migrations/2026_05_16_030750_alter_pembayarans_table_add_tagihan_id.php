<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('tagihan_id')->nullable()->constrained('tagihans')->nullOnDelete();
            $table->renameColumn('nominal', 'nominal_bayar');
        });

        // enum status changes
        // Previous status might be ['lunas', 'belum']
        // We probably want to update the enum directly or use the same rename trick if needed.
        // For simplicity we will assume it's ['lunas', 'belum'] to ['Lunas', 'Dicicil', 'Belum'] ?
        // The prompt says: "status (Lunas/Dicicil)"
        // Let's modify the enum:
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->enum('status_baru', ['Lunas', 'Dicicil', 'Belum'])->default('Belum');
        });

        \Illuminate\Support\Facades\DB::statement("UPDATE pembayarans SET status_baru = 'Lunas' WHERE status = 'lunas'");
        \Illuminate\Support\Facades\DB::statement("UPDATE pembayarans SET status_baru = 'Belum' WHERE status = 'belum'");

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->renameColumn('status_baru', 'status');
        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->enum('status_lama', ['lunas', 'belum'])->default('belum');
        });

        \Illuminate\Support\Facades\DB::statement("UPDATE pembayarans SET status_lama = 'lunas' WHERE status = 'Lunas'");
        \Illuminate\Support\Facades\DB::statement("UPDATE pembayarans SET status_lama = 'belum' WHERE status != 'Lunas'");

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->renameColumn('nominal_bayar', 'nominal');
            $table->dropForeign(['tagihan_id']);
            $table->dropColumn('tagihan_id');
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->renameColumn('status_lama', 'status');
        });
    }
};
