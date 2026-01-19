<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ArtikelController,
    GaleriController,
    PrestasiController,
    TentangController,
    PageController,
    ProfileController,
    KegiatanController,
    PpdbController,
    JenjangController
};
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    AdminArtikelController,
    AdminGaleriController,
    AdminPrestasiController,
    AdminTentangController,
    AdminStaffController,
    AdminKegiatanController,
    AdminPpdbController
};

/* --- PUBLIC ROUTES --- */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{slug}/download-pdf', [ArtikelController::class, 'downloadPdf'])->name('artikel.download.pdf');
Route::get('/artikel/{slug}/preview-pdf', [ArtikelController::class, 'previewPdf'])->name('artikel.preview.pdf');

// Galeri Routes
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/tk', [GaleriController::class, 'tk'])->name('galeri.tk');
Route::get('/galeri/sd', [GaleriController::class, 'sd'])->name('galeri.sd');

// Jenjang TK
Route::get('/jenjang/tk', [JenjangController::class, 'tk'])->name('jenjang.tk');
// Jenjang SD - Hanya satu rute ini yang diperlukan
Route::get('/jenjang/sd', [JenjangController::class, 'sd'])->name('jenjang.sd');

// Kegiatan Routes
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('kegiatan.show');

// PPDB Public Routes
Route::get('/daftar-sekarang', [PpdbController::class, 'index'])->name('daftar-sekarang');
Route::post('/daftar-sekarang', [PpdbController::class, 'store'])->name('daftar.store');

// Cek Status PPDB (Public)
Route::get('/cek-status-ppdb', [PpdbController::class, 'cekStatus'])->name('ppdb.cek-status');
Route::post('/cek-status-ppdb', [PpdbController::class, 'prosesCekStatus'])->name('ppdb.proses-cek-status');


// Page Routes
Route::controller(PageController::class)->group(function () {
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/akreditasi', 'akreditasi')->name('akreditasi');
    Route::get('/tata-tertib', 'tataTertib')->name('tata-tertib');
    Route::get('/ekstrakurikuler', 'ekstrakurikuler')->name('ekstrakurikuler');
    Route::get('/ppdb', 'ppdb')->name('ppdb');
    Route::get('/alur-pendaftaran', 'alurPendaftaran')->name('alur-pendaftaran');
    Route::get('/pembayaran', 'pembayaran')->name('pembayaran');
    Route::get('/kurikulum', 'kurikulum')->name('kurikulum');
    Route::get('/staff', 'staff')->name('staff');
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::post('/kontak', 'kirimPesan')->name('kontak.kirim');
});

