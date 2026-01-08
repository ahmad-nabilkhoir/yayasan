@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="container-fluid px-0">
        {{-- Welcome Card --}}
        <div class="card rounded-4 mb-4 overflow-hidden border-0 shadow-lg"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body p-md-5 p-4 text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-4 me-4 flex-shrink-0 bg-white bg-opacity-10 shadow-sm"
                                style="width: 70px; height: 70px; backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.2);">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo Admin" style="height: 45px; width: auto;"
                                    class="hover-scale transition-all">
                            </div>
                            <div>
                                <h1 class="fw-extrabold mb-1" style="font-size: 1.75rem;">
                                    Selamat Datang, <span class="text-warning">{{ Auth::user()->name ?? 'Admin' }}</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <span class="badge fw-normal me-2 bg-white bg-opacity-20 text-black"
                                        style="font-size: 0.75rem;">
                                        YAYASAN AL-IHSAN
                                    </span>
                                    <p class="small fw-medium mb-0 opacity-75">Panel kendali pusat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-md-0 mt-3">
                        <div
                            class="rounded-4 d-inline-block border-primary border border-opacity-10 bg-white p-3 shadow-sm">
                            <div class="fs-5 fw-bold text-dark mb-1" id="dashboard-date">
                                {{ now()->translatedFormat('l, d F Y') }}
                            </div>
                            <div
                                class="small d-flex align-items-center justify-content-md-end justify-content-center text-primary">
                                <i class="bi bi-clock-fill me-2"></i>
                                <span id="dashboard-time" class="fw-bold">{{ now()->format('H:i:s') }} WIB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-5">
            @php
                $cards = [
                    [
                        'title' => 'Artikel',
                        'count' => $stats['artikel'] ?? 0,
                        'route' => 'admin.artikel.index',
                        'color' => '#667eea',
                        'icon' => 'bi bi-journal-text',
                        'description' => 'Konten Berita',
                        'trend' => '+12%',
                    ],
                    [
                        'title' => 'Galeri TK',
                        'count' => $stats['galeri_tk'] ?? 0,
                        'route' => 'admin.galeri.index',
                        'params' => ['kategori' => 'TK'],
                        'color' => '#4CAF50',
                        'icon' => 'bi bi-person-badge',
                        'description' => 'Kegiatan TK',
                        'trend' => '+5%',
                    ],
                    [
                        'title' => 'Galeri SD',
                        'count' => $stats['galeri_sd'] ?? 0,
                        'route' => 'admin.galeri.index',
                        'params' => ['kategori' => 'SD'],
                        'color' => '#00BCD4',
                        'icon' => 'bi bi-building',
                        'description' => 'Kegiatan SD',
                        'trend' => '+8%',
                    ],
                    [
                        'title' => 'Prestasi',
                        'count' => $stats['prestasi'] ?? 0,
                        'route' => 'admin.prestasi.index',
                        'color' => '#FFB300',
                        'icon' => 'bi bi-trophy',
                        'description' => 'Pencapaian Siswa',
                        'trend' => '+15%',
                    ],
                    [
                        'title' => 'Staff & Guru',
                        'count' => $stats['staff'] ?? 0,
                        'route' => 'admin.staff.index',
                        'color' => '#9C27B0',
                        'icon' => 'bi bi-people',
                        'description' => 'Tenaga Pendidik',
                        'trend' => '+3%',
                    ],
                    [
                        'title' => 'Kegiatan',
                        'count' => $stats['kegiatan'] ?? 0,
                        'route' => 'admin.kegiatan.index',
                        'color' => '#FF6B6B',
                        'icon' => 'bi bi-calendar-event',
                        'description' => 'Aktivitas Sekolah',
                        'trend' => '+7%',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-md-6 col-lg-4 col-xl-2">
                    <div class="card h-100 rounded-4 hover-lift border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 me-3 p-2" style="background-color: {{ $card['color'] }}15;">
                                            <i class="{{ $card['icon'] }} fs-5" style="color: {{ $card['color'] }}"></i>
                                        </div>
                                        <div class="small text-muted fw-medium">{{ $card['description'] }}</div>
                                    </div>
                                    <h2 class="fw-bold mb-1" style="color: {{ $card['color'] }}">
                                        {{ number_format($card['count']) }}
                                    </h2>
                                    <h6 class="fw-bold text-dark mb-0">{{ $card['title'] }}</h6>
                                </div>
                                <span class="badge rounded-pill border-0 px-3 py-1"
                                    style="background-color: {{ $card['color'] }}15; color: {{ $card['color'] }};">
                                    <i class="bi bi-arrow-up me-1"></i>{{ $card['trend'] }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route($card['route'], $card['params'] ?? []) }}"
                                    class="text-decoration-none small fw-bold d-flex align-items-center hover-effect"
                                    style="color: {{ $card['color'] }}">
                                    Detail
                                    <i class="bi bi-arrow-right-short ms-2 transition-all"></i>
                                </a>
                                <div class="progress flex-grow-1 ms-3"
                                    style="height: 6px; background-color: {{ $card['color'] }}10;">
                                    @php
                                        $maxCount = max(array_column($cards, 'count'));
                                        $width = $maxCount > 0 ? ($card['count'] / $maxCount) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar rounded-pill"
                                        style="background: linear-gradient(135deg, {{ $card['color'] }} 0%, {{ $card['color'] }}88 100%); width: {{ min(100, $width) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Main Content --}}
        <div class="row g-4">
            {{-- Left Column --}}
            <div class="col-lg-8">
                {{-- Activity Timeline --}}
                <div class="card rounded-4 mb-4 overflow-hidden border-0 shadow-sm">
                    <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">
                                    <i class="bi bi-clock-history text-primary fs-5 me-2"></i>Aktivitas Terkini
                                </h5>
                                <p class="text-muted small mb-0">Update terbaru dari semua sistem</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                {{-- Active Filter Badges --}}
                                <div id="active-filter-badges" class="d-flex flex-wrap gap-2"></div>

                                {{-- Filter Dropdown --}}
                                <div class="dropdown">
                                    <button
                                        class="btn btn-outline-primary btn-sm rounded-pill d-flex align-items-center px-3"
                                        type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-filter me-2"></i> Filter
                                        <i class="bi bi-chevron-down ms-2"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end rounded-3 border-0 p-3 shadow-lg"
                                        style="width: 250px;">
                                        <li class="mb-2">
                                            <h6 class="dropdown-header fw-bold text-dark mb-2">
                                                <i class="bi bi-funnel me-2"></i>Filter Tipe Konten
                                            </h6>
                                        </li>
                                        <li class="mb-2">
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 active p-2"
                                                data-filter="all">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(102, 126, 234, 0.1);">
                                                        <i class="bi bi-grid-3x3-gap text-primary"></i>
                                                    </div>
                                                    <span>Semua Aktivitas</span>
                                                </div>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ count($allActivities ?? []) }}</span>
                                            </button>
                                        </li>
                                        <li class="mb-2">
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 p-2"
                                                data-filter="artikel">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(102, 126, 234, 0.1);">
                                                        <i class="bi bi-journal-text text-primary"></i>
                                                    </div>
                                                    <span>Artikel</span>
                                                </div>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ count($recentArticles ?? []) }}</span>
                                            </button>
                                        </li>
                                        <li class="mb-2">
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 p-2"
                                                data-filter="prestasi">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(255, 179, 0, 0.1);">
                                                        <i class="bi bi-trophy text-warning"></i>
                                                    </div>
                                                    <span>Prestasi</span>
                                                </div>
                                                <span
                                                    class="badge bg-warning rounded-pill">{{ count($recentPrestasi ?? []) }}</span>
                                            </button>
                                        </li>
                                        <li class="mb-2">
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 p-2"
                                                data-filter="staff">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(156, 39, 176, 0.1);">
                                                        <i class="bi bi-people text-purple"></i>
                                                    </div>
                                                    <span>Staff & Guru</span>
                                                </div>
                                                <span
                                                    class="badge bg-purple rounded-pill">{{ count($recentStaff ?? []) }}</span>
                                            </button>
                                        </li>
                                        <li class="mb-2">
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 p-2"
                                                data-filter="galeri">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(76, 175, 80, 0.1);">
                                                        <i class="bi bi-images text-success"></i>
                                                    </div>
                                                    <span>Galeri</span>
                                                </div>
                                                <span
                                                    class="badge bg-success rounded-pill">{{ count($recentGaleri ?? []) }}</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button
                                                class="dropdown-item filter-option d-flex align-items-center justify-content-between rounded-2 p-2"
                                                data-filter="kegiatan">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-2 me-3 p-1"
                                                        style="background-color: rgba(255, 107, 107, 0.1);">
                                                        <i class="bi bi-calendar-event text-danger"></i>
                                                    </div>
                                                    <span>Kegiatan</span>
                                                </div>
                                                <span
                                                    class="badge bg-danger rounded-pill">{{ count($recentKegiatan ?? []) }}</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="modern-timeline">
                            @php
                                $allActivities = [];

                                // Add articles
                                foreach ($recentArticles ?? [] as $artikel) {
                                    $allActivities[] = [
                                        'type' => 'artikel',
                                        'id' => $artikel->id,
                                        'title' => $artikel->judul,
                                        'description' => Str::limit(strip_tags($artikel->isi), 80),
                                        'image' => $artikel->thumbnail,
                                        'date' => $artikel->created_at,
                                        'status' => $artikel->status,
                                        'color' => '#667eea',
                                        'icon' => 'bi-journal-text',
                                        'badge' => $artikel->status == 'draft' ? 'Draft' : 'Published',
                                        'badgeColor' => $artikel->status == 'draft' ? 'warning' : 'success',
                                        'badgeIcon' => $artikel->status == 'draft' ? 'bi-pencil' : 'bi-check-circle',
                                        'category' => 'Artikel',
                                        'categoryIcon' => 'bi-journal-text',
                                        'categoryColor' => '#667eea',
                                    ];
                                }

                                // Add prestasi
                                foreach ($recentPrestasi ?? [] as $prestasi) {
                                    $allActivities[] = [
                                        'type' => 'prestasi',
                                        'id' => $prestasi->id,
                                        'title' => $prestasi->judul,
                                        'description' => $prestasi->sekolah . ' • ' . $prestasi->tahun,
                                        'image' => $prestasi->foto,
                                        'date' => $prestasi->created_at,
                                        'color' => '#FFB300',
                                        'icon' => 'bi-trophy',
                                        'badge' => 'Prestasi',
                                        'badgeColor' => 'warning',
                                        'badgeIcon' => 'bi-award',
                                        'category' => 'Prestasi',
                                        'categoryIcon' => 'bi-trophy',
                                        'categoryColor' => '#FFB300',
                                    ];
                                }

                                // Add staff
                                foreach ($recentStaff ?? [] as $staff) {
                                    $allActivities[] = [
                                        'type' => 'staff',
                                        'id' => $staff->id,
                                        'title' => $staff->nama,
                                        'description' => $staff->jabatan,
                                        'image' => $staff->foto,
                                        'date' => $staff->created_at,
                                        'color' => '#9C27B0',
                                        'icon' => 'bi-person-badge',
                                        'badge' => ucfirst($staff->kategori),
                                        'badgeColor' => 'purple',
                                        'badgeIcon' =>
                                            $staff->kategori == 'pimpinan'
                                                ? 'bi-person-badge'
                                                : ($staff->kategori == 'kepsek'
                                                    ? 'bi-award'
                                                    : 'bi-person'),
                                        'category' => 'Staff & Guru',
                                        'categoryIcon' => 'bi-people',
                                        'categoryColor' => '#9C27B0',
                                    ];
                                }

                                // Add galeri
                                foreach ($recentGaleri ?? [] as $galeri) {
                                    $allActivities[] = [
                                        'type' => 'galeri',
                                        'id' => $galeri->id,
                                        'title' => $galeri->judul,
                                        'description' => 'Kategori: ' . $galeri->kategori,
                                        'image' => $galeri->foto,
                                        'date' => $galeri->created_at,
                                        'color' => '#4CAF50',
                                        'icon' => 'bi-images',
                                        'badge' => 'Galeri',
                                        'badgeColor' => 'success',
                                        'badgeIcon' => 'bi-image',
                                        'category' => 'Galeri',
                                        'categoryIcon' => 'bi-images',
                                        'categoryColor' => '#4CAF50',
                                    ];
                                }

                                // Add kegiatan
                                foreach ($recentKegiatan ?? [] as $kegiatan) {
                                    $allActivities[] = [
                                        'type' => 'kegiatan',
                                        'id' => $kegiatan->id,
                                        'title' => $kegiatan->judul,
                                        'description' => Str::limit($kegiatan->deskripsi, 80),
                                        'image' => $kegiatan->gambar,
                                        'date' => $kegiatan->created_at,
                                        'color' => '#FF6B6B',
                                        'icon' => 'bi-calendar-event',
                                        'badge' => $kegiatan->status ? 'Aktif' : 'Nonaktif',
                                        'badgeColor' => $kegiatan->status ? 'success' : 'danger',
                                        'badgeIcon' => $kegiatan->status ? 'bi-check-circle' : 'bi-x-circle',
                                        'category' => 'Kegiatan',
                                        'categoryIcon' => 'bi-calendar-event',
                                        'categoryColor' => '#FF6B6B',
                                    ];
                                }

                                usort($allActivities, function ($a, $b) {
                                    return $b['date'] <=> $a['date'];
                                });

                                $allActivities = array_slice($allActivities, 0, 8);
                            @endphp

                            @forelse($allActivities as $index => $activity)
                                <div class="timeline-item-modern" data-type="{{ $activity['type'] }}">
                                    <div class="timeline-indicator-wrapper">
                                        <div class="timeline-indicator"
                                            style="background: linear-gradient(135deg, {{ $activity['color'] }} 0%, {{ $activity['color'] }}88 100%);">
                                            <i class="bi {{ $activity['icon'] }} fs-6 text-white"></i>
                                        </div>
                                        @if (!$loop->last)
                                            <div class="timeline-connector"></div>
                                        @endif
                                    </div>
                                    <div class="timeline-content-modern">
                                        <div class="timeline-card">
                                            <div class="timeline-header">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="d-flex align-items-center me-3">
                                                        <div class="rounded-2 me-2 p-1"
                                                            style="background-color: {{ $activity['categoryColor'] }}15;">
                                                            <i class="bi {{ $activity['categoryIcon'] }} fs-6"
                                                                style="color: {{ $activity['categoryColor'] }}"></i>
                                                        </div>
                                                        <span class="small fw-medium"
                                                            style="color: {{ $activity['categoryColor'] }}">
                                                            {{ $activity['category'] }}
                                                        </span>
                                                    </div>
                                                    <span class="badge rounded-pill fw-medium ms-auto"
                                                        style="background-color: {{ $activity['color'] }}15; color: {{ $activity['color'] }};">
                                                        <i class="bi {{ $activity['badgeIcon'] ?? '' }} me-1"></i>
                                                        {{ $activity['badge'] }}
                                                    </span>
                                                </div>
                                                <h6 class="fw-bold text-dark timeline-title mb-2">
                                                    {{ Str::limit($activity['title'], 60) }}
                                                </h6>
                                            </div>

                                            <div class="timeline-body">
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="timeline-thumbnail">
                                                        <div class="rounded-3 overflow-hidden"
                                                            style="width: 70px; height: 70px; background-color: {{ $activity['color'] }}15;">
                                                            @if ($activity['image'])
                                                                <img src="{{ asset('storage/' . $activity['image']) }}"
                                                                    class="object-fit-cover w-100 h-100"
                                                                    onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent('{{ $activity['title'] }}')+'&background='+encodeURIComponent('{{ str_replace('#', '', $activity['color']) }}')+'&color=fff&size=200'">
                                                            @else
                                                                <div
                                                                    class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                                                    <i
                                                                        class="bi {{ $activity['icon'] }} text-muted fs-4"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted small timeline-description mb-3">
                                                            {{ $activity['description'] }}
                                                        </p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <span
                                                                    class="badge bg-light text-dark rounded-pill d-flex align-items-center border px-3 py-1">
                                                                    <i class="bi bi-clock me-2"></i>
                                                                    @if (isset($activity['date']) && $activity['date'] instanceof \Carbon\Carbon)
                                                                        {{ $activity['date']->diffForHumans() }}
                                                                    @else
                                                                        Baru saja
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                @if (isset($activity['id']) && isset($activity['type']))
                                                                    <a href="{{ route('admin.' . $activity['type'] . '.show', $activity['id']) }}"
                                                                        class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center timeline-action-btn"
                                                                        title="Lihat Detail"
                                                                        style="width: 36px; height: 36px; background-color: {{ $activity['color'] }}10; color: {{ $activity['color'] }};">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('admin.' . $activity['type'] . '.edit', $activity['id']) }}"
                                                                        class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center timeline-action-btn"
                                                                        title="Edit"
                                                                        style="width: 36px; height: 36px; background-color: {{ $activity['color'] }}10; color: {{ $activity['color'] }};">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-5 text-center">
                                    <div class="mb-4 opacity-25">
                                        <i class="bi bi-inbox display-4 text-muted"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">Belum ada aktivitas</h6>
                                    <p class="text-muted small mb-0">Mulai tambahkan konten untuk melihat aktivitas di sini
                                    </p>
                                </div>
                            @endforelse
                        </div>

                        @if (count($allActivities) > 0)
                            <div class="card-footer border-top-0 bg-white px-4 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted">
                                        Menampilkan {{ count($allActivities) }} aktivitas terbaru
                                    </span>
                                    <a href="{{ route('admin.artikel.index') }}"
                                        class="small fw-medium text-primary text-decoration-none">
                                        <i class="bi bi-list-check me-1"></i> Kelola Konten
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Charts Section --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card rounded-4 h-100 border-0 shadow-sm">
                            <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                                <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                                    <i class="bi bi-pie-chart text-info fs-5 me-2"></i>Distribusi Konten
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <canvas id="contentChart"></canvas>
                                </div>
                                <div class="mt-4">
                                    <div class="row g-2">
                                        @foreach ($cards as $card)
                                            <div class="col-6">
                                                <div class="d-flex align-items-center small">
                                                    <div class="rounded-circle me-2"
                                                        style="width: 8px; height: 8px; background-color: {{ $card['color'] }}">
                                                    </div>
                                                    <span class="text-muted">{{ $card['title'] }}</span>
                                                    <span class="fw-bold ms-auto" style="color: {{ $card['color'] }}">
                                                        {{ number_format($card['count']) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card rounded-4 h-100 border-0 shadow-sm">
                            <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                                <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                                    <i class="bi bi-bar-chart text-success fs-5 me-2"></i>Statistik Mingguan
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <canvas id="weeklyActivityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-lg-4">
                {{-- Quick Actions --}}
                <div class="card rounded-4 mb-4 border-0 shadow-sm">
                    <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                        <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                            <i class="bi bi-lightning-charge text-warning fs-5 me-2"></i>Aksi Cepat
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid gap-3">
                            @php
                                $quickActions = [
                                    [
                                        'route' => 'admin.artikel.create',
                                        'icon' => 'bi-plus-circle',
                                        'title' => 'Tambah Artikel',
                                        'description' => 'Buat berita baru',
                                        'color' => '#667eea',
                                    ],
                                    [
                                        'route' => 'admin.galeri.create',
                                        'icon' => 'bi-cloud-arrow-up',
                                        'title' => 'Upload Foto',
                                        'description' => 'Tambah ke galeri',
                                        'color' => '#4CAF50',
                                    ],
                                    [
                                        'route' => 'admin.staff.create',
                                        'icon' => 'bi-person-plus',
                                        'title' => 'Tambah Staff',
                                        'description' => 'Data tenaga pendidik',
                                        'color' => '#9C27B0',
                                    ],
                                    [
                                        'route' => 'admin.prestasi.create',
                                        'icon' => 'bi-trophy',
                                        'title' => 'Tambah Prestasi',
                                        'description' => 'Pencapaian siswa',
                                        'color' => '#FFB300',
                                    ],
                                    [
                                        'route' => 'admin.kegiatan.create',
                                        'icon' => 'bi-calendar-plus',
                                        'title' => 'Tambah Kegiatan',
                                        'description' => 'Aktivitas sekolah',
                                        'color' => '#FF6B6B',
                                    ],
                                ];
                            @endphp

                            @foreach ($quickActions as $action)
                                <a href="{{ route($action['route']) }}"
                                    class="btn rounded-4 d-flex align-items-center justify-content-between hover-lift border-0 p-3 shadow-sm"
                                    style="background-color: {{ $action['color'] }}10; color: {{ $action['color'] }}; border: 1px solid {{ $action['color'] }}20 !important;">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 48px; height: 48px; background-color: {{ $action['color'] }}20;">
                                            <i class="{{ $action['icon'] }} fs-5"
                                                style="color: {{ $action['color'] }}"></i>
                                        </div>
                                        <div class="text-start">
                                            <div class="fw-bold">{{ $action['title'] }}</div>
                                            <div class="small opacity-75">{{ $action['description'] }}</div>
                                        </div>
                                    </div>
                                    <i class="bi bi-arrow-right-circle fs-5" style="color: {{ $action['color'] }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Today Stats --}}
                <div class="card rounded-4 mb-4 border-0 shadow-sm">
                    <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                        <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                            <i class="bi bi-calendar-day text-primary fs-5 me-2"></i>Hari Ini
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @php
                                $todayCards = [
                                    [
                                        'count' => $todayStats['artikel'] ?? 0,
                                        'label' => 'Artikel Baru',
                                        'icon' => 'bi-journal-text',
                                        'color' => '#667eea',
                                    ],
                                    [
                                        'count' => $todayStats['prestasi'] ?? 0,
                                        'label' => 'Prestasi Baru',
                                        'icon' => 'bi-trophy',
                                        'color' => '#FFB300',
                                    ],
                                    [
                                        'count' => $todayStats['staff'] ?? 0,
                                        'label' => 'Staff Baru',
                                        'icon' => 'bi-person-badge',
                                        'color' => '#9C27B0',
                                    ],
                                    [
                                        'count' => $todayStats['galeri'] ?? 0,
                                        'label' => 'Galeri Baru',
                                        'icon' => 'bi-images',
                                        'color' => '#4CAF50',
                                    ],
                                    [
                                        'count' => $todayStats['kegiatan'] ?? 0,
                                        'label' => 'Kegiatan Baru',
                                        'icon' => 'bi-calendar-event',
                                        'color' => '#FF6B6B',
                                    ],
                                ];
                            @endphp

                            @foreach ($todayCards as $item)
                                <div class="col-6">
                                    <div class="rounded-4 border-0 p-3 text-center shadow-sm"
                                        style="background-color: {{ $item['color'] }}10;">
                                        <div class="fw-bold fs-3 mb-1" style="color: {{ $item['color'] }}">
                                            {{ number_format($item['count']) }}
                                        </div>
                                        <div class="small text-muted d-flex align-items-center justify-content-center">
                                            <i class="bi {{ $item['icon'] }} me-1"
                                                style="color: {{ $item['color'] }}"></i>
                                            {{ $item['label'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- System Stats --}}
                <div class="card rounded-4 mb-4 border-0 shadow-sm">
                    <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                        <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                            <i class="bi bi-graph-up text-purple fs-5 me-2"></i>Statistik Sistem
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted d-flex align-items-center">
                                    <i class="bi bi-journal-check me-1" style="color: #667eea"></i>
                                    Artikel Terpublikasi
                                </span>
                                <span class="small fw-bold">
                                    {{ $stats['artikel_published'] ?? 0 }}/{{ $stats['artikel'] ?? 0 }}
                                </span>
                            </div>
                            <div class="progress" style="height: 8px; background-color: #667eea20;">
                                @php
                                    $publishedPercent =
                                        $stats['artikel'] > 0
                                            ? ($stats['artikel_published'] / $stats['artikel']) * 100
                                            : 0;
                                @endphp
                                <div class="progress-bar rounded-pill" role="progressbar"
                                    style="width: {{ $publishedPercent }}%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-1" style="color: #FF6B6B"></i>
                                    Kegiatan Aktif
                                </span>
                                <span class="small fw-bold">
                                    {{ $stats['kegiatan_active'] ?? 0 }}/{{ $stats['kegiatan'] ?? 0 }}
                                </span>
                            </div>
                            <div class="progress" style="height: 8px; background-color: #FF6B6B20;">
                                @php
                                    $kegiatanPercent =
                                        $stats['kegiatan'] > 0
                                            ? ($stats['kegiatan_active'] / $stats['kegiatan']) * 100
                                            : 0;
                                @endphp
                                <div class="progress-bar rounded-pill" role="progressbar"
                                    style="width: {{ $kegiatanPercent }}%; background: linear-gradient(135deg, #FF6B6B 0%, #FF8E8E 100%);">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted d-flex align-items-center">
                                    <i class="bi bi-activity me-1" style="color: #FFB300"></i>
                                    Aktivitas Bulan Ini
                                </span>
                                <span class="small fw-bold">{{ number_format($stats['month_activities'] ?? 0) }}</span>
                            </div>
                            <div class="progress" style="height: 8px; background-color: #FFB30020;">
                                @php
                                    $activityPercent = min(100, (($stats['month_activities'] ?? 0) / 50) * 100);
                                @endphp
                                <div class="progress-bar rounded-pill" role="progressbar"
                                    style="width: {{ $activityPercent }}%; background: linear-gradient(135deg, #FFB300 0%, #FF9800 100%);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Top Articles --}}
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-header border-bottom-0 bg-white px-4 pb-0 pt-4">
                        <h6 class="fw-bold text-dark d-flex align-items-center mb-3">
                            <i class="bi bi-fire text-danger fs-5 me-2"></i>Artikel Terpopuler
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($topArticles as $article)
                                <a href="{{ route('admin.artikel.edit', $article->id) }}"
                                    class="list-group-item list-group-item-action hover-lift border-0 px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-2 me-3 flex-shrink-0 overflow-hidden"
                                            style="width: 40px; height: 40px; background-color: #667eea15;">
                                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                                class="object-fit-cover w-100 h-100"
                                                onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent('{{ $article->judul }}')+'&background=667eea&color=fff&size=200'">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">
                                                {{ Str::limit($article->judul, 40) }}
                                            </h6>
                                            <div class="d-flex align-items-center small text-muted">
                                                <div class="d-flex align-items-center me-3">
                                                    <i class="bi bi-eye me-1"></i>
                                                    <span>{{ number_format($article->views) }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-muted py-4 text-center">
                                    <div class="mb-3 opacity-25">
                                        <i class="bi bi-newspaper display-5"></i>
                                    </div>
                                    <p class="mb-0">Belum ada artikel</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Base Styles */
        .fw-extrabold {
            font-weight: 800;
        }

        .tracking-tight {
            letter-spacing: -0.025em;
        }

        .hover-scale:hover {
            transform: scale(1.1);
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .shadow-sm-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .hover-effect:hover i {
            transform: translateX(4px);
        }

        /* Modern Timeline Styles */
        .modern-timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline-item-modern {
            position: relative;
            padding: 15px 0 15px 80px;
            display: flex;
        }

        .timeline-item-modern:last-child {
            padding-bottom: 15px;
        }

        .timeline-indicator-wrapper {
            position: absolute;
            left: 0;
            top: 15px;
            width: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timeline-indicator {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
        }

        .timeline-item-modern:hover .timeline-indicator {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }

        .timeline-connector {
            width: 2px;
            flex: 1;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.05));
            margin: 8px 0;
        }

        .timeline-content-modern {
            flex: 1;
        }

        .timeline-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .timeline-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.12);
        }

        .timeline-header {
            margin-bottom: 15px;
        }

        .timeline-title {
            font-size: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .timeline-thumbnail {
            flex-shrink: 0;
        }

        .timeline-thumbnail .rounded-3 {
            border-radius: 10px !important;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .timeline-thumbnail .rounded-3:hover {
            transform: scale(1.05);
        }

        .timeline-description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }

        .timeline-action-btn {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .timeline-action-btn:hover {
            transform: translateY(-2px);
            border-color: currentColor !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Filter Section */
        #active-filter-badges .badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.3s ease;
        }

        #active-filter-badges .badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Filter Dropdown */
        .filter-option {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .filter-option:hover {
            background-color: rgba(0, 0, 0, 0.03) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
            transform: translateX(3px);
        }

        .filter-option.active {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
            border-color: rgba(var(--bs-primary-rgb), 0.2) !important;
            color: var(--bs-primary) !important;
        }

        .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .dropdown-header {
            font-size: 0.8rem;
            color: #6c757d;
            padding: 0.5rem 1rem;
        }

        /* Object Fit */
        .object-fit-cover {
            object-fit: cover;
        }

        /* Progress Bar */
        .progress {
            border-radius: 100px;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 100px;
            transition: width 1s ease-in-out;
        }

        /* List group item hover effect */
        .list-group-item-action:hover {
            background-color: rgba(102, 126, 234, 0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem !important;
            }

            .timeline-item-modern {
                padding-left: 60px;
            }

            .timeline-indicator-wrapper {
                width: 60px;
            }

            .timeline-indicator {
                width: 32px;
                height: 32px;
            }

            .timeline-card {
                padding: 15px;
            }

            .timeline-thumbnail .rounded-3 {
                width: 60px !important;
                height: 60px !important;
            }
        }

        /* Custom Colors */
        .bg-purple {
            background-color: #9C27B0 !important;
        }

        .text-purple {
            color: #9C27B0 !important;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate__fadeInUp {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Smooth scrolling for timeline */
        .modern-timeline {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Real-time Clock Update
        function updateDashboardClock() {
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const wibTime = new Date(utc + (3600000 * 7));

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const dayName = days[wibTime.getDay()];
            const date = wibTime.getDate();
            const monthName = months[wibTime.getMonth()];
            const year = wibTime.getFullYear();

            const hours = wibTime.getHours().toString().padStart(2, '0');
            const minutes = wibTime.getMinutes().toString().padStart(2, '0');
            const seconds = wibTime.getSeconds().toString().padStart(2, '0');

            const dateElement = document.getElementById('dashboard-date');
            const timeElement = document.getElementById('dashboard-time');

            if (dateElement) {
                dateElement.textContent = `${dayName}, ${date} ${monthName} ${year}`;
            }

            if (timeElement) {
                timeElement.textContent = `${hours}:${minutes}:${seconds} WIB`;
            }
        }

        // Filter System
        class ActivityFilter {
            constructor() {
                this.currentFilter = 'all';
                this.filterMap = {
                    'all': {
                        name: 'Semua',
                        icon: 'bi-grid-3x3-gap',
                        color: '#667eea'
                    },
                    'artikel': {
                        name: 'Artikel',
                        icon: 'bi-journal-text',
                        color: '#667eea'
                    },
                    'prestasi': {
                        name: 'Prestasi',
                        icon: 'bi-trophy',
                        color: '#FFB300'
                    },
                    'staff': {
                        name: 'Staff & Guru',
                        icon: 'bi-people',
                        color: '#9C27B0'
                    },
                    'galeri': {
                        name: 'Galeri',
                        icon: 'bi-images',
                        color: '#4CAF50'
                    },
                    'kegiatan': {
                        name: 'Kegiatan',
                        icon: 'bi-calendar-event',
                        color: '#FF6B6B'
                    }
                };
                this.init();
            }

            init() {
                this.setupFilterButtons();
                this.setupActiveFilterBadge();
            }

            setupFilterButtons() {
                const filterButtons = document.querySelectorAll('.filter-option');
                filterButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        const filter = button.getAttribute('data-filter');
                        this.setFilter(filter);
                    });
                });
            }

            setupActiveFilterBadge() {
                this.badgeContainer = document.getElementById('active-filter-badges');
                this.updateActiveFilterBadge();
            }

            setFilter(filter) {
                // Update active class on buttons
                document.querySelectorAll('.filter-option').forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.getAttribute('data-filter') === filter) {
                        btn.classList.add('active');
                    }
                });

                this.currentFilter = filter;

                // Filter timeline items
                this.filterTimelineItems();

                // Update active filter badge
                this.updateActiveFilterBadge();

                // Close dropdown
                const dropdown = document.querySelector('.dropdown-menu');
                const bsDropdown = bootstrap.Dropdown.getInstance(document.querySelector('.dropdown-toggle'));
                if (bsDropdown) bsDropdown.hide();
            }

            filterTimelineItems() {
                const items = document.querySelectorAll('.timeline-item-modern');
                let visibleCount = 0;

                items.forEach(item => {
                    const type = item.getAttribute('data-type');
                    const shouldShow = this.currentFilter === 'all' || type === this.currentFilter;

                    if (shouldShow) {
                        item.style.display = 'flex';
                        item.style.animation = 'fadeInUp 0.3s ease-out';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Update counter
                this.updateCounter(visibleCount);
            }

            updateCounter(count) {
                const counterElement = document.querySelector('.modern-timeline + .card-footer .small');
                if (counterElement && count > 0) {
                    counterElement.textContent = `Menampilkan ${count} aktivitas`;
                }
            }

            updateActiveFilterBadge() {
                if (!this.badgeContainer) return;

                this.badgeContainer.innerHTML = '';

                if (this.currentFilter !== 'all') {
                    const filterInfo = this.filterMap[this.currentFilter];
                    const badge = document.createElement('span');
                    badge.className = 'badge rounded-pill d-flex align-items-center';
                    badge.style.cssText = `background-color: ${filterInfo.color}15; color: ${filterInfo.color};`;
                    badge.innerHTML = `
                <i class="bi ${filterInfo.icon} me-1"></i>
                ${filterInfo.name}
                <button type="button" class="btn-close btn-close-sm ms-2" aria-label="Clear filter">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;

                    // Add clear filter functionality
                    const closeBtn = badge.querySelector('.btn-close');
                    closeBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        this.setFilter('all');
                    });

                    this.badgeContainer.appendChild(badge);
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize clock
            updateDashboardClock();
            setInterval(updateDashboardClock, 1000);

            // Initialize filter system
            const activityFilter = new ActivityFilter();

            // Add animation to dashboard cards
            setTimeout(() => {
                document.querySelectorAll('.hover-lift').forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.add('animate__fadeInUp');
                });
            }, 100);

            // Content Distribution Chart
            const ctx1 = document.getElementById('contentChart');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'doughnut',
                    data: {
                        labels: ['Artikel', 'Galeri TK', 'Galeri SD', 'Prestasi', 'Staff', 'Kegiatan'],
                        datasets: [{
                            data: [
                                {{ $stats['artikel'] ?? 0 }},
                                {{ $stats['galeri_tk'] ?? 0 }},
                                {{ $stats['galeri_sd'] ?? 0 }},
                                {{ $stats['prestasi'] ?? 0 }},
                                {{ $stats['staff'] ?? 0 }},
                                {{ $stats['kegiatan'] ?? 0 }}
                            ],
                            backgroundColor: [
                                'rgba(102, 126, 234, 0.8)',
                                'rgba(76, 175, 80, 0.8)',
                                'rgba(0, 188, 212, 0.8)',
                                'rgba(255, 179, 0, 0.8)',
                                'rgba(156, 39, 176, 0.8)',
                                'rgba(255, 107, 107, 0.8)'
                            ],
                            borderColor: [
                                'rgba(102, 126, 234, 1)',
                                'rgba(76, 175, 80, 1)',
                                'rgba(0, 188, 212, 1)',
                                'rgba(255, 179, 0, 1)',
                                'rgba(156, 39, 176, 1)',
                                'rgba(255, 107, 107, 1)'
                            ],
                            borderWidth: 2,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        cutout: '65%'
                    }
                });
            }

            // Weekly Activity Chart
            const ctx2 = document.getElementById('weeklyActivityChart');
            if (ctx2 && {{ isset($weeklyActivities) ? 'true' : 'false' }}) {
                const weeklyData = @json($weeklyActivities ?? []);
                new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: weeklyData.map(d => d.day),
                        datasets: [{
                            label: 'Aktivitas',
                            data: weeklyData.map(d => d.count),
                            borderColor: 'rgba(102, 126, 234, 1)',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
