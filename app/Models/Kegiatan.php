<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'video',
        'kategori',
        'ikon',
        'tags',
        'warna',
        'status',
        'urutan'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tags' => 'array',
        'urutan' => 'integer'
    ];

    // Accessor untuk properti dinamis
    protected $appends = [
        'gambar_url',
        'video_url',
        'has_video',
        'is_youtube',
        'has_thumbnail',
        'is_video_clickable',
        'thumbnail_url',
        'kategori_label',
        'route_slug'
    ];

    // ==================== BOOT METHOD ====================
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug saat membuat
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug();
            }
        });

        // Auto-update slug saat judul berubah
        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $model->slug = $model->generateUniqueSlug();
            }
        });

        // Delete related files
        static::deleting(function ($model) {
            if ($model->gambar && Storage::disk('public')->exists($model->gambar)) {
                Storage::disk('public')->delete($model->gambar);
            }

            if ($model->video && !$model->isYouTubeUrl($model->video)) {
                if (Storage::disk('public')->exists($model->video)) {
                    Storage::disk('public')->delete($model->video);
                }
            }
        });
    }

    // ==================== HELPER METHODS ====================

    /**
     * Generate unique slug
     */
    public function generateUniqueSlug()
    {
        $slug = Str::slug($this->judul);

        // Fallback jika slug kosong
        if (empty($slug)) {
            $slug = 'kegiatan-' . ($this->id ?? uniqid());
        }

        // Cek duplikasi
        $count = 1;
        $originalSlug = $slug;

        while (static::where('slug', $slug)
            ->when($this->exists, function ($query) {
                return $query->where('id', '!=', $this->id);
            })
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Accessor untuk route slug (AMAN dari null)
     */
    public function getRouteSlugAttribute()
    {
        return $this->slug ?? $this->generateUniqueSlug();
    }

    /**
     * Ensure slug exists
     */
    public function ensureSlug()
    {
        if (empty($this->slug)) {
            $this->slug = $this->generateUniqueSlug();
            $this->saveQuietly();
        }
        return $this->slug;
    }

    // ==================== ACCESSORS ====================

    /**
     * Accessor untuk URL Gambar
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }
        return null;
    }

    /**
     * Accessor untuk URL Video
     */
    public function getVideoUrlAttribute()
    {
        if ($this->video) {
            // Jika video adalah URL YouTube
            if ($this->isYouTubeUrl($this->video)) {
                return $this->video;
            }
            // Jika video adalah file lokal
            if (Storage::disk('public')->exists($this->video)) {
                return asset('storage/' . $this->video);
            }
        }
        return null;
    }

    /**
     * Cek apakah ada video
     */
    public function getHasVideoAttribute()
    {
        return !empty($this->video);
    }

    /**
     * Cek apakah video YouTube
     */
    public function getIsYouTubeAttribute()
    {
        return $this->has_video && $this->isYouTubeUrl($this->video);
    }

    /**
     * Cek apakah memiliki thumbnail
     */
    public function getHasThumbnailAttribute()
    {
        return $this->gambar || $this->is_youtube;
    }

    /**
     * Cek apakah video bisa diklik (punya thumbnail)
     */
    public function getIsVideoClickableAttribute()
    {
        return $this->has_video && $this->has_thumbnail;
    }

    /**
     * Get thumbnail URL (gambar atau YouTube thumbnail)
     */
    public function getThumbnailUrlAttribute()
    {
        // 1. Prioritas: Gambar dari database
        if ($this->gambar_url) {
            return $this->gambar_url;
        }

        // 2. Jika tidak ada gambar, coba YouTube thumbnail
        if ($this->is_youtube) {
            $videoId = $this->getYouTubeId();
            if ($videoId) {
                return $this->getYouTubeThumbnailUrl($videoId);
            }
        }

        // 3. Tidak ada thumbnail
        return null;
    }

    /**
     * Label kategori untuk tampilan
     */
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'academic' => 'Akademik',
            'extracurricular' => 'Ekstrakurikuler',
            'competition' => 'Kompetisi',
            'ceremony' => 'Upacara',
            'field_trip' => 'Kunjungan',
            'social' => 'Sosial',
            'art' => 'Seni',
            'sport' => 'Olahraga',
            'religious' => 'Keagamaan'
        ];

        return $labels[$this->kategori] ?? 'Kegiatan';
    }

    // ==================== HELPER METHODS ====================

    /**
     * Ekstrak ID YouTube dari URL
     */
    public function getYouTubeId()
    {
        if (!$this->is_youtube) {
            return null;
        }

        $url = $this->video;

        // Pattern untuk berbagai format URL YouTube
        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/',
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/v\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Get YouTube thumbnail URL dengan berbagai kualitas
     */
    private function getYouTubeThumbnailUrl($videoId, $quality = 'maxresdefault')
    {
        $qualities = [
            'default' => 'default.jpg',
            'mqdefault' => 'mqdefault.jpg',
            'hqdefault' => 'hqdefault.jpg',
            'sddefault' => 'sddefault.jpg',
            'maxresdefault' => 'maxresdefault.jpg'
        ];

        $quality = $qualities[$quality] ?? $qualities['maxresdefault'];
        return "https://img.youtube.com/vi/{$videoId}/{$quality}";
    }

    /**
     * Cek apakah URL adalah YouTube
     */
    private function isYouTubeUrl($url)
    {
        if (!$url) return false;

        $patterns = [
            'youtube.com',
            'youtu.be',
            'youtube-nocookie.com'
        ];

        foreach ($patterns as $pattern) {
            if (str_contains($url, $pattern)) {
                return true;
            }
        }

        return false;
    }

    // ==================== SCOPES ====================

    /**
     * Scope untuk kegiatan aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%")
                ->orWhere('tags', 'like', "%{$search}%");
        });
    }
}