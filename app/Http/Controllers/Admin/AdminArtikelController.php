<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::latest();

        // Filter berdasarkan jenis (artikel/jurnal)
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('ringkasan', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan tahun (untuk jurnal)
        if ($request->filled('tahun')) {
            $query->whereYear('published_at', $request->tahun);
        }

        $artikel = $query->paginate(15)->withQueryString();

        // Get years for filter
        $years = Artikel::selectRaw('YEAR(published_at) as year')
            ->whereNotNull('published_at')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.artikel.index', compact('artikel', 'years'));
    }

    public function create()
    {
        return view('admin.artikel.form', [
            'artikel' => null,
            'jenis_options' => [
                'artikel' => 'Artikel',
                'jurnal' => 'Jurnal'
            ]
        ]);
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.show', compact('artikel'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/artikel_konten'), $fileName);

            $url = asset('storage/artikel_konten/' . $fileName);
            return response()->json(['uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => 'No file uploaded']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'nullable|max:500',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
            'jenis' => 'required|in:artikel,jurnal',
            'penulis' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'keywords' => 'nullable|string',
            'referensi' => 'nullable|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('artikel', 'public');

        // Upload file PDF jika ada (untuk jurnal)
        $pdfPath = null;
        if ($request->hasFile('file_pdf') && $request->jenis == 'jurnal') {
            $pdfPath = $request->file('file_pdf')->store('artikel/jurnal', 'public');
        }

        // Generate slug
        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $count = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Parse keywords
        $keywords = $request->keywords ? array_map('trim', explode(',', $request->keywords)) : [];

        $artikel = Artikel::create([
            'judul' => $validated['judul'],
            'ringkasan' => $validated['ringkasan'],
            'slug' => $slug,
            'thumbnail' => $thumbnailPath,
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'jenis' => $validated['jenis'],
            'penulis' => $validated['penulis'] ?? null,
            'tahun_terbit' => $validated['tahun_terbit'] ?? null,
            'referensi' => $validated['referensi'] ?? null,
            'keywords' => $keywords,
            'file_pdf' => $pdfPath,
            'views' => 0,
            'published_at' => $validated['status'] == 'published' ? now() : null,
        ]);

        return redirect()->route('admin.artikel.index')
            ->with('success', $artikel->jenis_label . ' berhasil ditambahkan');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('admin.artikel.form', [
            'artikel' => $artikel,
            'jenis_options' => [
                'artikel' => 'Artikel',
                'jurnal' => 'Jurnal'
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'nullable|max:500',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isi' => 'required',
            'status' => 'required|in:draft,published',
            'jenis' => 'required|in:artikel,jurnal',
            'penulis' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'keywords' => 'nullable|string',
            'referensi' => 'nullable|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Update thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('artikel', 'public');
        } else {
            $thumbnailPath = $artikel->thumbnail;
        }

        // Update file PDF jika ada
        $pdfPath = $artikel->file_pdf;
        if ($request->hasFile('file_pdf') && $request->jenis == 'jurnal') {
            // Hapus file PDF lama jika ada
            if ($pdfPath && Storage::disk('public')->exists($pdfPath)) {
                Storage::disk('public')->delete($pdfPath);
            }
            $pdfPath = $request->file('file_pdf')->store('artikel/jurnal', 'public');
        } elseif ($request->jenis == 'artikel' && $pdfPath) {
            // Jika jenis diubah dari jurnal ke artikel, hapus file PDF
            if (Storage::disk('public')->exists($pdfPath)) {
                Storage::disk('public')->delete($pdfPath);
            }
            $pdfPath = null;
        }

        // Parse keywords
        $keywords = $request->keywords ? array_map('trim', explode(',', $request->keywords)) : [];

        // Update published_at jika status berubah menjadi published
        $published_at = $artikel->published_at;
        if ($artikel->status != 'published' && $validated['status'] == 'published') {
            $published_at = now();
        } elseif ($validated['status'] == 'draft') {
            $published_at = null;
        }

        $artikel->update([
            'judul' => $validated['judul'],
            'ringkasan' => $validated['ringkasan'],
            'thumbnail' => $thumbnailPath,
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'jenis' => $validated['jenis'],
            'penulis' => $validated['penulis'] ?? null,
            'tahun_terbit' => $validated['tahun_terbit'] ?? null,
            'referensi' => $validated['referensi'] ?? null,
            'keywords' => $keywords,
            'file_pdf' => $pdfPath,
            'published_at' => $published_at,
        ]);

        return redirect()->route('admin.artikel.index')
            ->with('success', $artikel->jenis_label . ' berhasil diupdate');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus file thumbnail
        if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }

        // Hapus file PDF jika ada
        if ($artikel->file_pdf && Storage::disk('public')->exists($artikel->file_pdf)) {
            Storage::disk('public')->delete($artikel->file_pdf);
        }

        $jenis_label = $artikel->jenis_label;
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', $jenis_label . ' berhasil dihapus');
    }

    // Tambahan: Download PDF
    public function downloadPdf($id)
    {
        $artikel = Artikel::findOrFail($id);

        if (!$artikel->file_pdf || !Storage::disk('public')->exists($artikel->file_pdf)) {
            return back()->with('error', 'File PDF tidak ditemukan');
        }

        // PERBAIKAN: Gunakan Storage::download() bukan Storage::disk('public')->download()
        return Storage::download(
            'public/' . $artikel->file_pdf,
            Str::slug($artikel->judul) . '.pdf'
        );
    }

    // Tambahan: Preview jurnal
    public function previewJurnal($id)
    {
        $artikel = Artikel::findOrFail($id);

        if (!$artikel->file_pdf || !Storage::disk('public')->exists($artikel->file_pdf)) {
            return back()->with('error', 'File PDF tidak ditemukan');
        }

        // PERBAIKAN: Gunakan Storage::url() bukan Storage::disk('public')->url()
        $pdfUrl = Storage::url($artikel->file_pdf);

        return view('admin.artikel.preview-jurnal', compact('artikel', 'pdfUrl'));
    }
}