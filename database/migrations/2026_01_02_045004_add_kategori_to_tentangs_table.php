<?php
// database/migrations/2024_01_01_add_kategori_to_tentangs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tentangs', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('isi')->comment('TK, SD, UMUM');
        });
    }

    public function down()
    {
        Schema::table('tentangs', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};