<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class PageController extends Controller
{
    // PROFIL
    public function visiMisi() { return view('pages.profil.visi-misi'); }
    public function akreditasi() { return view('pages.profil.akreditasi'); }

    // INFORMASI
    public function tataTertib() { return view('pages.informasi.tata-tertib'); }
    public function ekstrakurikuler() { return view('pages.informasi.ekstrakurikuler'); }
    public function ppdb() { return view('pages.informasi.ppdb'); }
    public function alurPendaftaran() { return view('pages.informasi.alur-pendaftaran'); }
    public function pembayaran() { return view('pages.informasi.pembayaran'); }
    public function kurikulum() { return view('pages.kurikulum'); }

    // KEGIATAN (Halaman Publik)
    public function kegiatan()
    {
        // Pastikan model Kegiatan punya scope active dan ordered
        // Atau gunakan manual: where('status', true)->orderBy('urutan', 'asc')
        $kegiatans = Kegiatan::where('status', true)->orderBy('urutan', 'asc')->get();
        return view('pages.kegiatan.index', compact('kegiatans'));
    }
}