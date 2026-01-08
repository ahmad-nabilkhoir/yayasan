// Buat migration baru: php artisan make:migration add_indexes_to_staff_table
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            // Indeks untuk kolom kategori (untuk where 'pimpinan', 'kepsek', 'guru')
            $table->index('kategori');

            // Indeks untuk kolom jabatan (untuk where like '%SD%', '%Sekolah Dasar%', dll)
            $table->index('jabatan');

            // Indeks untuk kolom urutan (untuk order by)
            $table->index('urutan');
        });
    }

    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
            $table->dropIndex(['jabatan']);
            $table->dropIndex(['urutan']);
        });
    }
};