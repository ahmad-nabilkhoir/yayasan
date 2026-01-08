<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'sub_judul',
        'sekolah',
        'tahun',
        'foto',
        'deskripsi'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope by sekolah
    public function scopeSekolah($query, $sekolah)
    {
        return $query->where('sekolah', $sekolah);
    }

    // Scope by tahun
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    // Scope latest
    public function scopeLatest($query)
    {
        return $query->orderBy('tahun', 'desc')->orderBy('created_at', 'desc');
    }
}   