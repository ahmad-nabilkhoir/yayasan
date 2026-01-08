@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
    {{-- AOS Library untuk Animasi Halus --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Google Font Inter untuk kesan Modern --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <section class="bg-light py-lg-6 py-5" style="font-family: 'Inter', sans-serif;">
        <div class="container">
            <div class="row justify-content-center">
                {{-- Main Content --}}
                <div class="col-lg-8 col-xl-9">
                    {{-- Breadcrumb --}}
                    <nav class="mb-md-5 mb-4" data-aos="fade-down">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('artikel.index') }}" class="text-decoration-none text-muted">Artikel &
                                    Jurnal</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('artikel.index') }}?jenis={{ $artikel->jenis }}"
                                    class="text-decoration-none text-muted">{{ $artikel->jenis_label }}</a>
                            </li>
                            <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">
                                {{ Str::limit($artikel->judul, 40) }}
                            </li>
                        </ol>
                    </nav>

                    {{-- Headline --}}
                    <header class="mb-md-5 mb-4">
                        <h1 class="display-5 fw-bold text-dark mb-4" data-aos="fade-up">
                            {{ $artikel->judul }}
                        </h1>

                        {{-- Meta Info --}}
                        <div class="d-flex align-items-center mb-3 flex-wrap gap-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="badge bg-primary text-primary bg-opacity-10 px-3 py-2">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{-- PERBAIKAN: Gunakan created_at jika published_at null --}}
                                @php
                                    $tanggalArtikel = $artikel->published_at ?? $artikel->created_at;
                                @endphp
                                {{ $tanggalArtikel->format('d F Y') }}
                            </div>
                            <div class="badge bg-success text-success bg-opacity-10 px-3 py-2">
                                <i class="bi bi-eye me-2"></i>
                                {{ $artikel->views }} dilihat
                            </div>
                            @if ($artikel->penulis)
                                <div class="badge bg-secondary text-secondary bg-opacity-10 px-3 py-2">
                                    <i class="bi bi-person me-2"></i>
                                    {{ $artikel->penulis }}
                                </div>
                            @endif
                            @if ($artikel->tahun_terbit)
                                <div class="badge bg-info text-info bg-opacity-10 px-3 py-2">
                                    <i class="bi bi-calendar me-2"></i>
                                    Tahun {{ $artikel->tahun_terbit }}
                                </div>
                            @endif
                        </div>

                        {{-- Keywords --}}
                        @if ($artikel->keywords && count($artikel->keywords) > 0)
                            <div class="mt-3" data-aos="fade-up" data-aos-delay="200">
                                <small class="text-muted me-2">Keywords:</small>
                                @foreach ($artikel->keywords as $keyword)
                                    <span class="badge bg-light text-dark mb-1 me-1 border">{{ $keyword }}</span>
                                @endforeach
                            </div>
                        @endif
                    </header>

                    {{-- PDF Download Button untuk Jurnal --}}
                    @if ($artikel->jenis == 'jurnal' && $artikel->hasPdf())
                        <div class="mb-5" data-aos="fade-up" data-aos-delay="300">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger rounded-circle me-3 bg-opacity-10 p-3">
                                                <i class="bi bi-file-earmark-pdf fs-3 text-danger"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">Download Jurnal PDF</h5>
                                                <p class="text-muted mb-0">Unduh versi lengkap jurnal ini dalam format PDF
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('artikel.preview.pdf', $artikel->slug) }}" target="_blank"
                                                class="btn btn-outline-primary">
                                                <i class="bi bi-eye me-1"></i> Preview
                                            </a>
                                            <a href="{{ route('artikel.download.pdf', $artikel->slug) }}"
                                                class="btn btn-danger">
                                                <i class="bi bi-download me-1"></i> Download PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Hero Image --}}
                    <div class="rounded-4 border-5 mb-5 overflow-hidden border-white shadow-lg" data-aos="zoom-in">
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}"
                            class="img-fluid w-100 artikel-hero-image">
                    </div>

                    {{-- Ringkasan --}}
                    @if ($artikel->ringkasan)
                        <div class="mb-5" data-aos="fade-up">
                            <div class="card border-start-4 border-primary">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">
                                        <i class="bi bi-text-paragraph me-2"></i> Ringkasan
                                    </h5>
                                    <p class="card-text fs-5">{{ $artikel->ringkasan }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Main Content --}}
                    <article class="artikel-isi mb-5" data-aos="fade-up">
                        {!! $artikel->isi !!}
                    </article>

                    {{-- Referensi untuk Jurnal --}}
                    @if ($artikel->jenis == 'jurnal' && $artikel->referensi)
                        <div class="mb-5" data-aos="fade-up">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-book me-2"></i> Referensi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="referensi-content">
                                        {!! nl2br(e($artikel->referensi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <hr class="my-5">

                    {{-- Share Artikel --}}
                    <div class="mb-5" data-aos="fade-up">
                        <h5 class="fw-bold mb-3">Bagikan {{ $artikel->jenis_label }}</h5>
                        <div class="d-flex gap-2">
                            <button onclick="shareToFacebook()" class="btn btn-outline-primary">
                                <i class="bi bi-facebook me-1"></i> Facebook
                            </button>
                            <button onclick="shareToTwitter()" class="btn btn-outline-info">
                                <i class="bi bi-twitter me-1"></i> Twitter
                            </button>
                            <button onclick="shareToWhatsApp()" class="btn btn-outline-success">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </button>
                            <button onclick="copyLink()" class="btn btn-outline-secondary">
                                <i class="bi bi-link me-1"></i> Copy Link
                            </button>
                        </div>
                    </div>

                    {{-- Related Posts Section --}}
                    @if ($related->count() > 0)
                        <div class="border-top mt-5 pt-5" data-aos="fade-up">
                            {{-- Judul Seksi --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="h3 fw-bold text-dark">
                                    {{ $artikel->jenis == 'jurnal' ? 'Jurnal Lainnya' : 'Artikel Terkait' }}</h3>
                                <a href="{{ route('artikel.index') }}?jenis={{ $artikel->jenis }}"
                                    class="text-decoration-none fw-semibold text-primary">
                                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>

                            <div class="row g-4">
                                @foreach ($related as $item)
                                    <div class="col-md-6">
                                        <a href="{{ route('artikel.show', $item->slug) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="card h-100 related-card border-0 shadow-sm">
                                                <div class="position-relative rounded-top-3 overflow-hidden"
                                                    style="height: 180px;">
                                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                        alt="{{ $item->judul }}"
                                                        class="img-fluid w-100 h-100 object-fit-cover related-image">
                                                    <div
                                                        class="position-absolute w-100 h-100 related-overlay start-0 top-0">
                                                    </div>
                                                    <div class="position-absolute end-0 top-0 m-2">
                                                        <span
                                                            class="badge {{ $item->jenis == 'jurnal' ? 'bg-info' : 'bg-primary' }} rounded-pill px-2 py-1">
                                                            {{ $item->jenis_label }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold related-title mb-2">
                                                        {{ Str::limit($item->judul, 60) }}
                                                    </h5>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted small mb-0">
                                                            <i class="bi bi-calendar3 me-1"></i>
                                                            {{-- PERBAIKAN: Cek jika published_at null --}}
                                                            @php
                                                                $itemDate = $item->published_at ?? $item->created_at;
                                                            @endphp
                                                            {{ $itemDate->format('d M Y') }}
                                                        </p>
                                                        @if ($item->jenis == 'jurnal' && $item->hasPdf())
                                                            <span class="text-danger small">
                                                                <i class="bi bi-file-earmark-pdf"></i> PDF
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 col-xl-3">
                    {{-- Widget Jenis Konten --}}
                    <div class="sidebar-widget mb-4">
                        <h5 class="widget-title">Jenis Konten</h5>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('artikel.index') }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Semua
                                <span
                                    class="badge bg-primary rounded-pill">{{ \App\Models\Artikel::where('status', 'published')->count() }}</span>
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=artikel"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Artikel
                                <span class="badge bg-primary rounded-pill">
                                    {{ \App\Models\Artikel::where('status', 'published')->where('jenis', 'artikel')->count() }}
                                </span>
                            </a>
                            <a href="{{ route('artikel.index') }}?jenis=jurnal"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Jurnal
                                <span class="badge bg-info rounded-pill">
                                    {{ \App\Models\Artikel::where('status', 'published')->where('jenis', 'jurnal')->count() }}
                                </span>
                            </a>
                        </div>
                    </div>

                    {{-- Widget Artikel Populer --}}
                    @if ($popular_articles->count() > 0)
                        <div class="sidebar-widget mb-4">
                            <h5 class="widget-title">Populer</h5>
                            <div class="list-group list-group-flush">
                                @foreach ($popular_articles as $popular)
                                    <a href="{{ route('artikel.show', $popular->slug) }}"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $popular->thumbnail) }}"
                                                alt="{{ $popular->judul }}" class="me-3 rounded"
                                                style="width: 60px; height: 40px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1" style="font-size: 0.9rem;">
                                                    {{ Str::limit($popular->judul, 35) }}</h6>
                                                <small class="text-muted">
                                                    {{-- PERBAIKAN: Cek jika published_at null --}}
                                                    @php
                                                        $popularDate = $popular->published_at ?? $popular->created_at;
                                                    @endphp
                                                    {{ $popularDate->format('d M') }} • {{ $popular->views }} views
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Widget Keywords --}}
                    @php
                        $allKeywords = \App\Models\Artikel::where('status', 'published')
                            ->whereNotNull('keywords')
                            ->pluck('keywords')
                            ->flatten()
                            ->unique()
                            ->take(10);
                    @endphp
                    @if ($allKeywords->count() > 0)
                        <div class="sidebar-widget mb-4">
                            <h5 class="widget-title">Kata Kunci Populer</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($allKeywords as $keyword)
                                    <a href="{{ route('artikel.index') }}?search={{ urlencode($keyword) }}"
                                        class="badge bg-light text-dark border">
                                        {{ $keyword }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Share Functions
        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function shareToTwitter() {
            const text = encodeURIComponent("{{ $artikel->judul }}");
            const url = encodeURIComponent(window.location.href);
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
        }

        function shareToWhatsApp() {
            const text = encodeURIComponent("{{ $artikel->judul }} - " + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link berhasil disalin!');
            });
        }
    </script>
