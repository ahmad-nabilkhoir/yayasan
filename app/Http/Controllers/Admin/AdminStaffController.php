<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStaffController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
    {
        $query = Staff::query();
        
        // Filter kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }
        
        // Urutkan dan paginate
        $staff = $query->orderBy('urutan', 'asc')->paginate(10); // GANTI get() dengan paginate(10)
        
        // Hitung statistik untuk filter buttons
        $totalPimpinan = Staff::where('kategori', 'pimpinan')->count();
        $totalKepsek = Staff::where('kategori', 'kepsek')->count();
        $totalGuru = Staff::where('kategori', 'guru')->count();
        $totalAll = Staff::count();
        
        return view('admin.staff.index', compact('staff', 'totalPimpinan', 'totalKepsek', 'totalGuru', 'totalAll'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:pimpinan,kepsek,guru',
            'urutan' => 'required|integer',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        Staff::create($validated);
        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kategori' => 'required|in:pimpinan,kepsek,guru',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($staff->foto) Storage::disk('public')->delete($staff->foto);
            $validated['foto'] = $request->file('foto')->store('staff', 'public');
        }

        $staff->update($validated);
        return redirect()->route('admin.staff.index')->with('success', 'Data staff diperbarui');
    }

    public function destroy(Staff $staff)
    {
        // 1. Hapus Foto dari Storage jika ada
        if ($staff->foto && Storage::disk('public')->exists($staff->foto)) {
            Storage::disk('public')->delete($staff->foto);
        }

        // 2. Hapus Data dari Database
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff dan file foto berhasil dihapus permanen.');
    }
}