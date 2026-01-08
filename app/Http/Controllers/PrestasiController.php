<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi; 
class PrestasiController extends Controller
{
public function index(Request $request)
    {
        $query = Prestasi::latest();

        // Filter by sekolah
        if ($request->has('sekolah')) {
            $query->where('sekolah', $request->sekolah);
        }

        // Filter by tahun
        if ($request->has('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $prestasi = $query->paginate(12);

        // Get unique years for filter
        $tahunList = Prestasi::selectRaw('DISTINCT tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('pages.prestasi.index', compact('prestasi', 'tahunList'));
    }
}