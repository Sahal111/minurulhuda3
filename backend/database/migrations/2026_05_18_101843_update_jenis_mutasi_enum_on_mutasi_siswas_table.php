<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   // database/migrations/2026_05_18_101843_update_jenis_mutasi_enum_on_mutasi_siswas_table.php

// database/migrations/2026_05_18_101843_update_jenis_mutasi_enum_on_mutasi_siswas_table.php

public function up(): void
{
    if (DB::getDriverName() === 'sqlite') {
        return;
    }

    // 1. Ubah ke string dulu agar bebas nilai apapun
    DB::statement("ALTER TABLE mutasi_siswas MODIFY COLUMN jenis_mutasi VARCHAR(50) NOT NULL");

    // 2. Update data lama
    DB::statement("UPDATE mutasi_siswas SET jenis_mutasi = 'mutasi_keluar' WHERE jenis_mutasi IN ('Masuk', 'Keluar')");

    // 3. Baru alter ke enum baru
    DB::statement("ALTER TABLE mutasi_siswas MODIFY COLUMN jenis_mutasi ENUM('lulus', 'mutasi_keluar', 'nonaktif') NOT NULL");
}

public function down(): void
{
    if (DB::getDriverName() === 'sqlite') {
        return;
    }

    DB::statement("ALTER TABLE mutasi_siswas MODIFY COLUMN jenis_mutasi VARCHAR(50) NOT NULL");
    DB::statement("UPDATE mutasi_siswas SET jenis_mutasi = 'Keluar' WHERE jenis_mutasi IN ('mutasi_keluar', 'lulus', 'nonaktif')");
    DB::statement("ALTER TABLE mutasi_siswas MODIFY COLUMN jenis_mutasi ENUM('Masuk', 'Keluar') NOT NULL");
}
};