/* --- ADMIN ROUTES --- */
// Ganti di routes/web.php baris 72:
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/activity-log', [AdminDashboardController::class, 'activityLog'])->name('activity.log');
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
    Route::get('/backup', [AdminDashboardController::class, 'backup'])->name('backup');
    Route::post('/backup/create', [AdminDashboardController::class, 'createBackup'])->name('backup.create');

    // Dashboard API Routes
    Route::prefix('api/dashboard')->name('dashboard.')->group(function () {
        Route::get('/stats', [AdminDashboardController::class, 'getStats'])->name('stats');
        Route::get('/recent-activities', [AdminDashboardController::class, 'getRecentActivities'])->name('recent.activities');
        Route::get('/today-stats', [AdminDashboardController::class, 'getTodayStats'])->name('today.stats');
        Route::get('/weekly-chart', [AdminDashboardController::class, 'getWeeklyChartData'])->name('weekly.chart');
        Route::get('/content-distribution', [AdminDashboardController::class, 'getContentDistribution'])->name('content.distribution');
        Route::get('/top-articles', [AdminDashboardController::class, 'getTopArticles'])->name('top.articles');
        Route::get('/system-overview', [AdminDashboardController::class, 'getSystemOverview'])->name('system.overview');
        Route::get('/activity-timeline', [AdminDashboardController::class, 'getActivityTimeline'])->name('activity.timeline');
        Route::get('/quick-stats', [AdminDashboardController::class, 'getQuickStats'])->name('quick.stats');
        Route::get('/ppdb-stats', [AdminDashboardController::class, 'getPpdbStats'])->name('ppdb.stats');
    });

    // PPDB Admin Routes
    Route::prefix('ppdb')->name('registrations.')->group(function () {
        Route::get('/', [AdminPpdbController::class, 'index'])->name('index');
        Route::get('/statistics', [AdminPpdbController::class, 'statistics'])->name('statistics');
        Route::get('/export', [AdminPpdbController::class, 'export'])->name('export');
        Route::post('/export-selected', [AdminPpdbController::class, 'exportSelected'])->name('export-selected');

        // Single registration routes
        Route::get('/{registration}', [AdminPpdbController::class, 'show'])->name('show');
        Route::delete('/{registration}', [AdminPpdbController::class, 'destroy'])->name('destroy');
        Route::post('/{registration}/approve', [AdminPpdbController::class, 'approve'])->name('approve')->withoutMiddleware(['csrf', 'auth', 'verified']);
        Route::post('/{registration}/reject', [AdminPpdbController::class, 'reject'])->name('reject');
        Route::post('/{registration}/update-notes', [AdminPpdbController::class, 'updateNotes'])->name('update-notes');
        Route::post('/{registration}/update-status', [AdminPpdbController::class, 'updateStatus'])->name('update-status');
        Route::post('/{registration}/mark-contacted', [AdminPpdbController::class, 'markContacted'])->name('mark-contacted');

        // WhatsApp integration
        Route::get('/{registration}/whatsapp', [AdminPpdbController::class, 'sendWhatsApp'])->name('whatsapp');

        // Bulk operations
        Route::post('/bulk-approve', [AdminPpdbController::class, 'bulkApprove'])->name('bulk-approve');
        Route::post('/bulk-reject', [AdminPpdbController::class, 'bulkReject'])->name('bulk-reject');
        Route::post('/bulk-delete', [AdminPpdbController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Artikel Routes
    Route::resource('artikel', AdminArtikelController::class);
    Route::prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/{id}/preview', [AdminArtikelController::class, 'preview'])->name('preview');
        Route::post('/{id}/publish', [AdminArtikelController::class, 'publish'])->name('publish');
        Route::post('/{id}/unpublish', [AdminArtikelController::class, 'unpublish'])->name('unpublish');
        Route::post('/bulk-publish', [AdminArtikelController::class, 'bulkPublish'])->name('bulk-publish');
        Route::post('/bulk-delete', [AdminArtikelController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/upload-image', [AdminArtikelController::class, 'uploadImage'])->name('upload-image');
        Route::get('/{id}/download-pdf', [AdminArtikelController::class, 'downloadPdf'])->name('download.pdf');
        Route::get('/{id}/preview-jurnal', [AdminArtikelController::class, 'previewJurnal'])->name('preview.jurnal');
    });

    // Galeri Routes
    Route::resource('galeri', AdminGaleriController::class);
    Route::prefix('galeri')->name('galeri.')->group(function () {
        Route::post('/bulk-upload', [AdminGaleriController::class, 'bulkUpload'])->name('bulk-upload');
        Route::post('/bulk-delete', [AdminGaleriController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/reorder', [AdminGaleriController::class, 'reorder'])->name('reorder');
        Route::post('/upload-multiple', [AdminGaleriController::class, 'uploadMultiple'])->name('upload-multiple');
        Route::get('/{id}/set-cover', [AdminGaleriController::class, 'setCover'])->name('set-cover');
    });

    // Prestasi Routes
    Route::resource('prestasi', AdminPrestasiController::class);
    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::post('/bulk-publish', [AdminPrestasiController::class, 'bulkPublish'])->name('bulk-publish');
        Route::post('/bulk-delete', [AdminPrestasiController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/reorder', [AdminPrestasiController::class, 'reorder'])->name('reorder');
    });

    // Staff Routes
    Route::resource('staff', AdminStaffController::class);
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::post('/reorder', [AdminStaffController::class, 'reorder'])->name('reorder');
        Route::post('/bulk-delete', [AdminStaffController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/upload-foto', [AdminStaffController::class, 'uploadFoto'])->name('upload-foto');
        Route::get('/{id}/toggle-status', [AdminStaffController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Kegiatan Routes
    Route::resource('kegiatan', AdminKegiatanController::class);
    Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/{id}/preview', [AdminKegiatanController::class, 'preview'])->name('preview');
        Route::post('/{id}/publish', [AdminKegiatanController::class, 'publish'])->name('publish');
        Route::post('/{id}/unpublish', [AdminKegiatanController::class, 'unpublish'])->name('unpublish');
        Route::post('/bulk-publish', [AdminKegiatanController::class, 'bulkPublish'])->name('bulk-publish');
        Route::post('/bulk-delete', [AdminKegiatanController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/upload-image', [AdminKegiatanController::class, 'uploadImage'])->name('upload-image');
        Route::post('/{id}/upload-gallery', [AdminKegiatanController::class, 'uploadGallery'])->name('upload-gallery');
        Route::delete('/gallery/{id}', [AdminKegiatanController::class, 'deleteGalleryImage'])->name('gallery.delete');
    });

    // ============================================
    // TENTANG ROUTES - FIX FINAL VERSION
    // ============================================

    // Gunakan resource dengan semua method (termasuk destroy)
    Route::resource('tentang', AdminTentangController::class)->except(['create', 'store']);

    // Pengaturan Umum
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'settings'])->name('index');
        Route::post('/', [AdminDashboardController::class, 'updateSettings'])->name('update');
        Route::get('/general', [AdminDashboardController::class, 'generalSettings'])->name('general');
        Route::post('/general', [AdminDashboardController::class, 'updateGeneralSettings'])->name('general.update');
        Route::get('/seo', [AdminDashboardController::class, 'seoSettings'])->name('seo');
        Route::post('/seo', [AdminDashboardController::class, 'updateSeoSettings'])->name('seo.update');
        Route::get('/social', [AdminDashboardController::class, 'socialSettings'])->name('social');
        Route::post('/social', [AdminDashboardController::class, 'updateSocialSettings'])->name('social.update');
        Route::get('/kontak', [AdminDashboardController::class, 'contactSettings'])->name('kontak');
        Route::post('/kontak', [AdminDashboardController::class, 'updateContactSettings'])->name('kontak.update');
    });

    // Backup & Restore
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'backup'])->name('index');
        Route::post('/create', [AdminDashboardController::class, 'createBackup'])->name('create');
        Route::delete('/{filename}', [AdminDashboardController::class, 'deleteBackup'])->name('delete');
        Route::get('/download/{filename}', [AdminDashboardController::class, 'downloadBackup'])->name('download');
        Route::post('/restore/{filename}', [AdminDashboardController::class, 'restoreBackup'])->name('restore');
    });

    // Logs & Monitoring
    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'activityLog'])->name('index');
        Route::get('/system', [AdminDashboardController::class, 'systemLogs'])->name('system');
        Route::get('/error', [AdminDashboardController::class, 'errorLogs'])->name('error');
        Route::delete('/clear', [AdminDashboardController::class, 'clearLogs'])->name('clear');
        Route::get('/download/{type}', [AdminDashboardController::class, 'downloadLogs'])->name('download');
    });

    // Upload Routes (untuk semua CKEditor)
    Route::post('tentang/upload', [AdminTentangController::class, 'uploadImage'])->name('tentang.upload');
    Route::post('artikel/upload', [AdminArtikelController::class, 'uploadImage'])->name('artikel.upload');
    Route::post('kegiatan/upload', [AdminKegiatanController::class, 'uploadImage'])->name('kegiatan.upload');

    // Dashboard Widgets
    Route::prefix('widgets')->name('widgets.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'widgets'])->name('index');
        Route::post('/reorder', [AdminDashboardController::class, 'reorderWidgets'])->name('reorder');
        Route::post('/toggle/{widget}', [AdminDashboardController::class, 'toggleWidget'])->name('toggle');
    });

    // Notifikasi
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'notifications'])->name('index');
        Route::post('/mark-all-read', [AdminDashboardController::class, 'markAllRead'])->name('mark-all-read');
        Route::delete('/clear-all', [AdminDashboardController::class, 'clearAll'])->name('clear-all');
        Route::get('/{id}', [AdminDashboardController::class, 'showNotification'])->name('show');
        Route::post('/{id}/mark-read', [AdminDashboardController::class, 'markRead'])->name('mark-read');
    });

    // File Manager (Optional)
    Route::prefix('file-manager')->name('file-manager.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'fileManager'])->name('index');
        Route::post('/upload', [AdminDashboardController::class, 'fileUpload'])->name('upload');
        Route::delete('/delete', [AdminDashboardController::class, 'fileDelete'])->name('delete');
        Route::post('/create-folder', [AdminDashboardController::class, 'createFolder'])->name('create-folder');
        Route::get('/preview/{file}', [AdminDashboardController::class, 'filePreview'])->name('preview');
        Route::get('/download/{file}', [AdminDashboardController::class, 'fileDownload'])->name('download');
    });

    // Import/Export Data
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/export', [AdminDashboardController::class, 'dataExport'])->name('export');
        Route::post('/import', [AdminDashboardController::class, 'dataImport'])->name('import');
        Route::get('/template/{type}', [AdminDashboardController::class, 'downloadTemplate'])->name('template');
    });
});

