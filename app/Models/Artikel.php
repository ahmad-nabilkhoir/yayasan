<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'ringkasan',
        'slug',
        'thumbnail',
        'isi',
        'status',
        'views',
        'jenis', // Tambahan: artikel/jurnal
        'file_pdf', // Tambahan: untuk upload file PDF/jurnal
        'penulis', // Tambahan: nama penulis
        'tahun_terbit', // Tambahan: tahun terbit untuk jurnal
        'referensi', // Tambahan: referensi untuk jurnal
        'keywords', // Tambahan: kata kunci
        'published_at', // Tambahan: tanggal publikasi
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime',
        'keywords' => 'array', // Cast keywords sebagai array
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }

            // Generate unique slug
            $originalSlug = $artikel->slug;
            $count = 1;
            while (static::where('slug', $artikel->slug)->exists()) {
                $artikel->slug = $originalSlug . '-' . $count++;
            }

            // Set published_at jika status published
            if ($artikel->status == 'published' && empty($artikel->published_at)) {
                $artikel->published_at = now();
            }
        });

        static::updating(function ($artikel) {
            if ($artikel->isDirty('judul')) {
                $artikel->slug = Str::slug($artikel->judul);

                // Generate unique slug
                $originalSlug = $artikel->slug;
                $count = 1;
                while (static::where('slug', $artikel->slug)
                    ->where('id', '!=', $artikel->id)
                    ->exists()
                ) {
                    $artikel->slug = $originalSlug . '-' . $count++;
                }
            }

            // Update published_at jika status berubah menjadi published
            if ($artikel->isDirty('status') && $artikel->status == 'published') {
                $artikel->published_at = now();
            }
        });
    }

    // Scope untuk published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk latest
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
    }

    // Scope untuk artikel (bukan jurnal)
    public function scopeArtikel($query)
    {
        return $query->where('jenis', 'artikel')->orWhereNull('jenis');
    }

    // Scope untuk jurnal
    public function scopeJurnal($query)
    {
        return $query->where('jenis', 'jurnal');
    }

    // Accessor untuk jenis artikel
    public function getJenisLabelAttribute()
    {
        return match ($this->jenis) {
            'jurnal' => 'Jurnal',
            'artikel' => 'Artikel',
            default => 'Artikel',
        };
    }

    // Accessor untuk status
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'published' => 'Published',
            'draft' => 'Draft',
            default => 'Unknown',
        };
    }

    // Cek apakah memiliki file PDF
    public function hasPdf()
    {
        return !empty($this->file_pdf);
    }

    // Get URL file PDF
    public function getPdfUrlAttribute()
    {
        return $this->hasPdf() ? asset('storage/' . $this->file_pdf) : null;
    }

    // Get thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }

    // Get excerpt/summary
    public function getExcerptAttribute($length = 150)
    {
        $cleaned = strip_tags($this->isi);
        return Str::limit($cleaned, $length);
    }

    // Increment views dengan lock untuk menghindari race condition
    public function incrementViews()
    {
        $this->timestamps = false;
        $this->increment('views');
        $this->timestamps = true;
    }

    // Format keywords untuk display
    public function getFormattedKeywordsAttribute()
    {
        if (empty($this->keywords)) {
            return [];
        }

        if (is_array($this->keywords)) {
            return $this->keywords;
        }

        // Jika keywords disimpan sebagai string (comma separated)
        return array_map('trim', explode(',', $this->keywords));
    }

    // Cek apakah artikel ini adalah jurnal
    public function isJurnal()
    {
        return $this->jenis === 'jurnal';
    }
}