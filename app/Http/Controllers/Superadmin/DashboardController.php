<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Ppdb; // ✅ Sudah ada di folder Models
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'admins' => User::where('role', 'admin')->count(),
            'superadmins' => User::where('role', 'superadmin')->count(), // tambahkan ini biar lengkap
            'artikel' => Artikel::count(),
            'galeri' => Galeri::count(),
            'ppdb' => Ppdb::count(),
            'prestasi' => \App\Models\Prestasi::count(),
            'kegiatan' => \App\Models\Kegiatan::count(),
            'staff' => \App\Models\Staff::count(),
        ];

        return view('superadmin.dashboard', compact('stats'));
    }
}