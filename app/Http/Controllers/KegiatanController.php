<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Variabel kategori yang bisa digunakan di semua method
    protected $kategoriOptions = [
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

    // Constructor untuk share ke semua view
    public function __construct()
    {
        view()->share('kategoriOptions', $this->kategoriOptions);
    }

    /* ================= PUBLIC LIST KEGIATAN ================= */

    public function index(Request $request)
    {
        $query = Kegiatan::where('status', true);  // Hanya tampilkan yang aktif

        // Filter berdasarkan kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
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

        // Sorting untuk public (default: terbaru)
        $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');

        $kegiatans = $query->paginate(12);

        // PERBAIKI: Pastikan setiap kegiatan memiliki slug yang valid
        foreach ($kegiatans as $kegiatan) {
            $kegiatan->ensureSlug();
        }

        return view('pages.kegiatan.index', compact('kegiatans'));
    }

    /* ================= PUBLIC SHOW DETAIL ================= */

    public function show($slug)
    {
        // Handle jika slug adalah format 'kegiatan-{id}'
        if (str_starts_with($slug, 'kegiatan-')) {
            $id = str_replace('kegiatan-', '', $slug);
            $kegiatan = Kegiatan::where('status', true)->find($id);

            if ($kegiatan) {
                $correctSlug = $kegiatan->route_slug;
                if ($slug !== $correctSlug) {
                    return redirect()->route('kegiatan.show', $correctSlug, 301);
                }
            } else {
                abort(404);
            }
        } else {
            // Cari berdasarkan slug
            $kegiatan = Kegiatan::where('status', true)
                ->where('slug', $slug)
                ->first();

            // Fallback: cari berdasarkan ID jika slug adalah numeric
            if (!$kegiatan && is_numeric($slug)) {
                $kegiatan = Kegiatan::where('status', true)->find($slug);

                if ($kegiatan) {
                    return redirect()->route('kegiatan.show', $kegiatan->route_slug, 301);
                }
            }

            if (!$kegiatan) {
                abort(404);
            }
        }

        // Kegiatan terkait (dalam kategori yang sama)
        $related = Kegiatan::where('kategori', $kegiatan->kategori)
            ->where('id', '!=', $kegiatan->id)
            ->where('status', true)
            ->limit(4)
            ->get();

        // $kategoriOptions sudah dishare melalui constructor
        return view('pages.kegiatan.show', compact('kegiatan', 'related'));
    }

    /* ================= PUBLIC BY CATEGORY ================= */

    public function kategori($kategori)
    {
        $kategoriNama = $this->getKategoriName($kategori);

        $kegiatans = Kegiatan::where('kategori', $kategori)
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Pastikan slug valid
        foreach ($kegiatans as $kegiatan) {
            $kegiatan->ensureSlug();
        }

        return view('pages.kegiatan.kategori', compact('kegiatans', 'kategoriNama'));
    }

    /* ================= HELPER: GET KATEGORI NAME ================= */

    private function getKategoriName($kategori)
    {
        $kategoriMap = [
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

        return $kategoriMap[$kategori] ?? $kategori;
    }
}