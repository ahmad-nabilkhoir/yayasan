<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::published()->latest();

        // Filter berdasarkan jenis
        if ($request->has('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('ringkasan', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan tahun (untuk jurnal)
        if ($request->has('tahun')) {
            $query->whereYear('published_at', $request->tahun);
        }

        $artikel = $query->paginate(12);

        // Get years for filter
        $years = Artikel::published()
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Get latest articles for sidebar
        $latest_articles = Artikel::published()
            ->latest()
            ->take(5)
            ->get();

        return view('pages.artikel.index', compact('artikel', 'years', 'latest_articles'));
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views dengan method yang lebih aman
        $artikel->incrementViews();

        // Related articles based on keywords and category
        $related = Artikel::published()
            ->where('id', '!=', $artikel->id)
            ->where(function ($query) use ($artikel) {
                // Match by keywords if available
                if (!empty($artikel->keywords)) {
                    foreach ($artikel->keywords as $keyword) {
                        $query->orWhereJsonContains('keywords', $keyword);
                    }
                }
                // Match by jenis
                $query->orWhere('jenis', $artikel->jenis);
            })
            ->latest()
            ->take(4)
            ->get();

        // If not enough related articles, get latest articles of same type
        if ($related->count() < 3) {
            $additional = Artikel::published()
                ->where('id', '!=', $artikel->id)
                ->where('jenis', $artikel->jenis)
                ->whereNotIn('id', $related->pluck('id'))
                ->latest()
                ->take(4 - $related->count())
                ->get();

            $related = $related->merge($additional);
        }

        // Get popular articles for sidebar
        $popular_articles = Artikel::published()
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('pages.artikel.show', compact('artikel', 'related', 'popular_articles'));
    }

    // API untuk mendapatkan artikel terbaru
    public function latest(Request $request)
    {
        $limit = $request->get('limit', 3);

        $articles = Artikel::published()
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'judul' => $article->judul,
                    'slug' => $article->slug,
                    'thumbnail' => $article->thumbnail_url,
                    'ringkasan' => $article->ringkasan,
                    'excerpt' => $article->excerpt,
                    'jenis' => $article->jenis,
                    'jenis_label' => $article->jenis_label,
                    'penulis' => $article->penulis,
                    'published_at' => $article->published_at->format('d M Y'),
                    'views' => $article->views,
                    'has_pdf' => $article->hasPdf(),
                ];
            });

        return response()->json($articles);
    }

    // Download PDF untuk public
    public function downloadPdf($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if (!$artikel->hasPdf()) {
            abort(404);
        }

        $artikel->incrementViews();
        // Gunakan Storage disk 'public' untuk mengunduh file yang tersimpan di storage/app/public
        if (!Storage::disk('public')->exists($artikel->file_pdf)) {
            abort(404);
        }

        // Unduh langsung dari filesystem untuk menghindari error metadata Flysystem
        $fullPath = storage_path('app/public/' . $artikel->file_pdf);
        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->download(
            $fullPath,
            Str::slug($artikel->judul) . '.pdf'
        );
    }

    // Preview PDF untuk public (embedded)
    public function previewPdf($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if (!$artikel->hasPdf()) {
            abort(404);
        }

        $artikel->incrementViews();

        $pdfUrl = asset('storage/' . $artikel->file_pdf);

        return view('pages.artikel.preview-pdf', compact('artikel', 'pdfUrl'));
    }
}