<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Menampilkan halaman Tentang untuk pengunjung (Frontend)
     */
    public function index()
    {
        // Ambil data Sejarah/Profil
        $tentang = Tentang::first();

        // Ambil data Staff berdasarkan kategori
        $pimpinan = Staff::where('kategori', 'pimpinan')->orderBy('urutan', 'asc')->get();
        $kepsek = Staff::where('kategori', 'kepsek')->orderBy('urutan', 'asc')->get();
        $guru = Staff::where('kategori', 'guru')->orderBy('urutan', 'asc')->get();

        return view('pages.tentang', compact('tentang', 'pimpinan', 'kepsek', 'guru'));
    }
}