/* --- AUTH & PROFILE --- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Change Password
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Two Factor Authentication (jika diperlukan)
    Route::post('/two-factor-authentication', [ProfileController::class, 'storeTwoFactorAuthentication'])
        ->name('two-factor.store');
    Route::delete('/two-factor-authentication', [ProfileController::class, 'destroyTwoFactorAuthentication'])
        ->name('two-factor.destroy');
});

/* --- API ROUTES FOR AJAX --- */
Route::middleware('api')->prefix('api')->group(function () {
    // Public API untuk data
    Route::get('/ppdb/count', [PpdbController::class, 'count'])->name('api.ppdb.count');
    Route::get('/articles/latest', [ArtikelController::class, 'latest'])->name('api.articles.latest');
    Route::get('/prestasi/latest', [PrestasiController::class, 'latest'])->name('api.prestasi.latest');
    Route::get('/kegiatan/upcoming', [KegiatanController::class, 'upcoming'])->name('api.kegiatan.upcoming');
    Route::get('/stats', [HomeController::class, 'stats'])->name('api.stats');

    // API untuk form pendaftaran PPDB (AJAX)
    Route::post('/ppdb/check-nik', [PpdbController::class, 'checkNik'])->name('api.ppdb.check-nik');
});

/* --- UTILITY ROUTES --- */
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    return response()->view('robots')->header('Content-Type', 'text/plain');
})->name('robots');

// Route untuk maintenance mode
Route::get('/maintenance', function () {
    if (!app()->isDownForMaintenance()) {
        return redirect('/');
    }
    return view('maintenance');
})->name('maintenance');

// Route untuk health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'services' => [
            'database' => true,
            'cache' => true,
            'storage' => true,
        ]
    ]);
});

// Fallback route untuk 404
Route::fallback(function () {
    return view('errors.404');
});

require __DIR__ . '/auth.php';
