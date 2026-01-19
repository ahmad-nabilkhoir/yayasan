<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $kategoriFilter = $request->input(
            'kategori',
            session('galeri_filter', 'all')
        );

        session(['galeri_filter' => $kategoriFilter]);

        $query = Galeri::query();

        if ($kategoriFilter !== 'all') {
            $query->where('kategori', $kategoriFilter);
        }

        $galeri = $query->latest()->paginate(12);

        return view('pages.galeri.index', compact(
            'galeri',
            'kategoriFilter'
        ));
    }

    public function tk()
    {
        session(['galeri_filter' => 'TK']);
        return redirect()->route('galeri.index', ['kategori' => 'TK']);
    }

    public function sd()
    {
        session(['galeri_filter' => 'SD']);
        return redirect()->route('galeri.index', ['kategori' => 'SD']);
    }
}