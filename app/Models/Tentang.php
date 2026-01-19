<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk hapus file otomatis

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tentangs';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'video',
        'kategori',
        'ikon',
        'tags',
        'warna',
        'status',
        'urutan'
    ];

    // Casts sudah benar untuk memastikan format tanggal
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    /**
     * Model Events (Boot)
     * Otomatis menghapus file fisik di storage jika data di database dihapus
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->foto) {
                Storage::disk('public')->delete($model->foto);
            }
        });
    }
}