<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    /**
     * Menampilkan halaman Tentang untuk pengunjung (Frontend)
     */
    public function index()
    {
        // 1. Ambil data Sejarah/Profil
        $tentang = Tentang::first();

        // 2. Ambil data Staff berdasarkan kategori
        $pimpinan = Staff::where('kategori', 'pimpinan')->orderBy('urutan', 'asc')->get();
        $kepsek = Staff::where('kategori', 'kepsek')->orderBy('urutan', 'asc')->get();
        $guru = Staff::where('kategori', 'guru')->orderBy('urutan', 'asc')->get();

        return view('pages.tentang', compact('tentang', 'pimpinan', 'kepsek', 'guru'));
    }

    /**
     * Menampilkan halaman Manajemen Tentang di Admin
     */
    public function adminIndex()
    {
        $tentang = Tentang::first();
        return view('admin.tentang.index', compact('tentang'));
    }

    /**
     * Menyimpan atau memperbarui data Sejarah/Profil (Termasuk Foto Header)
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $tentang = Tentang::first() ?? new Tentang();

        $tentang->judul = $request->judul;
        $tentang->isi = $request->isi;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tentang->foto) {
                Storage::disk('public')->delete($tentang->foto);
            }
            // Simpan foto baru ke folder 'tentang'
            // Ini akan otomatis membuat folder 'storage/app/public/tentang'
            $path = $request->file('foto')->store('tentang', 'public');
            $tentang->foto = $path;
        }

        $tentang->save();

        return redirect()->back()->with('success', 'Data Sejarah berhasil diperbarui.');
    }
}