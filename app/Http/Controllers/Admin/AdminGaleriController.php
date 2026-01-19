<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminGaleriController extends Controller
{
    protected ImageManager $image;

    public function __construct()
    {
        $this->image = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        $kategoriFilter = $request->input('kategori', 'all');

        $query = Galeri::latest();

        if ($kategoriFilter !== 'all') {
            $query->where('kategori', $kategoriFilter);
        }

        $galeri = $query->paginate(12);

        $allKategoris = Galeri::select('kategori')->distinct()->pluck('kategori');

        $stats = [];
        foreach ($allKategoris as $kategori) {
            $stats[$kategori] = Galeri::where('kategori', $kategori)->count();
        }

        $colorMap = [
            'TK' => '#fbbf24',
            'SD' => '#3b82f6',
        ];

        return view('admin.galeri.index', compact(
            'galeri',
            'allKategoris',
            'stats',
            'colorMap',
            'kategoriFilter'
        ));
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
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'deskripsi' => 'nullable'
        ]);

        $validated['foto'] = $this->processImage($request->file('foto'));

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan');
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'deskripsi' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeri->foto);
            $validated['foto'] = $this->processImage($request->file('foto'));
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto dihapus');
    }

    /**
     * 🔥 AUTO RESIZE + COMPRESS + WEBP
     */
    private function processImage($file): string
    {
        $filename = Str::uuid() . '.webp';
        $path = 'galeri/' . $filename;

        $image = $this->image->read($file)
            ->scale(width: 1200)
            ->toWebp(75);

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }
}