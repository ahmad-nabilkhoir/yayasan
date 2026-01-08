<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->enum('kategori', [
                'academic', 'extracurricular', 'competition', 
                'ceremony', 'field_trip', 'social', 'art', 
                'sport', 'religious'
            ])->default('academic');
            $table->string('ikon')->nullable();
            $table->json('tags')->nullable();
            $table->enum('warna', [
                'primary', 'success', 'warning', 'info', 'purple', 'danger'
            ])->default('primary');
            $table->boolean('status')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};