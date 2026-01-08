<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artikel', function (Blueprint $table) {

            if (!Schema::hasColumn('artikel', 'ringkasan')) {
                $table->text('ringkasan')->nullable()->after('judul');
            }

            if (!Schema::hasColumn('artikel', 'jenis')) {
                $table->enum('jenis', ['artikel', 'jurnal'])
                    ->default('artikel')
                    ->after('status');
            }

            if (!Schema::hasColumn('artikel', 'file_pdf')) {
                $table->string('file_pdf')->nullable()->after('jenis');
            }

            if (!Schema::hasColumn('artikel', 'penulis')) {
                $table->string('penulis')->nullable()->after('file_pdf');
            }

            if (!Schema::hasColumn('artikel', 'tahun_terbit')) {
                $table->year('tahun_terbit')->nullable()->after('penulis');
            }

            if (!Schema::hasColumn('artikel', 'referensi')) {
                $table->text('referensi')->nullable()->after('tahun_terbit');
            }

            if (!Schema::hasColumn('artikel', 'keywords')) {
                $table->json('keywords')->nullable()->after('referensi');
            }

            if (!Schema::hasColumn('artikel', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('views');
            }
        });
    }

    public function down(): void
    {
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropColumn([
                'ringkasan',
                'jenis',
                'file_pdf',
                'penulis',
                'tahun_terbit',
                'referensi',
                'keywords',
                'published_at',
            ]);
        });
    }
};