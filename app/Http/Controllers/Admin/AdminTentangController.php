<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTentangController extends Controller
{
    public function index()
    {
        $tentang = Tentang::first();
        $staff = Staff::orderBy('urutan', 'asc')->get();
        $tahunList = [2023, 2024, 2025];
        $prestasi = collect([]); // Sesuaikan jika perlu

        return view('admin.tentang.index', compact('tentang', 'staff', 'tahunList', 'prestasi'));
    }

    public function create()
    {
        return view('admin.tentang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
        ]);

        Tentang::create($validated);
        return redirect()->route('admin.tentang.index')->with('success', 'Konten berhasil dibuat!');
    }

    public function edit($id)
    {
        $tentang = Tentang::findOrFail($id);
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(Request $request, $id)
    {
        $tentang = Tentang::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
        ]);

        $tentang->update($validated);

        return redirect()->route('admin.tentang.index')->with('success', 'Konten berhasil diupdate');
    }

    // FUNGSI BARU UNTUK UPLOAD GAMBAR DARI CKEDITOR
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $url = asset('uploads/' . $fileName);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url
            ]);
        }
    }
    public function destroy($id)
    {
        $tentang = Tentang::findOrFail($id);
        $tentang->delete();

        return redirect()->route('admin.tentang.index')
            ->with('success', 'Konten berhasil dihapus!');
    }
}