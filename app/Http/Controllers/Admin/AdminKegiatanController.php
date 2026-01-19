<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminKegiatanController extends Controller
{

    protected ImageManager $image;

    public function __construct()
    {
        $this->image = new ImageManager(new Driver());
    }

    /* ================= LIST KEGIATAN ================= */
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Filter berdasarkan kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status == 'active');
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%")
                    ->orWhere('tags', 'like', "%$search%");
            });
        }

        // Sorting
        if ($request->filled('sort_by')) {
            $sortField = $request->sort_by;
            $sortDirection = $request->get('sort_dir', 'desc');
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
        }

        // PERBAIKAN: Ubah dari $kegiatan menjadi $kegiatans
        $kegiatans = $query->paginate(20);

        // Statistik
        $total = Kegiatan::count();
        $active = Kegiatan::where('status', true)->count();
        $withVideo = Kegiatan::whereNotNull('video')->count();
        $youtubeVideos = Kegiatan::where('video', 'like', '%youtube%')
            ->orWhere('video', 'like', '%youtu.be%')
            ->count();

        $stats = [
            'total' => $total,
            'active' => $active,
            'withVideo' => $withVideo,
            'youtubeVideos' => $youtubeVideos,
        ];

        $kategoriOptions = [
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

        $deleteUrlTemplate = route('admin.kegiatan.destroy', ['kegiatan' => ':id']);

        // PERBAIKAN: Ubah compact('kegiatan') menjadi compact('kegiatans')
        return view('admin.kegiatan.index', compact('kegiatans', 'stats', 'deleteUrlTemplate'));
    }

    /* ================= CREATE KEGIATAN ================= */

    public function create()
    {
        $kategoriOptions = [
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

        $colorMap = [
            'primary' => '#667eea',
            'success' => '#4CAF50',
            'warning' => '#FFB300',
            'info' => '#00BCD4',
            'purple' => '#9C27B0',
            'danger' => '#F44336',
        ];

        return view('admin.kegiatan.create', compact('kategoriOptions', 'colorMap'));
    }

    /* ================= STORE KEGIATAN ================= */

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200', // 50MB
            'ikon' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
            'warna' => 'nullable|string|max:7',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0'
        ]);

        // Proses upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $this->processImage($request->file('gambar'));
        }


        // Proses video
        $videoPath = null;
        if ($request->filled('video')) {
            // Jika input video berupa URL YouTube
            $videoPath = $request->video;
        } elseif ($request->hasFile('video_file')) {
            // Jika upload file video
            $videoPath = $request->file('video_file')->store('kegiatan/video', 'public');
        }

        // Proses tags
        $tags = null;
        if ($request->filled('tags')) {
            $tagsArray = explode(',', $request->tags);
            $tagsArray = array_map('trim', $tagsArray);
            $tags = json_encode($tagsArray);
        }

        // Handle warna
        $warna = $request->warna;
        if (!$warna) {
            $colorMap = [
                'primary' => '#667eea',
                'success' => '#4CAF50',
                'warning' => '#FFB300',
                'info' => '#00BCD4',
                'purple' => '#9C27B0',
                'danger' => '#F44336',
            ];
            $warna = $colorMap[$request->get('warna_select', 'primary')] ?? '#667eea';
        }

        Kegiatan::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
            'video' => $videoPath,
            'ikon' => $request->ikon,
            'tags' => $tags,
            'warna' => $warna,
            'status' => $request->boolean('status'),
            'urutan' => $request->urutan ?? 0
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /* ================= EDIT KEGIATAN ================= */

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kategoriOptions = [
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

        $colorMap = [
            'primary' => '#667eea',
            'success' => '#4CAF50',
            'warning' => '#FFB300',
            'info' => '#00BCD4',
            'purple' => '#9C27B0',
            'danger' => '#F44336',
        ];

        return view('admin.kegiatan.edit', compact('kegiatan', 'kategoriOptions', 'colorMap'));
    }

    /* ================= UPDATE KEGIATAN ================= */

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'ikon' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
            'warna' => 'nullable|string|max:7',
            'status' => 'boolean',
            'urutan' => 'nullable|integer|min:0'
        ]);

        // Proses update gambar
        $gambarPath = $kegiatan->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }

            $gambarPath = $this->processImage($request->file('gambar'));
        } elseif ($request->has('remove_gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = null;
        }

        // Proses update video
        $videoPath = $kegiatan->video;
        $isOldVideoLocal = $videoPath && !$this->isYouTubeUrl($videoPath);

        if ($request->filled('video')) {
            // Hapus file video lama jika ada (hanya untuk file lokal, bukan YouTube)
            if ($isOldVideoLocal && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = $request->video;
        } elseif ($request->hasFile('video_file')) {
            // Hapus file video lama jika ada
            if ($isOldVideoLocal && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = $request->file('video_file')->store('kegiatan/video', 'public');
        } elseif ($request->has('remove_video')) {
            // Hapus video jika user memilih untuk menghapus
            if ($isOldVideoLocal && Storage::disk('public')->exists($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = null;
        }

        // Proses tags
        $tags = $kegiatan->tags;
        if ($request->filled('tags')) {
            $tagsArray = explode(',', $request->tags);
            $tagsArray = array_map('trim', $tagsArray);
            $tags = json_encode($tagsArray);
        }

        // Handle warna
        $warna = $request->warna;
        if (!$warna && $request->filled('warna_select')) {
            $colorMap = [
                'primary' => '#667eea',
                'success' => '#4CAF50',
                'warning' => '#FFB300',
                'info' => '#00BCD4',
                'purple' => '#9C27B0',
                'danger' => '#F44336',
            ];
            $warna = $colorMap[$request->warna_select] ?? $kegiatan->warna;
        }

        $kegiatan->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
            'video' => $videoPath,
            'ikon' => $request->ikon,
            'tags' => $tags,
            'warna' => $warna,
            'status' => $request->boolean('status'),
            'urutan' => $request->urutan ?? $kegiatan->urutan
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui');
    }

    /* ================= SHOW KEGIATAN ================= */

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    /* ================= DELETE KEGIATAN ================= */
    public function destroy($id): JsonResponse
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            // Hapus file gambar jika ada
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            // Hapus file video lokal jika ada (bukan YouTube)
            $isLocalVideo = $kegiatan->video && !$this->isYouTubeUrl($kegiatan->video);
            if ($isLocalVideo && Storage::disk('public')->exists($kegiatan->video)) {
                Storage::disk('public')->delete($kegiatan->video);
            }

            $kegiatan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan berhasil dihapus.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Kegiatan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            // Jika terjadi error lain (termasuk constraint violation)
            Log::error('Error deleting Kegiatan: ' . $e->getMessage()); // Log error untuk debugging
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus kegiatan. Silakan coba lagi.'
            ], 500); // 500 Internal Server Error
        }
    }

    /* ================= UPDATE STATUS ================= */

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update(['status' => $request->status]);

        $statusText = $request->status ? 'diaktifkan' : 'dinonaktifkan';

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status kegiatan berhasil ' . $statusText
            ]);
        }

        return back()->with('success', 'Status kegiatan berhasil ' . $statusText);
    }

    /* ================= UPDATE URUTAN ================= */

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array'
        ]);

        foreach ($request->order as $index => $id) {
            Kegiatan::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /* ================= HELPER: CHECK YOUTUBE URL ================= */

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

    /* ================= BULK ACTIONS ================= */

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:kegiatans,id'
        ]);

        $ids = $request->ids;

        switch ($request->action) {
            case 'delete':
                $count = 0;
                foreach ($ids as $id) {
                    $kegiatan = Kegiatan::find($id);
                    if ($kegiatan) {
                        // Hapus file terkait
                        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                            Storage::disk('public')->delete($kegiatan->gambar);
                        }

                        $isLocalVideo = $kegiatan->video && !$this->isYouTubeUrl($kegiatan->video);
                        if ($isLocalVideo && Storage::disk('public')->exists($kegiatan->video)) {
                            Storage::disk('public')->delete($kegiatan->video);
                        }

                        $kegiatan->delete();
                        $count++;
                    }
                }
                $message = $count . ' kegiatan berhasil dihapus';
                break;

            case 'activate':
                $count = Kegiatan::whereIn('id', $ids)->update(['status' => true]);
                $message = $count . ' kegiatan berhasil diaktifkan';
                break;

            case 'deactivate':
                $count = Kegiatan::whereIn('id', $ids)->update(['status' => false]);
                $message = $count . ' kegiatan berhasil dinonaktifkan';
                break;

            default:
                return back()->with('error', 'Aksi tidak valid');
        }

        return back()->with('success', $message);
    }

    /**
     * 🔥 AUTO RESIZE + COMPRESS GAMBAR KEGIATAN
     */
    private function processImage($file): string
    {
        $filename = Str::uuid() . '.webp';
        $path = 'kegiatan/gambar/' . $filename;

        $image = $this->image
            ->read($file)
            ->scaleDown(1200)   // ⬅️ resize max 1200px (tidak upscale)
            ->toWebp(75);       // ⬅️ compress + webp

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }
}
