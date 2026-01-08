@extends('layouts.app')

@section('title', 'Artikel & Jurnal - Yayasan Baitul Insan')

@section('content')
    <style>
        .bg-title-blue {
            background-color: #2547bc;
            border-radius: 50px;
            padding: 12px 60px;
            display: inline-block;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(37, 71, 188, 0.2);
        }

        .article-card {
            transition: all 0.5s ease;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
            border: none;
        }

        .article-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .article-card:hover img {
            transform: scale(1.1);
        }

        .img-container {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            aspect-ratio: 4/3;
        }

        .article-card img {
            transition: transform 0.7s ease;
            height: 100%;
            object-fit: cover;
        }

        .date-badge {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 16px;
            font-weight: bold;
            color: #2547bc;
            backdrop-filter: blur(10px);
            font-size: 0.875rem;
        }

        .jenis-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 0.75rem;
            z-index: 2;
        }

        .jurnal-badge {
            background-color: #0dcaf0;
            color: white;
        }

        .artikel-badge {
            background-color: #0d6efd;
            color: white;
        }

        .article-title {
            color: #333;
            transition: color 0.3s ease;
        }

        .article-card:hover .article-title {
            color: #2547bc;
        }

        .read-more-arrow {
            transition: transform 0.3s ease;
        }

        .article-card:hover .read-more-arrow {
            transform: translateX(5px);
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .pdf-icon {
            color: #d32f2f;
            font-size: 1.2rem;
        }

        .sidebar-widget {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .widget-title {
            font-weight: 600;
            color: #2547bc;
            border-bottom: 2px solid #eee;
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
        }

        .filter-badge {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-badge.active {
            background-color: #2547bc !important;
            color: white !important;
        }
    </style>

    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                {{-- Main Content --}}
                <div class="col-lg-9">
                    {{-- Header / Judul Halaman --}}
                    <div class="mb-5 text-center">
                        <div class="mb-4">
                            <h2 class="bg-title-blue fs-2 mb-2 shadow-sm">Artikel & Jurnal</h2>
                        </div>
                        <p class="text-muted fs-5 fw-medium mx-auto">
                            Beragam informasi, berita, jurnal, dan publikasi terbaru di Yayasan Baitul Insan.
                        </p>
                    </div>

                    {{-- Filter Tags --}}
                    <div class="mb-5">
                        <div class="d-flex justify-content-center flex-wrap gap-2">
                            <a href="{{ route('artikel.index') }}"
                                class="badge filter-badge {{ !request('jenis') && !request('search') && !request('tahun') ? 'active bg-primary text-white' : 'bg-light text-dark' }} px-3 py-2">
                                Semua
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=artikel"
                                class="badge filter-badge {{ request('jenis') == 'artikel' ? 'active bg-primary text-white' : 'bg-light text-dark' }} px-3 py-2">
                                Artikel
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=jurnal"
                                class="badge filter-badge {{ request('jenis') == 'jurnal' ? 'active bg-info text-white' : 'bg-light text-dark' }} px-3 py-2">
                                Jurnal
                            </a>
                            @foreach ($years as $year)
                                <a href="{{ route('artikel.index') }}?tahun={{ $year }}"
                                    class="badge filter-badge {{ request('tahun') == $year ? 'active bg-secondary text-white' : 'bg-light text-dark' }} px-3 py-2">
                                    {{ $year }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Search Box --}}
                    <div class="mb-5">
                        <form action="{{ route('artikel.index') }}" method="GET" class="row g-2">
                            <div class="col">
                                <input type="text" name="search" class="form-control form-control-lg"
                                    placeholder="Cari artikel atau jurnal..." value="{{ request('search') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                                @if (request('search') || request('jenis') || request('tahun'))
                                    <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    {{-- Grid Artikel & Jurnal --}}
                    <div class="row g-4 justify-content-center">
                        @forelse($artikel as $item)
                            <div class="col-lg-6">
                                <div class="article-card bg-white">
                                    {{-- Container Gambar --}}
                                    <div class="p-4 pb-0">
                                        <div class="img-container">
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                alt="{{ $item->judul }}" class="img-fluid w-100">

                                            {{-- Badge Jenis --}}
                                            <div
                                                class="jenis-badge {{ $item->jenis == 'jurnal' ? 'jurnal-badge' : 'artikel-badge' }}">
                                                {{ $item->jenis_label }}
                                            </div>

                                            {{-- Badge Tanggal --}}
                                            {{-- PERBAIKAN: Gunakan published_at atau created_at --}}
                                            <div class="date-badge">
                                                @php
                                                    $dateToShow = $item->published_at ?? $item->created_at;
                                                @endphp
                                                {{ $dateToShow->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Konten Teks --}}
                                    <div class="p-4">
                                        {{-- Judul --}}
                                        <h2 class="article-title fs-4 fw-bold lh-base mb-3">
                                            <a href="{{ route('artikel.show', $item->slug) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $item->judul }}
                                            </a>
                                        </h2>

                                        {{-- Info Tambahan untuk Jurnal --}}
                                        @if ($item->jenis == 'jurnal')
                                            <div class="mb-3">
                                                @if ($item->penulis)
                                                    <div class="text-muted small mb-1">
                                                        <i class="bi bi-person me-1"></i> {{ $item->penulis }}
                                                    </div>
                                                @endif
                                                @if ($item->tahun_terbit)
                                                    <div class="text-muted small mb-1">
                                                        <i class="bi bi-calendar me-1"></i> Tahun:
                                                        {{ $item->tahun_terbit }}
                                                    </div>
                                                @endif
                                                @if ($item->keywords)
                                                    <div class="mt-2">
                                                        @foreach (array_slice($item->keywords, 0, 3) as $keyword)
                                                            <span
                                                                class="badge bg-light text-dark mb-1 me-1">{{ $keyword }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Ringkasan --}}
                                        <p class="text-muted mb-4 line-clamp-3">
                                            {{ $item->ringkasan ?? Str::limit(strip_tags($item->isi), 130) }}
                                        </p>

                                        {{-- Footer Card --}}
                                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                            {{-- Info Tanggal & Views --}}
                                            <div class="text-muted small d-flex align-items-center">
                                                @php
                                                    $dateForInfo = $item->published_at ?? $item->created_at;
                                                @endphp
                                                <i class="bi bi-calendar3 me-2"></i>
                                                {{ $dateForInfo->format('d M Y') }}
                                                <span class="ms-3">
                                                    <i class="bi bi-eye me-1"></i> {{ $item->views }}
                                                </span>
                                            </div>

                                            {{-- Tombol Read More/PDF --}}
                                            <div class="d-flex gap-2">
                                                @if ($item->jenis == 'jurnal' && $item->hasPdf())
                                                    <a href="{{ route('artikel.download.pdf', $item->slug) }}"
                                                        class="btn btn-sm btn-outline-danger" title="Download PDF">
                                                        <i class="bi bi-file-earmark-pdf"></i> PDF
                                                    </a>
                                                @endif
                                                <a href="{{ route('artikel.show', $item->slug) }}"
                                                    class="text-primary text-decoration-none fw-semibold d-flex align-items-center">
                                                    Baca
                                                    <i class="bi bi-arrow-right read-more-arrow ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 py-5 text-center">
                                <img src="https://illustrations.popsy.co/gray/search-for-ideas.svg"
                                    class="img-fluid w-50 mx-auto mb-4 opacity-25">
                                <p class="fs-3 fw-bold text-secondary">Belum ada konten yang tersedia.</p>
                                <p class="text-secondary">Silakan kembali lagi nanti untuk informasi terbaru.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-5">
                        {{ $artikel->links() }}
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-3">
                    {{-- Widget Pencarian --}}
                    <div class="sidebar-widget">
                        <h5 class="widget-title">Pencarian</h5>
                        <form action="{{ route('artikel.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari..."
                                    value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Widget Jenis Konten --}}
                    <div class="sidebar-widget">
                        <h5 class="widget-title">Jenis Konten</h5>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('artikel.index') }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ !request('jenis') ? 'active' : '' }}">
                                Semua
                                <span class="badge bg-primary rounded-pill">{{ $artikel->total() }}</span>
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=artikel"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('jenis') == 'artikel' ? 'active' : '' }}">
                                Artikel
                                <span class="badge bg-primary rounded-pill">
                                    {{ \App\Models\Artikel::published()->where('jenis', 'artikel')->count() }}
                                </span>
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=jurnal"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('jenis') == 'jurnal' ? 'active' : '' }}">
                                Jurnal
                                <span class="badge bg-info rounded-pill">
                                    {{ \App\Models\Artikel::published()->where('jenis', 'jurnal')->count() }}
                                </span>
                            </a>
                        </div>
                    </div>

                    {{-- Widget Artikel Terbaru --}}
                    @if ($latest_articles->count() > 0)
                        <div class="sidebar-widget">
                            <h5 class="widget-title">Artikel Terbaru</h5>
                            <div class="list-group list-group-flush">
                                @foreach ($latest_articles as $latest)
                                    <a href="{{ route('artikel.show', $latest->slug) }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ Str::limit($latest->judul, 40) }}</h6>
                                            <small class="text-muted">
                                                @php
                                                    $latestDate = $latest->published_at ?? $latest->created_at;
                                                @endphp
                                                {{ $latestDate->format('d M') }}
                                            </small>
                                        </div>
                                        <small class="text-muted">
                                            {{ $latest->jenis_label }} • {{ $latest->views }} views
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Widget Tahun --}}
                    @if ($years->count() > 0)
                        <div class="sidebar-widget">
                            <h5 class="widget-title">Filter Tahun</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('artikel.index') }}"
                                    class="badge {{ !request('tahun') ? 'bg-primary text-white' : 'bg-light text-dark' }} px-3 py-2">
                                    Semua Tahun
                                </a>
                                @foreach ($years as $year)
                                    <a href="{{ route('artikel.index') }}?tahun={{ $year }}"
                                        class="badge {{ request('tahun') == $year ? 'bg-secondary text-white' : 'bg-light text-dark' }} px-3 py-2">
                                        {{ $year }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk filter badges
            document.querySelectorAll('.filter-badge').forEach(badge => {
                badge.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = this.href;
                });
            });

            // Highlight active filter
            const currentUrl = window.location.href;
            document.querySelectorAll('.list-group-item, .badge').forEach(item => {
                if (item.href === currentUrl) {
                    item.classList.add('active');
                }
            });
        });
    </script>
@endpush
