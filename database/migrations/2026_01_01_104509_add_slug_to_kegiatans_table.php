<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Kegiatan;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom slug jika belum ada
        if (!Schema::hasColumn('kegiatans', 'slug')) {
            Schema::table('kegiatans', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('judul');
            });
        }

        // Generate slug untuk data yang sudah ada
        $this->generateSlugsForExistingData();
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    private function generateSlugsForExistingData(): void
    {
        $kegiatans = Kegiatan::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($kegiatans as $kegiatan) {
            $slug = Str::slug($kegiatan->judul);

            // Cek apakah slug sudah ada
            $count = 1;
            $originalSlug = $slug;
            while (Kegiatan::where('slug', $slug)->where('id', '!=', $kegiatan->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $kegiatan->slug = $slug;
            $kegiatan->save();
        }
    }
};