@endsection

@push('styles')
    <style>
        /* Custom styles for article content */
        .artikel-isi {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #334155;
        }

        .artikel-isi h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .artikel-isi h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
        }

        .artikel-isi p {
            margin-bottom: 1.8rem;
            text-align: justify;
        }

        /* Style untuk gambar di dalam artikel */
        .artikel-isi img {
            border-radius: 1rem;
            margin: 2rem auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }

        /* Blockquote jika ada */
        .artikel-isi blockquote {
            border-left: 5px solid #2563eb;
            background: #f8fafc;
            padding: 1.5rem 2rem;
            font-style: italic;
            border-radius: 0 1rem 1rem 0;
            margin: 2rem 0;
        }

        /* List styling */
        .artikel-isi ul,
        .artikel-isi ol {
            margin-bottom: 1.8rem;
            padding-left: 1.5rem;
        }

        .artikel-isi li {
            margin-bottom: 0.5rem;
        }

        /* Hero image styling */
        .artikel-hero-image {
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .artikel-hero-image:hover {
            transform: scale(1.02);
        }

        /* Related posts styling */
        .related-card {
            transition: all 0.3s ease;
            height: 100%;
        }

        .related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .related-image {
            transition: transform 0.5s ease;
        }

        .related-card:hover .related-image {
            transform: scale(1.1);
        }

        .related-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .related-card:hover .related-overlay {
            opacity: 1;
        }

        .related-title {
            color: #1e293b;
            transition: color 0.3s ease;
        }

        .related-card:hover .related-title {
            color: #2563eb;
        }

        /* Sidebar widget */
        .sidebar-widget {
            background: white;
            border-radius: 1rem;
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

        /* Referensi styling */
        .referensi-content {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .artikel-isi {
                font-size: 1rem;
            }

            .artikel-isi h2 {
                font-size: 1.75rem;
            }

            .artikel-isi h3 {
                font-size: 1.5rem;
            }

            .artikel-hero-image {
                height: 250px;
            }

            .display-5 {
                font-size: 2rem;
            }
        }
    </style>
@endpush
