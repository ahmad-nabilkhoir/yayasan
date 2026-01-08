<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // This is already imported
use Carbon\Carbon;

class AdminPpdbController extends Controller
{
    /* ================= LIST DATA PPDB ================= */

    public function index(Request $request)
    {
        $query = Ppdb::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('no_pendaftaran', 'like', "%$search%")
                    ->orWhere('nik', 'like', "%$search%")
                    ->orWhere('nama_ayah', 'like', "%$search%")
                    ->orWhere('nama_ibu', 'like', "%$search%")
                    ->orWhere('no_hp_ayah', 'like', "%$search%")
                    ->orWhere('asal_sekolah', 'like', "%$search%");
            });
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_mulai . ' 00:00:00', $request->tanggal_akhir . ' 23:59:59']);
        }

        if ($request->filled('sort_by')) {
            $sortField = $request->sort_by;
            $sortDirection = $request->get('sort_dir', 'desc');
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest();
        }

        $registrations = $query->paginate(20);

        // HITUNG SEMUA STATISTIK YANG DIPERLUKAN
        $total = Ppdb::count();
        $pending = Ppdb::where('status', 'menunggu')->count();
        $accepted = Ppdb::where('status', 'diterima')->count();
        $rejected = Ppdb::where('status', 'ditolak')->count();

        // Persentase status
        $persenMenunggu = $total > 0 ? round(($pending / $total) * 100, 1) : 0;
        $persenDiterima = $total > 0 ? round(($accepted / $total) * 100, 1) : 0;
        $persenDitolak = $total > 0 ? round(($rejected / $total) * 100, 1) : 0;

        // Statistik hari ini
        $todayStats = [
            'total' => Ppdb::whereDate('created_at', today())->count(),
            'pending' => Ppdb::where('status', 'menunggu')->whereDate('created_at', today())->count(),
            'accepted' => Ppdb::where('status', 'diterima')->whereDate('created_at', today())->count(),
            'rejected' => Ppdb::where('status', 'ditolak')->whereDate('created_at', today())->count(),
        ];

        // Statistik bulanan
        $bulanIni = Ppdb::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)->count();

        $bulanLalu = Ppdb::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)->count();

        // Persentase pertumbuhan
        $persentasePertumbuhan = $bulanLalu > 0
            ? round((($bulanIni - $bulanLalu) / $bulanLalu) * 100, 1)
            : ($bulanIni > 0 ? 100 : 0);

        // Rata-rata harian
        $hariDalamBulan = now()->daysInMonth;
        $rataHarian = $hariDalamBulan > 0
            ? round($bulanIni / $hariDalamBulan, 1)
            : 0;

        // Tingkat penerimaan
        $tingkatPenerimaan = $total > 0
            ? round(($accepted / $total) * 100, 1)
            : 0;

        // Distribusi jam pendaftaran (untuk statistik detail)
        $jamPagi = Ppdb::whereTime('created_at', '>=', '06:00:00')->whereTime('created_at', '<', '12:00:00')->count();
        $jamSiang = Ppdb::whereTime('created_at', '>=', '12:00:00')->whereTime('created_at', '<', '18:00:00')->count();
        $jamMalam = Ppdb::whereTime('created_at', '>=', '18:00:00')->whereTime('created_at', '<', '24:00:00')->count();
        $jamDini = Ppdb::whereTime('created_at', '>=', '00:00:00')->whereTime('created_at', '<', '06:00:00')->count();

        $totalJam = $jamPagi + $jamSiang + $jamMalam + $jamDini;
        $persenPagi = $totalJam > 0 ? round(($jamPagi / $totalJam) * 100, 1) : 25;
        $persenSiang = $totalJam > 0 ? round(($jamSiang / $totalJam) * 100, 1) : 50;
        $persenMalam = $totalJam > 0 ? round(($jamMalam / $totalJam) * 100, 1) : 20;
        $persenDini = $totalJam > 0 ? round(($jamDini / $totalJam) * 100, 1) : 5;

        // Data untuk view
        $stats = [
            'total' => $total,
            'pending' => $pending,
            'accepted' => $accepted,
            'rejected' => $rejected,
        ];

        return view('admin.registrations.index', compact(
            'registrations',
            'stats',
            'todayStats',
            'persenMenunggu',
            'persenDiterima',
            'persenDitolak',
            'bulanIni',
            'bulanLalu',
            'persentasePertumbuhan',
            'rataHarian',
            'tingkatPenerimaan',
            'persenPagi',
            'persenSiang',
            'persenMalam',
            'persenDini'
        ));
    }

    /* ================= DETAIL PPDB ================= */

    public function show($id)
    {
        $registration = Ppdb::findOrFail($id);

        // Format tanggal untuk display
        $registration->tanggal_lahir_formatted = Carbon::parse($registration->tanggal_lahir)->translatedFormat('d F Y');
        $registration->created_at_formatted = Carbon::parse($registration->created_at)->translatedFormat('d F Y H:i');

        if ($registration->disetujui_pada) {
            $registration->disetujui_pada_formatted = Carbon::parse($registration->disetujui_pada)->translatedFormat('d F Y H:i');
        }

        return view('admin.registrations.show', compact('registration'));
    }

    /* ================= APPROVE PPDB ================= */

    public function approve(Request $request, $id)
    {
        $ppdb = Ppdb::findOrFail($id);

        $ppdb->update([
            'status' => 'diterima',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
            'catatan_admin' => $request->catatan_admin ?? $ppdb->catatan_admin,
        ]);

        // Format data untuk WhatsApp
        $tanggalLahir = Carbon::parse($ppdb->tanggal_lahir)->translatedFormat('d F Y');

        $noHp = $this->formatWhatsAppNumber($ppdb->no_hp_ayah);

        $message = "🎉 *SELAMAT! PENDAFTARAN DITERIMA*\n\n" .
            "Assalamu'alaikum Warahmatullahi Wabarakatuh\n\n" .
            "Kepada Yth. Bapak/Ibu *{$ppdb->nama_ayah}*,\n" .
            "(Orang Tua/Wali dari *{$ppdb->nama}*)\n\n" .
            "Dengan ini kami informasikan bahwa:\n\n" .
            "📋 *DATA PENDAFTARAN*\n" .
            "══════════════════════════════\n" .
            "• Nama Calon Siswa: *{$ppdb->nama}*\n" .
            "• No. Pendaftaran: *{$ppdb->no_pendaftaran}*\n" .
            "• Asal Sekolah: *{$ppdb->asal_sekolah}*\n\n" .
            "✅ *STATUS: DITERIMA*\n\n" .
            "📅 *TAHAP SELANJUTNYA*\n" .
            "══════════════════════════════\n" .
            "1. *Daftar Ulang* di sekolah\n" .
            "   📍 Alamat: Jl. Raya Kurungan, Nyawa, Pal.12 Gg Sholeha, Pesawaran, Lampung\n" .
            "   🕒 Jam: 07.30 - 14.00 WIB (Senin-Jumat)\n" .
            "   📅 Periode: " . now()->addDay()->translatedFormat('d F Y') . " - " . now()->addDays(7)->translatedFormat('d F Y') . "\n\n" .
            "2. *Dokumen yang dibawa*:\n" .
            "   • Fotokopi Akte Kelahiran\n" .
            "   • Fotokopi Kartu Keluarga\n" .
            "   • Pas Foto 3x4 (2 lembar)\n" .
            "   • Fotokopi KTP Orang Tua\n\n" .
            "3. *Biaya Pendidikan*:\n" .
            "   • Uang Pangkal: Rp 2.500.000\n" .
            "   • SPP Bulanan: Rp 350.000\n" .
            "   • Seragam: Rp 850.000 (paket lengkap)\n\n" .
            "📞 *KONTAK ADMIN*\n" .
            "══════════════════════════════\n" .
            "• Telp: 0822-2583-2575\n" .
            "• Email: sekolahbaitulinsan@gmail.com\n" .
            "• Alamat: Jl. Raya Kurungan, Nyawa, Pal.12 Gg Sholeha, Pesawaran, Lampung\n\n" .
            "Terima kasih atas kepercayaan Bapak/Ibu.\n\n" .
            "Wassalamu'alaikum Warahmatullahi Wabarakatuh\n" .
            "*Tim PPDB SD IT Baitul Insan*";

        $waUrl = "https://wa.me/{$noHp}?text=" . urlencode($message);

        // Log aktivitas - FIXED: Remove backslash
        Log::info('User ' . Auth::user()->name . ' menerima pendaftaran ' . $ppdb->nama);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil diterima',
                'wa_url' => $waUrl,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Status berhasil diubah. <a href="' . $waUrl . '" target="_blank" class="underline">Kirim notifikasi WhatsApp</a>');
    }

    /* ================= REJECT PPDB ================= */

    public function reject(Request $request, $id)
    {
        $ppdb = Ppdb::findOrFail($id);

        $ppdb->update([
            'status' => 'ditolak',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
            'catatan_admin' => $request->catatan_admin ?? $ppdb->catatan_admin,
        ]);

        $noHp = $this->formatWhatsAppNumber($ppdb->no_hp_ayah);

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh\n\n" .
            "Kepada Yth. Bapak/Ibu *{$ppdb->nama_ayah}*,\n" .
            "(Orang Tua/Wali dari *{$ppdb->nama}*)\n\n" .
            "Terima kasih atas partisipasi dalam *Penerimaan Peserta Didik Baru (PPDB)*\n" .
            "SD IT Baitul Insan Tahun Ajaran 2025/2026.\n\n" .
            "Setelah melalui proses seleksi yang ketat, dengan berat hati kami sampaikan bahwa:\n\n" .
            "📋 *DATA PENDAFTARAN*\n" .
            "══════════════════════════════\n" .
            "• Nama Calon Siswa: *{$ppdb->nama}*\n" .
            "• No. Pendaftaran: *{$ppdb->no_pendaftaran}*\n" .
            "• Asal Sekolah: *{$ppdb->asal_sekolah}*\n\n" .
            "❌ *STATUS: BELUM DAPAT DITERIMA*\n\n" .
            "📝 *CATATAN*\n" .
            "══════════════════════════════\n" .
            "Keputusan ini berdasarkan pertimbangan:\n" .
            "• Kuota kelas yang terbatas\n" .
            "• Hasil seleksi administrasi\n" .
            "• Rasio jumlah pendaftar\n\n" .
            "🌟 *KATA MOTIVASI*\n" .
            "══════════════════════════════\n" .
            "\"Sesungguhnya bersama kesulitan ada kemudahan.\"\n" .
            "(QS. Al-Insyirah: 6)\n\n" .
            "Kami percaya Allah memiliki rencana yang lebih baik untuk putra/putri Bapak/Ibu.\n\n" .
            "📞 *KONTAK*\n" .
            "══════════════════════════════\n" .
            "Untuk informasi lebih lanjut:\n" .
            "📱 0822-2583-2575\n" .
            "📧 sekolahbaitulinsan@gmail.com\n\n" .
            "Jazakumullah khairan katsiran.\n\n" .
            "Wassalamu'alaikum Warahmatullahi Wabarakatuh\n" .
            "*Tim PPDB SD IT Baitul Insan*";

        $waUrl = "https://wa.me/{$noHp}?text=" . urlencode($message);

        // Log aktivitas - FIXED: Remove backslash
        Log::info('User ' . Auth::user()->name . ' menolak pendaftaran ' . $ppdb->nama);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil ditolak',
                'wa_url' => $waUrl,
            ]);
        }

        return redirect()
            ->back()
            ->with('info', 'Status berhasil diubah. <a href="' . $waUrl . '" target="_blank" class="underline">Kirim notifikasi WhatsApp</a>');
    }

    /* ================= UPDATE CATATAN ================= */

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $registration = Ppdb::findOrFail($id);
        $registration->update([
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Log aktivitas - FIXED: Remove backslash
        Log::info('User ' . Auth::user()->name . ' memperbarui catatan untuk ' . $registration->nama);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Catatan berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Catatan diperbarui.');
    }

    /* ================= UPDATE STATUS (Quick Update) ================= */

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $ppdb = Ppdb::findOrFail($id);

        $updateData = [
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin ?? $ppdb->catatan_admin,
        ];

        if ($request->status == 'diterima' || $request->status == 'ditolak') {
            $updateData['disetujui_pada'] = now();
            $updateData['disetujui_oleh'] = Auth::user()->name;
            $updateData['sudah_dihubungi'] = 1;
        }

        $ppdb->update($updateData);

        // Log aktivitas - FIXED: Remove backslash
        Log::info('User ' . Auth::user()->name . ' mengubah status ' . $ppdb->nama . ' menjadi ' . $request->status);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    /* ================= HAPUS DATA ================= */

    public function destroy($id)
    {
        Log::info('========== DELETE REQUEST START ==========');
        Log::info('ID: ' . $id);
        Log::info('Method: ' . request()->method());
        Log::info('Full URL: ' . request()->fullUrl());
        Log::info('IP: ' . request()->ip());
        Log::info('User Agent: ' . request()->userAgent());

        try {
            $registration = Ppdb::findOrFail($id);
            Log::info('Data ditemukan: ' . $registration->nama);

            // Simpan nama untuk response
            $registrationName = $registration->nama;

            // Hapus file (jika ada)
            $files = ['foto_anak', 'foto_kk', 'foto_akte', 'foto_ktp_ayah', 'foto_ktp_ibu'];
            foreach ($files as $fileField) {
                if ($registration->$fileField && Storage::disk('public')->exists($registration->$fileField)) {
                    Storage::disk('public')->delete($registration->$fileField);
                    Log::info('File dihapus: ' . $registration->$fileField);
                }
            }

            // Hapus dari database
            $registration->delete();

            Log::info('Data berhasil dihapus: ' . $registrationName);

            // Response untuk AJAX
            if (request()->ajax() || request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data ' . $registrationName . ' berhasil dihapus!'
                ]);
            }

            // Redirect untuk non-AJAX
            return redirect()->route('admin.registrations.index')
                ->with('success', 'Data ' . $registrationName . ' berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('ERROR DELETE: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            if (request()->ajax() || request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.registrations.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    /* ================= CONFIRM DELETE ================= */

    public function confirmDestroy($id)
    {
        $registration = Ppdb::findOrFail($id);

        return view('admin.registrations.confirm-destroy', compact('registration'));
    }

    public function destroyPost($id)
    {
        // Handle POST request dengan _method DELETE
        return $this->destroy($id);
    }

    /* ================= EXPORT CSV ================= */

    public function export(Request $request)
    {
        $query = Ppdb::query();

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_mulai . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('no_pendaftaran', 'like', "%$search%")
                    ->orWhere('nik', 'like', "%$search%");
            });
        }

        $registrations = $query->latest()->get();

        // Nama file berdasarkan filter
        $statusText = $request->filled('status') && $request->status !== 'all' ? '-' . $request->status : '';
        $dateText = '';

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $dateText = '-' . $request->tanggal_mulai . '_' . $request->tanggal_akhir;
        }

        $filename = 'data-ppdb' . $statusText . $dateText . '-' . date('Y-m-d-His') . '.csv';

        // Header untuk CSV
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Callback untuk generate CSV
        $callback = function () use ($registrations) {
            // Buat output stream
            $output = fopen('php://output', 'w');

            // Tambah BOM untuk UTF-8 (agar Excel membaca karakter khusus dengan benar)
            fwrite($output, "\xEF\xBB\xBF");

            // Header kolom
            fputcsv($output, [
                'No',
                'No Pendaftaran',
                'Tanggal Daftar',
                'Nama Calon Siswa',
                'NIK',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Umur',
                'Jenis Kelamin',
                'Anak Ke',
                'Dari Bersaudara',
                'Asal Sekolah',
                'Alamat',
                'Nama Ayah',
                'Nama Ibu',
                'No HP Ayah',
                'No HP Ibu',
                'Penghasilan',
                'Alamat Orang Tua',
                'Status',
                'Disetujui Pada',
                'Disetujui Oleh',
                'Sudah Dihubungi',
                'Catatan Admin'
            ]);

            // Data rows
            foreach ($registrations as $index => $registration) {
                fputcsv($output, [
                    $index + 1,
                    $registration->no_pendaftaran,
                    Carbon::parse($registration->created_at)->format('d/m/Y H:i'),
                    $registration->nama,
                    "'" . $registration->nik, // Tambah apostrof agar Excel tidak konversi ke number
                    $registration->tempat_lahir,
                    Carbon::parse($registration->tanggal_lahir)->format('d/m/Y'),
                    $registration->umur,
                    $registration->jenis_kelamin,
                    $registration->anak_ke,
                    $registration->dari_bersaudara,
                    $registration->asal_sekolah,
                    $registration->alamat,
                    $registration->nama_ayah,
                    $registration->nama_ibu,
                    "'" . $registration->no_hp_ayah, // Tambah apostrof
                    "'" . $registration->no_hp_ibu, // Tambah apostrof
                    $registration->pendapatan,
                    $registration->alamat_orang_tua,
                    $this->getStatusText($registration->status),
                    $registration->disetujui_pada ? Carbon::parse($registration->disetujui_pada)->format('d/m/Y H:i') : '-',
                    $registration->disetujui_oleh ?? '-',
                    $registration->sudah_dihubungi ? 'Ya' : 'Tidak',
                    $registration->catatan_admin ?? '-'
                ]);
            }

            fclose($output);
        };

        // Return response stream download
        return response()->streamDownload($callback, $filename, $headers);
    }

    /* ================= HELPER: GET STATUS TEXT ================= */

    private function getStatusText($status)
    {
        return match ($status) {
            'menunggu' => 'Menunggu',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => $status
        };
    }

    /* ================= STATISTICS ================= */

    public function statistics()
    {
        // Hitung total data
        $total = Ppdb::count();

        // Status statistics
        $diterima = Ppdb::where('status', 'diterima')->count();
        $menunggu = Ppdb::where('status', 'menunggu')->count();
        $ditolak = Ppdb::where('status', 'ditolak')->count();

        // Persentase
        $persenDiterima = $total > 0 ? round(($diterima / $total) * 100, 1) : 0;
        $persenMenunggu = $total > 0 ? round(($menunggu / $total) * 100, 1) : 0;
        $persenDitolak = $total > 0 ? round(($ditolak / $total) * 100, 1) : 0;

        // Pendaftaran bulan ini
        $bulanIni = Ppdb::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Pendaftaran bulan lalu
        $bulanLalu = Ppdb::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Persentase pertumbuhan
        $persentasePertumbuhan = $bulanLalu > 0
            ? round((($bulanIni - $bulanLalu) / $bulanLalu) * 100, 1)
            : ($bulanIni > 0 ? 100 : 0);

        // Rata-rata harian
        $hariDalamBulan = now()->daysInMonth;
        $rataHarian = $hariDalamBulan > 0
            ? round($bulanIni / $hariDalamBulan, 1)
            : 0;

        // Tingkat penerimaan
        $tingkatPenerimaan = $total > 0
            ? round(($diterima / $total) * 100, 1)
            : 0;

        // Data bulanan (12 bulan terakhir)
        $monthlyStats = Ppdb::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Top 5 sekolah
        $topSchools = Ppdb::select('asal_sekolah', DB::raw('COUNT(*) as total'))
            ->groupBy('asal_sekolah')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Distribusi pendapatan
        $incomeStats = Ppdb::select('pendapatan', DB::raw('COUNT(*) as total'))
            ->groupBy('pendapatan')
            ->orderByRaw("FIELD(pendapatan, '< 1 juta', '1 - 3 juta', '3 - 5 juta', '5 - 10 juta', '> 10 juta')")
            ->get();

        // Hitung distribusi jam pendaftaran
        $jamPagi = Ppdb::whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<', '12:00:00')
            ->count();
        $jamSiang = Ppdb::whereTime('created_at', '>=', '12:00:00')
            ->whereTime('created_at', '<', '18:00:00')
            ->count();
        $jamMalam = Ppdb::whereTime('created_at', '>=', '18:00:00')
            ->whereTime('created_at', '<', '24:00:00')
            ->count();
        $jamDini = Ppdb::whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<', '06:00:00')
            ->count();

        $totalJam = $jamPagi + $jamSiang + $jamMalam + $jamDini;
        $persenPagi = $totalJam > 0 ? round(($jamPagi / $totalJam) * 100, 1) : 25;
        $persenSiang = $totalJam > 0 ? round(($jamSiang / $totalJam) * 100, 1) : 50;
        $persenMalam = $totalJam > 0 ? round(($jamMalam / $totalJam) * 100, 1) : 20;
        $persenDini = $totalJam > 0 ? round(($jamDini / $totalJam) * 100, 1) : 5;

        return view('admin.registrations.statistics', compact(
            'total',
            'diterima',
            'menunggu',
            'ditolak',
            'persenDiterima',
            'persenMenunggu',
            'persenDitolak',
            'bulanIni',
            'bulanLalu',
            'persentasePertumbuhan',
            'rataHarian',
            'tingkatPenerimaan',
            'monthlyStats',
            'topSchools',
            'incomeStats',
            'persenPagi',
            'persenSiang',
            'persenMalam',
            'persenDini'
        ));
    }

    /* ================= HELPER FUNCTIONS ================= */

    private function formatWhatsAppNumber($phoneNumber)
    {
        // Hilangkan semua karakter non-digit
        $cleanNumber = preg_replace('/\D/', '', $phoneNumber);

        // Jika diawali dengan 0, ganti dengan 62
        if (substr($cleanNumber, 0, 1) === '0') {
            $cleanNumber = '62' . substr($cleanNumber, 1);
        }

        // Jika diawali dengan 8 tanpa 62, tambahkan 62
        if (substr($cleanNumber, 0, 1) === '8' && substr($cleanNumber, 0, 2) !== '62') {
            $cleanNumber = '62' . $cleanNumber;
        }

        return $cleanNumber;
    }

    /* ================= BULK ACTIONS ================= */

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,export,update_status',
            'ids' => 'required|array',
            'ids.*' => 'exists:ppdbs,id',
        ]);

        $ids = $request->ids;

        switch ($request->action) {
            case 'delete':
                $count = 0;
                foreach ($ids as $id) {
                    $registration = Ppdb::find($id);
                    if ($registration) {
                        // Hapus file terkait
                        $filesToDelete = [$registration->foto_anak, $registration->foto_kk, $registration->foto_akte, $registration->foto_ktp_ayah, $registration->foto_ktp_ibu];

                        foreach ($filesToDelete as $file) {
                            if ($file && Storage::disk('public')->exists($file)) {
                                Storage::disk('public')->delete($file);
                            }
                        }

                        $registration->delete();
                        $count++;
                    }
                }
                $message = $count . ' data berhasil dihapus';
                break;

            case 'export':
                // Handle bulk export
                return $this->exportSelected($ids);

            case 'update_status':
                $request->validate([
                    'new_status' => 'required|in:menunggu,diterima,ditolak',
                ]);

                $count = Ppdb::whereIn('id', $ids)->update([
                    'status' => $request->new_status,
                    'disetujui_pada' => now(),
                    'disetujui_oleh' => Auth::user()->name,
                    'sudah_dihubungi' => 1,
                ]);

                $message = $count . ' data berhasil diperbarui';
                break;

            default:
                return back()->with('error', 'Aksi tidak valid');
        }

        return back()->with('success', $message);
    }

    /* ================= BULK APPROVE ================= */

    public function bulkApprove(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ppdbs,id',
        ]);

        $count = Ppdb::whereIn('id', $request->ids)->update([
            'status' => 'diterima',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
        ]);

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', $count . ' data berhasil diterima');
    }

    /* ================= BULK REJECT ================= */

    public function bulkReject(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ppdbs,id',
            'catatan_admin' => 'required|string|max:1000',
        ]);

        $count = Ppdb::whereIn('id', $request->ids)->update([
            'status' => 'ditolak',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', $count . ' data berhasil ditolak');
    }

    /* ================= BULK DELETE ================= */

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ppdbs,id',
        ]);

        try {
            $count = 0;
            foreach ($request->ids as $id) {
                $registration = Ppdb::find($id);
                if ($registration) {
                    // Hapus file terkait
                    $filesToDelete = [
                        $registration->foto_anak,
                        $registration->foto_kk,
                        $registration->foto_akte,
                        $registration->foto_ktp_ayah,
                        $registration->foto_ktp_ibu
                    ];

                    foreach ($filesToDelete as $file) {
                        if ($file && Storage::disk('public')->exists($file)) {
                            Storage::disk('public')->delete($file);
                        }
                    }

                    $registration->delete();
                    $count++;
                }
            }

            return redirect()
                ->route('admin.registrations.index')
                ->with('success', $count . ' data pendaftaran berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error bulk delete: ' . $e->getMessage());

            return redirect()
                ->route('admin.registrations.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }


    /* ================= MARK CONTACTED ================= */

    public function markContacted(Request $request, $id)
    {
        $registration = Ppdb::findOrFail($id);

        $registration->update([
            'sudah_dihubungi' => true,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status sudah dihubungi berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Status sudah dihubungi berhasil diperbarui');
    }

    /* ================= EXPORT SELECTED (Public Method) ================= */

    public function exportSelected($ids = [])
    {
        if (empty($ids)) {
            $registrations = Ppdb::all();
        } else {
            $registrations = Ppdb::whereIn('id', $ids)->get();
        }

        $filename = 'ppdb-selected-' . date('Y-m-d-His') . '.csv';

        return response()->streamDownload(
            function () use ($registrations) {
                $file = fopen('php://output', 'w');

                // Header dengan UTF-8 BOM untuk Excel
                fwrite($file, "\xEF\xBB\xBF");

                // Header kolom
                fputcsv($file, [
                    'No',
                    'No Pendaftaran',
                    'Nama',
                    'NIK',
                    'TTL',
                    'JK',
                    'Nama Ayah',
                    'No HP',
                    'Status'
                ]);

                // Data
                foreach ($registrations as $i => $r) {
                    fputcsv($file, [
                        $i + 1,
                        $r->no_pendaftaran,
                        $r->nama,
                        "'" . $r->nik,
                        $r->tempat_lahir . ', ' . Carbon::parse($r->tanggal_lahir)->format('d/m/Y'),
                        $r->jenis_kelamin,
                        $r->nama_ayah,
                        "'" . $r->no_hp_ayah,
                        $this->getStatusText($r->status)
                    ]);
                }
                fclose($file);
            },
            $filename,
            [
                'Content-Type' => 'text/csv; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}