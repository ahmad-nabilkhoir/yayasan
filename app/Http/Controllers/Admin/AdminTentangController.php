<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class AdminTentangController extends Controller
{
    /**
     * Tampilkan profil yayasan
     */
    public function index()
    {
        // 🔥 Ambil satu-satunya data Tentang
        $tentang = Tentang::first();

        $staff = Staff::orderBy('urutan', 'asc')->get();

        return view('admin.tentang.index', compact('tentang', 'staff'));
    }

    /**
     * Form create (hanya jika belum ada data)
     */
    public function create()
    {
        // 🔐 Cegah create jika data sudah ada
        if (Tentang::exists()) {
            return redirect()->route('admin.tentang.index');
        }

        return view('admin.tentang.create');
    }

    /**
     * Simpan data pertama kali
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
        ]);

        // 🔥 Pastikan hanya 1 data
        Tentang::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Konten berhasil disimpan');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $tentang = Tentang::findOrFail($id);
        return view('admin.tentang.edit', compact('tentang'));
    }

    /**
     * Update konten
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
        ]);

        // 🔥 Update pasti ke record yang sama
        Tentang::updateOrCreate(
            ['id' => $id],
            $validated
        );

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Konten berhasil diperbarui');
    }

    /**
     * Upload gambar CKEditor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
        $manager = new ImageManager(new Driver());

        $file = $request->file('upload');

        $filename = Str::uuid() . '.webp';
        $path = 'tentang/' . $filename;

        $image = $manager->read($file)
            ->scale(width: 1200)   // max width
            ->toWebp(75);          // compress

        Storage::disk('public')->put($path, (string) $image);

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Hapus konten
     */
    public function destroy($id)
    {
        Tentang::where('id', $id)->delete();

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Konten berhasil dihapus');
    }
}