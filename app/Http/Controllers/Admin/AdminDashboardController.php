<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Kegiatan;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        try {
            // Hitung statistik utama
            $stats = $this->getDashboardStats();

            // Data untuk chart
            $weeklyData = $this->getWeeklyChartData();
            $contentDistribution = $this->getContentDistribution();

            // Aktivitas terbaru
            $recentActivities = $this->getRecentActivities();

            // Top artikel
            $topArticles = Artikel::latest()->take(5)->get();

            // PPDB terbaru
            $recentRegistrations = Ppdb::latest()->take(10)->get();

            // Statistik PPDB
            $ppdbStats = $this->getPpdbStats();

            return view('admin.dashboard', compact(
                'stats',
                'weeklyData',
                'contentDistribution',
                'recentActivities',
                'topArticles',
                'recentRegistrations',
                'ppdbStats'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());

            // Return dashboard dengan data kosong jika error
            return view('admin.dashboard', [
                'stats' => [
                    'totalUsers' => 0,
                    'totalArticles' => 0,
                    'totalGalleries' => 0,
                    'totalPrestasi' => 0,
                    'totalRegistrations' => 0,
                    'pendingRegistrations' => 0
                ],
                'weeklyData' => [],
                'contentDistribution' => [],
                'recentActivities' => [],
                'topArticles' => collect([]),
                'recentRegistrations' => collect([]),
                'ppdbStats' => []
            ]);
        }
    }

    /**
     * Get dashboard statistics
     */
    private function getDashboardStats()
    {
        return [
            // Untuk stats cards di dashboard
            'artikel' => Artikel::count(),
            'artikel_published' => Artikel::where('status', 'published')
                ->orWhere('status', 'diterbitkan')
                ->orWhere('status', 'aktif')
                ->count(),
            'galeri_tk' => Galeri::where('kategori', 'TK')->count(),
            'galeri_sd' => Galeri::where('kategori', 'SD')->count(),
            'prestasi' => Prestasi::count(),
            'staff' => Staff::count(),
            'kegiatan' => Kegiatan::count(),
            'kegiatan_active' => Kegiatan::where('status', 'active')
                ->orWhere('status', 'aktif')
                ->orWhere('status', 'published')
                ->count(),
            'month_activities' => $this->getMonthlyActivitiesCount(),
        ];
    }

    private function getMonthlyActivitiesCount()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $articles = Artikel::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $prestasi = Prestasi::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $staff = Staff::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $galeri = Galeri::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $kegiatan = Kegiatan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        return $articles + $prestasi + $staff + $galeri + $kegiatan;
    }

    /**
     * Get weekly chart data for registrations
     */
    private function getWeeklyChartData()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $data = Ppdb::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $dates = [];
        $counts = [];

        // Generate data untuk 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->translatedFormat('D');
            $counts[] = $data->has($date) ? $data[$date]->count : 0;
        }

        return [
            'labels' => $dates,
            'data' => $counts
        ];
    }

    /**
     * Get content distribution
     */
    private function getContentDistribution()
    {
        return [
            ['label' => 'Artikel', 'value' => Artikel::count(), 'color' => '#3b82f6'],
            ['label' => 'Galeri', 'value' => Galeri::count(), 'color' => '#10b981'],
            ['label' => 'Prestasi', 'value' => Prestasi::count(), 'color' => '#f59e0b'],
            ['label' => 'Kegiatan', 'value' => Kegiatan::count(), 'color' => '#8b5cf6'],
            ['label' => 'Staff', 'value' => Staff::count(), 'color' => '#ef4444']
        ];
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Registrations terbaru
        $recentRegistrations = Ppdb::latest()->take(5)->get();
        foreach ($recentRegistrations as $registration) {
            $activities[] = [
                'type' => 'ppdb',
                'icon' => 'bi-person-plus',
                'title' => 'Pendaftaran Baru: ' . $registration->nama,
                'description' => $registration->asal_sekolah,
                'time' => $registration->created_at->diffForHumans(),
                'color' => 'primary'
            ];
        }

        // Artikel terbaru
        $recentArticles = Artikel::latest()->take(3)->get();
        foreach ($recentArticles as $article) {
            $activities[] = [
                'type' => 'article',
                'icon' => 'bi-file-text',
                'title' => 'Artikel Baru: ' . $article->judul,
                'description' => substr(strip_tags($article->konten), 0, 100) . '...',
                'time' => $article->created_at->diffForHumans(),
                'color' => 'success'
            ];
        }

        // Sort by time
        usort($activities, function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 10); // Ambil 10 terbaru
    }

    /**
     * Get PPDB statistics
     */
    private function getPpdbStats()
    {
        $total = Ppdb::count();

        return [
            'total' => $total,
            'pending' => Ppdb::where('status', 'menunggu')->count(),
            'accepted' => Ppdb::where('status', 'diterima')->count(),
            'rejected' => Ppdb::where('status', 'ditolak')->count(),
            'contacted' => Ppdb::where('sudah_dihubungi', 1)->count(),
            'percentage' => [
                'pending' => $total > 0 ? round((Ppdb::where('status', 'menunggu')->count() / $total) * 100, 1) : 0,
                'accepted' => $total > 0 ? round((Ppdb::where('status', 'diterima')->count() / $total) * 100, 1) : 0,
                'rejected' => $total > 0 ? round((Ppdb::where('status', 'ditolak')->count() / $total) * 100, 1) : 0
            ]
        ];
    }

    /**
     * Get activity log
     */
    public function activityLog()
    {
        // Untuk sementara, kita gunakan log sederhana
        // Anda bisa mengintegrasikan dengan package seperti spatie/laravel-activitylog nanti

        $activities = $this->getRecentActivities();

        return view('admin.activity-log', compact('activities'));
    }

    /**
     * Get stats via API (untuk AJAX)
     */
    public function getStats(Request $request)
    {
        try {
            $stats = $this->getDashboardStats();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Get Stats Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data statistik'
            ], 500);
        }
    }

    /**
     * Get recent activities via API
     */
    public function getRecentActivitiesApi(Request $request)
    {
        try {
            $activities = $this->getRecentActivities();

            return response()->json([
                'success' => true,
                'data' => $activities
            ]);
        } catch (\Exception $e) {
            Log::error('Get Activities Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data aktivitas'
            ], 500);
        }
    }

    /**
     * Get today stats
     */
    public function getTodayStats(Request $request)
    {
        try {
            $today = now()->format('Y-m-d');

            $stats = [
                'registrations' => Ppdb::whereDate('created_at', $today)->count(),
                'articles' => Artikel::whereDate('created_at', $today)->count(),
                'galleries' => Galeri::whereDate('created_at', $today)->count(),
                'prestasi' => Prestasi::whereDate('created_at', $today)->count()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Get Today Stats Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data statistik hari ini'
            ], 500);
        }
    }

    /**
     * Get weekly chart data via API
     */
    public function getWeeklyChartDataApi(Request $request)
    {
        try {
            $data = $this->getWeeklyChartData();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('Get Weekly Chart Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data chart'
            ], 500);
        }
    }

    /**
     * Get content distribution via API
     */
    public function getContentDistributionApi(Request $request)
    {
        try {
            $data = $this->getContentDistribution();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('Get Content Distribution Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil distribusi konten'
            ], 500);
        }
    }

    /**
     * Get top articles via API
     */
    public function getTopArticles(Request $request)
    {
        try {
            $articles = Artikel::latest()->take(5)->get()->map(function ($article) {
                return [
                    'id' => $article->id,
                    'judul' => $article->judul,
                    'slug' => $article->slug,
                    'kategori' => $article->kategori,
                    'created_at' => $article->created_at->format('d/m/Y'),
                    'views' => $article->views ?? 0
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            Log::error('Get Top Articles Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data artikel'
            ], 500);
        }
    }

    /**
     * Get system overview
     */
    public function getSystemOverview(Request $request)
    {
        try {
            // Informasi sistem dasar
            $overview = [
                'laravel_version' => app()->version(),
                'php_version' => phpversion(),
                'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
                'database' => DB::connection()->getPdo()->getAttribute(\PDO::ATTR_DRIVER_NAME),
                'timezone' => config('app.timezone'),
                'environment' => app()->environment(),
                'debug_mode' => config('app.debug'),
                'storage_used' => $this->getStorageUsage(),
                'last_backup' => $this->getLastBackupDate(),
                'uptime' => $this->getSystemUptime()
            ];

            return response()->json([
                'success' => true,
                'data' => $overview
            ]);
        } catch (\Exception $e) {
            Log::error('Get System Overview Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil informasi sistem'
            ], 500);
        }
    }

    /**
     * Get activity timeline
     */
    public function getActivityTimeline(Request $request)
    {
        try {
            $timeline = [];

            // 24 jam terakhir
            $hours = [];
            $counts = [];

            for ($i = 23; $i >= 0; $i--) {
                $hour = Carbon::now()->subHours($i)->format('H:00');
                $startTime = Carbon::now()->subHours($i)->startOfHour();
                $endTime = Carbon::now()->subHours($i)->endOfHour();

                $count = Ppdb::whereBetween('created_at', [$startTime, $endTime])->count();

                $hours[] = $hour;
                $counts[] = $count;
            }

            $timeline['hours'] = $hours;
            $timeline['counts'] = $counts;

            return response()->json([
                'success' => true,
                'data' => $timeline
            ]);
        } catch (\Exception $e) {
            Log::error('Get Activity Timeline Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil timeline aktivitas'
            ], 500);
        }
    }

    /**
     * Get quick stats
     */
    public function getQuickStats(Request $request)
    {
        try {
            $today = now()->format('Y-m-d');
            $yesterday = Carbon::yesterday()->format('Y-m-d');

            $stats = [
                'today' => [
                    'registrations' => Ppdb::whereDate('created_at', $today)->count(),
                    'approved' => Ppdb::whereDate('disetujui_pada', $today)->count(),
                    'pending' => Ppdb::where('status', 'menunggu')->whereDate('created_at', $today)->count()
                ],
                'yesterday' => [
                    'registrations' => Ppdb::whereDate('created_at', $yesterday)->count(),
                    'approved' => Ppdb::whereDate('disetujui_pada', $yesterday)->count(),
                    'pending' => Ppdb::where('status', 'menunggu')->whereDate('created_at', $yesterday)->count()
                ],
                'growth' => [
                    'registrations' => $this->calculateGrowth('today', 'yesterday', 'registrations'),
                    'approved' => $this->calculateGrowth('today', 'yesterday', 'approved'),
                    'pending' => $this->calculateGrowth('today', 'yesterday', 'pending')
                ]
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Get Quick Stats Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil quick stats'
            ], 500);
        }
    }

    /**
     * Get PPDB stats via API
     */
    public function getPpdbStatsApi(Request $request)
    {
        try {
            $stats = $this->getPpdbStats();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Get PPDB Stats Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik PPDB'
            ], 500);
        }
    }

    /**
     * Helper: Calculate growth percentage
     */
    private function calculateGrowth($currentPeriod, $previousPeriod, $metric)
    {
        $current = Ppdb::whereDate('created_at', $$currentPeriod)->count();
        $previous = Ppdb::whereDate('created_at', $$previousPeriod)->count();

        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Helper: Get storage usage
     */
    private function getStorageUsage()
    {
        try {
            $total = disk_total_space('/');
            $free = disk_free_space('/');
            $used = $total - $free;

            return [
                'total' => round($total / (1024 * 1024 * 1024), 2), // GB
                'used' => round($used / (1024 * 1024 * 1024), 2), // GB
                'free' => round($free / (1024 * 1024 * 1024), 2), // GB
                'percentage' => round(($used / $total) * 100, 1)
            ];
        } catch (\Exception $e) {
            return [
                'total' => 0,
                'used' => 0,
                'free' => 0,
                'percentage' => 0
            ];
        }
    }

    /**
     * Helper: Get last backup date
     */
    private function getLastBackupDate()
    {
        // Anda bisa implementasikan backup system nanti
        // Untuk sekarang, return null
        return null;
    }

    /**
     * Helper: Get system uptime
     */
    private function getSystemUptime()
    {
        // Coba ambil uptime dari server
        if (function_exists('shell_exec')) {
            try {
                $uptime = shell_exec('uptime -p');
                return $uptime ? trim($uptime) : 'Unknown';
            } catch (\Exception $e) {
                return 'Unknown';
            }
        }

        return 'Unknown';
    }
}