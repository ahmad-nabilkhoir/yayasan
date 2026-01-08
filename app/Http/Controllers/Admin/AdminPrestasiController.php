<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi; // Sederhanakan import jika tidak dipakai semua
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPrestasiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Prestasi::latest();

        // 2. Filter Berdasarkan Kata Kunci (Judul) - Tadi ini yang kurang
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 3. Filter Berdasarkan Unit Sekolah (TK/SD)
        if ($request->filled('sekolah')) {
            $query->where('sekolah', $request->sekolah);
        }

        // 4. Filter Berdasarkan Tahun (Jika ada dropdown tahun)
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // 5. Eksekusi Pagination
        // Gunakan appends agar saat pindah halaman filter tidak hilang
        $prestasi = $query->paginate(12)->appends($request->query());

        // List tahun untuk dropdown filter (opsional jika ingin dipakai)
        $tahunList = Prestasi::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.prestasi.index', compact('prestasi', 'tahunList'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'sub_judul' => 'nullable|max:255',
            'sekolah' => 'required|in:TK,SD',
            'tahun' => 'required|integer|min:2010|max:' . (date('Y') + 1),
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'deskripsi' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil disimpan');
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'sub_judul' => 'nullable|max:255',
            'sekolah' => 'required|in:TK,SD',
            'tahun' => 'required|integer|min:2010|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'deskripsi' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }
}