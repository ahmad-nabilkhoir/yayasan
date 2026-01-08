<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Ambil filter dari request atau dari session
        $kategoriFilter = $request->input('kategori', session('galeri_filter', 'all'));

        // Simpan filter ke session
        session(['galeri_filter' => $kategoriFilter]);

        // Terapkan filter jika bukan 'all'
        if ($kategoriFilter != 'all') {
            $query->where('kategori', $kategoriFilter);
        }

        $galeri = $query->orderBy('created_at', 'desc')->paginate(12);

        // PERBAIKAN: Gunakan 'pages.galeri.index' bukan 'page.galeri.index'
        return view('pages.galeri.index', compact('galeri', 'kategoriFilter'));
    }

    public function tk()
    {
        // Simpan filter ke session dan redirect
        session(['galeri_filter' => 'TK']);
        return redirect()->route('galeri.index', ['kategori' => 'TK']);
    }

    public function sd()
    {
        session(['galeri_filter' => 'SD']);
        return redirect()->route('galeri.index', ['kategori' => 'SD']);
    }
}