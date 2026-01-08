<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Tentang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'published')->latest()->take(6)->get();
        $prestasi = Prestasi::latest()->take(6)->get();
        $tentang = Tentang::first();
        $pimpinan = \App\Models\Staff::where('kategori', 'pimpinan')->first();

        return view('pages.home', compact('artikel', 'prestasi', 'tentang', 'pimpinan'));
    }
}