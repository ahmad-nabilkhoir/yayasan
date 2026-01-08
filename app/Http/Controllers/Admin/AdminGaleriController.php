<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $kategoriFilter = $request->input('kategori', 'all');

        // Query dengan filter
        $query = Galeri::latest();

        if ($kategoriFilter != 'all') {
            $query->where('kategori', $kategoriFilter);
        }

        $galeri = $query->paginate(12);

        // Ambil semua kategori unik dari database
        $allKategoris = Galeri::select('kategori')->distinct()->pluck('kategori');

        // Hitung statistik untuk setiap kategori
        $stats = [];
        foreach ($allKategoris as $kategori) {
            $stats[$kategori] = Galeri::where('kategori', $kategori)->count();
        }

        // Map warna untuk kategori
        $colorMap = [
            'TK' => '#fbbf24',
            'SD' => '#3b82f6'
        ];

        return view('admin.galeri.index', compact('galeri', 'allKategoris', 'stats', 'colorMap', 'kategoriFilter'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:TK,SD',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:TK,SD',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) Storage::disk('public')->delete($galeri->foto);
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->foto) Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Foto dihapus');
    }
}