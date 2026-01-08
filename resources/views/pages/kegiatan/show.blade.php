@extends('layouts.app')

@section('title', $kegiatan->judul . ' - Yayasan Baitul Insan')

@section('content')
    <section class="kegiatan-detail-section position-relative overflow-hidden py-5">
        {{-- Background efek --}}
        <div class="position-absolute w-100 h-100 start-0 top-0">
            <div class="bg-blur"></div>
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>

        <div class="position-relative z-1 container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($kegiatan->judul, 30) }}</li>
                </ol>
            </nav>

            {{-- Konten Utama --}}
            <div class="row">
                {{-- Konten Artikel --}}
                <div class="col-lg-8">
                    @php
                        $hexColors = [
                            'primary' => '#667eea',
                            'success' => '#4CAF50',
                            'warning' => '#FFB300',
                            'info' => '#00BCD4',
                            'purple' => '#9C27B0',
                            'danger' => '#F44336',
                        ];
                        $currentColor = $hexColors[$kegiatan->warna] ?? '#667eea';

                        // Gunakan accessor dari model
                        $hasVideo = $kegiatan->has_video;
                        $isYouTube = $kegiatan->is_youtube;
                        $isVideoClickable = $kegiatan->is_video_clickable;
                        $thumbnailUrl = $kegiatan->thumbnail_url;
                        $videoId = $isYouTube ? $kegiatan->getYouTubeId() : null;
                    @endphp

                    <article class="kegiatan-article card mb-4 overflow-hidden border-0 shadow-lg">
                        {{-- Header Artikel --}}
                        <div class="card-header border-0 bg-white py-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center icon-container p-2"
                                        style="background-color: {{ $currentColor }}20; color: {{ $currentColor }}; width: 50px; height: 50px;">
                                        <i class="bi {{ $kegiatan->ikon ?? 'bi-calendar-event' }} fs-4"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark order-badge mb-2 border px-3 py-2"
                                        style="border-color: {{ $currentColor }};">
                                        <i class="bi bi-sort-numeric-down me-1"></i>
                                        Urutan: {{ $kegiatan->urutan }}
                                    </span>
                                </div>
                            </div>

                            <h1 class="fw-bold mb-3" style="color: #002366; font-size: 2.5rem;">
                                {{ $kegiatan->judul }}
                                @if ($hasVideo)
                                    <span class="badge bg-danger pulse-badge ms-2 align-middle">
                                        @if ($isYouTube)
                                            <i class="bi bi-youtube me-1"></i>YouTube
                                        @else
                                            <i class="bi bi-play-circle me-1"></i>Video
                                        @endif
                                    </span>
                                @endif
                            </h1>

                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="bi bi-calendar3 me-2"></i>
                                <span>{{ $kegiatan->created_at->translatedFormat('d F Y') }}</span>
                                <span class="mx-2">•</span>
                                <i class="bi bi-clock me-2"></i>
                                <span>{{ $kegiatan->created_at->format('H:i') }} WIB</span>
                                <span class="mx-2">•</span>
                                <i class="bi bi-eye me-2"></i>
                                <span>1.2K dilihat</span>
                            </div>

                            {{-- Badge Kategori --}}
                            <div class="mb-4">
                                <span class="badge rounded-pill fw-normal px-3 py-2"
                                    style="background: {{ $currentColor }}; color: white;">
                                    <i class="bi {{ $kegiatan->ikon ?? 'bi-star-fill' }} me-1"></i>
                                    {{ strtoupper($kegiatan->kategori_label ?? 'KEGIATAN') }}
                                </span>
                            </div>
                        </div>

                        {{-- Media (Gambar/Video) --}}
                        <div class="position-relative">
                            @if ($thumbnailUrl && filter_var($thumbnailUrl, FILTER_VALIDATE_URL))
                                <img src="{{ $thumbnailUrl }}" class="img-fluid w-100 media-image-detail"
                                    alt="{{ $kegiatan->judul }}" style="max-height: 500px; object-fit: cover;"
                                    data-has-video="{{ $hasVideo ? '1' : '0' }}"
                                    @if ($isVideoClickable) style="cursor: pointer;" @endif>
                            @elseif($kegiatan->gambar)
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid w-100"
                                    alt="{{ $kegiatan->judul }}" style="max-height: 500px; object-fit: cover;">
                            @else
                                <div class="bg-light media-placeholder-detail py-5 text-center"
                                    style="min-height: 300px; cursor: {{ $isVideoClickable ? 'pointer' : 'default' }};"
                                    data-has-video="{{ $hasVideo ? '1' : '0' }}">
                                    <i class="bi bi-calendar-event display-1 text-muted mb-3"></i>
                                    <h4 class="text-muted">{{ $kegiatan->judul }}</h4>
                                </div>
                            @endif

                            {{-- Tombol Play untuk video --}}
                            @if ($isVideoClickable)
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <button class="btn btn-danger btn-lg rounded-circle open-video-modal shadow-lg"
                                        data-modal-target="#videoModal" style="width: 80px; height: 80px; z-index: 10;">
                                        <i class="bi bi-play-fill fs-3"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        {{-- Body Artikel --}}
                        <div class="card-body py-4">
                            {{-- Deskripsi Lengkap --}}
                            <div class="content-text mb-5">
                                {!! $kegiatan->deskripsi !!}
                            </div>

                            {{-- Tags --}}
                            @if ($kegiatan->tags)
                                @php
                                    // Handle tags in multiple formats
                                    if (is_string($kegiatan->tags)) {
                                        $tagArray = explode(',', $kegiatan->tags);
                                    } elseif (is_array($kegiatan->tags)) {
                                        $tagArray = $kegiatan->tags;
                                    } else {
                                        $tagArray = [];
                                    }

                                    // Filter and clean tags
                                    $tagArray = array_filter(array_map('trim', $tagArray));
                                @endphp

                                @if (!empty($tagArray))
                                    <div class="mb-5">
                                        <h5 class="fw-bold mb-3" style="color: #002366;">
                                            <i class="bi bi-tags me-2"></i>Tags
                                        </h5>
                                        <div class="tags-container">
                                            @foreach ($tagArray as $tag)
                                                @if (!empty($tag))
                                                    <span class="tag-item badge rounded-pill mb-2 me-2 px-3 py-2"
                                                        style="background: {{ $currentColor }}10; color: {{ $currentColor }}; border: 1px solid {{ $currentColor }}20;">
                                                        <i class="bi bi-tag me-1"></i>{{ $tag }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Tombol Aksi --}}
                            <div class="d-flex mb-4 flex-wrap gap-3">
                                @if ($hasVideo)
                                    <button class="btn btn-danger watch-video-btn open-video-modal"
                                        data-modal-target="#videoModal">
                                        @if ($isYouTube)
                                            <i class="bi bi-youtube me-2"></i>Tonton Video di YouTube
                                        @else
                                            <i class="bi bi-play-circle me-2"></i>Tonton Video
                                        @endif
                                    </button>
                                @endif

                                <button class="btn btn-outline-primary share-btn" onclick="shareContent()">
                                    <i class="bi bi-share me-2"></i>Bagikan
                                </button>

                                <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    {{-- Kegiatan Terkait --}}
                    @if ($related->count() > 0)
                        <div class="card mb-4 border-0 shadow-lg">
                            <div class="card-header bg-primary border-0 text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-link me-2"></i>Kegiatan Terkait
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                @foreach ($related as $item)
                                    @php
                                        $relatedColor = $hexColors[$item->warna] ?? '#667eea';
                                    @endphp
                                    <a href="{{ route('kegiatan.show', $item->route_slug) }}" class="text-decoration-none">
                                        <div class="related-item border-bottom p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="background-color: {{ $relatedColor }}20; color: {{ $relatedColor }}; width: 40px; height: 40px;">
                                                        <i class="bi {{ $item->ikon ?? 'bi-calendar-event' }}"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="fw-bold mb-1" style="color: #002366;">
                                                        {{ Str::limit($item->judul, 50) }}
                                                    </h6>
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar3 me-1"></i>
                                                        {{ $item->created_at->format('d M Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Kategori --}}
                    <div class="card mb-4 border-0 shadow-lg">
                        <div class="card-header border-0 bg-white">
                            <h5 class="mb-0" style="color: #002366;">
                                <i class="bi bi-grid me-2"></i>Kategori Kegiatan
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="list-group list-group-flush">
                                @foreach ($kategoriOptions as $key => $label)
                                    <a href="{{ route('kegiatan.index') }}?kategori={{ $key }}"
                                        class="list-group-item list-group-item-action border-0 py-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>{{ $label }}</span>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Info Kegiatan --}}
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 bg-white">
                            <h5 class="mb-0" style="color: #002366;">
                                <i class="bi bi-info-circle me-2"></i>Informasi Kegiatan
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="background-color: {{ $currentColor }}20; color: {{ $currentColor }}; width: 36px; height: 36px;">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Tanggal</small>
                                            <strong>{{ $kegiatan->created_at->translatedFormat('d F Y') }}</strong>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="background-color: {{ $currentColor }}20; color: {{ $currentColor }}; width: 36px; height: 36px;">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Waktu</small>
                                            <strong>{{ $kegiatan->created_at->format('H:i') }} WIB</strong>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="background-color: {{ $currentColor }}20; color: {{ $currentColor }}; width: 36px; height: 36px;">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Dilihat</small>
                                            <strong>1.2K kali</strong>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Video --}}
    @if ($hasVideo)
        <div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
            aria-hidden="true" data-video-type="{{ $isYouTube ? 'youtube' : 'local' }}"
            data-youtube-id="{{ $isYouTube ? $videoId : '' }}">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="modal-header bg-gradient border-0 py-3 text-white">
                        <div class="d-flex align-items-center w-100">
                            <div class="modal-icon me-3">
                                @if ($isYouTube)
                                    <i class="bi bi-youtube fs-2"></i>
                                @else
                                    <i class="bi bi-play-circle fs-2"></i>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="modal-title mb-0" id="videoModalLabel">
                                    {{ $kegiatan->judul }}
                                </h5>
                                <small class="opacity-75">
                                    {{ $kegiatan->kategori_label }} •
                                    {{ $kegiatan->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        @if ($isYouTube && $videoId)
                            {{-- Embed YouTube yang bisa diklik --}}
                            <div class="ratio ratio-16x9 youtube-embed-container">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&playsinline=1"
                                    title="{{ $kegiatan->judul }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen loading="lazy" id="youtubeIframe" class="youtube-video-player">
                                </iframe>
                            </div>
                        @elseif($hasVideo && !$isYouTube && $kegiatan->video_url)
                            {{-- Video lokal --}}
                            <div class="ratio ratio-16x9">
                                <video controls class="w-100 h-100" poster="{{ $thumbnailUrl ?? '' }}"
                                    controlsList="nodownload" id="localVideo"
                                    style="object-fit: contain; background: #000;">
                                    <source src="{{ $kegiatan->video_url }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            </div>
                        @else
                            <div class="p-5 text-center">
                                <i class="bi bi-exclamation-triangle display-1 text-warning mb-3"></i>
                                <h4 class="mb-3">Video tidak dapat dimuat</h4>
                                <p class="text-muted">Silakan coba lagi atau hubungi administrator.</p>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer bg-light border-top py-3">
                        <div class="w-100">
                            <h6 class="fw-bold mb-0">{{ Str::limit($kegiatan->judul, 50) }}</h6>
                            <p class="text-muted small mb-0 mt-2">
                                {{ Str::limit(strip_tags($kegiatan->deskripsi), 120) }}
                            </p>
                        </div>
                        <button type="button" class="btn btn-outline-primary rounded-pill close-modal-btn px-4"
                            data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .kegiatan-detail-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .bg-blur {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(76, 175, 80, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 179, 0, 0.1) 0%, transparent 50%);
            filter: blur(40px);
            animation: bgFloat 20s ease-in-out infinite;
        }

        .floating-shapes .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), transparent);
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 5s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 15%;
            animation-delay: 10s;
        }

        .shape-4 {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 20%;
            animation-delay: 15s;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .kegiatan-article {
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        .kegiatan-article:hover {
            transform: translateY(-5px);
        }

        .icon-container {
            transition: all 0.3s ease;
        }

        .icon-container:hover {
            transform: rotate(15deg) scale(1.1);
        }

        .order-badge {
            transition: all 0.3s ease;
        }

        .order-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pulse-badge {
            animation: pulse 2s infinite;
        }

        .content-text {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
        }

        .content-text p {
            margin-bottom: 1.5rem;
        }

        .content-text img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 1rem 0;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-item {
            transition: all 0.3s ease;
        }

        .tag-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: currentColor !important;
        }

        .watch-video-btn {
            transition: all 0.3s ease;
        }

        .watch-video-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
        }

        .share-btn {
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .related-item {
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .related-item:hover {
            background-color: rgba(0, 35, 102, 0.05);
            transform: translateX(5px);
        }

        @keyframes bgFloat {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(20px, 20px) rotate(5deg);
            }

            50% {
                transform: translate(-15px, 10px) rotate(-5deg);
            }

            75% {
                transform: translate(10px, -15px) rotate(3deg);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }

        /* STYLE FIX UNTUK MODAL VIDEO (SAMA DENGAN INDEX) */
        /* RESET Z-INDEX UTAMA DENGAN BACKDROP FIX */
        .modal-backdrop {
            z-index: 1040 !important;
            pointer-events: none !important;
            /* BACKDROP TIDAK MENGHALANGI KLIK */
        }

        .modal {
            z-index: 1050 !important;
        }

        .modal-dialog {
            z-index: 1055 !important;
            position: relative;
        }

        .modal-content {
            z-index: 1060 !important;
            position: relative;
        }

        /* YouTube Container FIX */
        .youtube-embed-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            background: #000;
            overflow: hidden;
        }

        .youtube-embed-container iframe {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 9999 !important;
            pointer-events: auto !important;
            border: none !important;
        }

        /* Fix untuk video lokal */
        .modal-body video {
            z-index: 9999 !important;
            pointer-events: auto !important;
        }

        /* Efek untuk gambar yang bisa diklik */
        .media-image-detail[data-has-video="1"] {
            cursor: pointer;
        }

        .media-placeholder-detail[data-has-video="1"] {
            cursor: pointer;
        }

        /* Pastikan modal di atas semua elemen */
        .modal.show {
            display: block !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        /* Fix untuk body saat modal terbuka */
        body.modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .kegiatan-article h1 {
                font-size: 2rem !important;
            }

            .content-text {
                font-size: 1rem;
            }

            .d-flex.flex-wrap.gap-3 {
                justify-content: center;
            }

            .d-flex.flex-wrap.gap-3 .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // FUNGSI SEDERHANA UNTUK MEMBUKA MODAL (SAMA DENGAN INDEX)
        function openVideoModal(modalId) {
            console.log('Opening modal:', modalId);
            const modalElement = document.getElementById(modalId);
            if (!modalElement) {
                console.error('Modal element not found:', modalId);
                return;
            }

            // Gunakan Bootstrap Modal API
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true,
                focus: true
            });

            modal.show();

            // SETEL POINTER-EVENTS SETELAH MODAL TERBUKA
            setTimeout(() => {
                // Pastikan backdrop tidak menghalangi klik
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.style.pointerEvents = 'none';
                }

                // Pastikan iframe/video bisa diklik
                const iframe = modalElement.querySelector('iframe');
                const video = modalElement.querySelector('video');

                if (iframe) {
                    iframe.style.pointerEvents = 'auto';
                    // Tambahkan autoplay untuk YouTube
                    const currentSrc = iframe.src;
                    if (!currentSrc.includes('autoplay=1')) {
                        const separator = currentSrc.includes('?') ? '&' : '?';
                        iframe.src = currentSrc + separator + 'autoplay=1&mute=1';
                    }
                }

                if (video) {
                    video.style.pointerEvents = 'auto';
                    video.muted = true;
                    video.play().catch(e => {
                        console.log('Autoplay prevented:', e);
                        video.controls = true;
                    });
                }

                console.log('Modal opened with clickable content:', modalId);
            }, 100);
        }

        // EVENT LISTENER UNTUK SEMUA ELEMEN YANG BISA MEMBUKA MODAL
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded - Initializing video modal for detail page...');

            // 1. Tombol "Tonton Video"
            document.querySelectorAll('.open-video-modal').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const modalTarget = this.getAttribute('data-modal-target');
                    if (modalTarget) {
                        const modalId = modalTarget.replace('#', '');
                        openVideoModal(modalId);
                    }
                });
            });

            // 2. Gambar thumbnail yang bisa diklik
            document.querySelectorAll('.media-image-detail[data-has-video="1"]').forEach(img => {
                img.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openVideoModal('videoModal');
                });
            });

            // 3. Placeholder yang bisa diklik
            document.querySelectorAll('.media-placeholder-detail[data-has-video="1"]').forEach(placeholder => {
                placeholder.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openVideoModal('videoModal');
                });
            });

            // EVENT UNTUK MODAL (Stop video saat modal ditutup)
            const videoModal = document.getElementById('videoModal');
            if (videoModal) {
                const videoType = videoModal.getAttribute('data-video-type');

                // Event saat modal ditampilkan
                videoModal.addEventListener('shown.bs.modal', function() {
                    console.log('Modal shown for detail page');

                    // Pastikan iframe/video bisa diklik
                    const iframe = videoModal.querySelector('iframe');
                    const video = videoModal.querySelector('video');

                    if (iframe) {
                        iframe.style.pointerEvents = 'auto';
                        iframe.style.zIndex = '9999';
                    }

                    if (video) {
                        video.style.pointerEvents = 'auto';
                        video.style.zIndex = '9999';
                    }

                    // Pastikan backdrop tidak menghalangi klik
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.style.pointerEvents = 'none';
                    }
                });

                // Event saat modal disembunyikan
                videoModal.addEventListener('hide.bs.modal', function() {
                    console.log('Modal hidden for detail page');

                    // Untuk YouTube - hentikan video
                    const iframe = videoModal.querySelector('iframe');
                    if (iframe) {
                        // Ganti src untuk menghentikan video
                        const currentSrc = iframe.src;
                        const newSrc = currentSrc
                            .replace('&autoplay=1', '')
                            .replace('?autoplay=1', '?')
                            .replace('&mute=1', '')
                            .replace('?mute=1', '?');

                        // Bersihkan URL
                        let cleanSrc = newSrc.replace(/\?&/g, '?').replace(/\?\?/g, '?');
                        if (cleanSrc.endsWith('?')) {
                            cleanSrc = cleanSrc.slice(0, -1);
                        }

                        iframe.src = cleanSrc;
                    }

                    // Untuk video lokal
                    const video = videoModal.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            }

            // Fungsi untuk membagikan konten
            window.shareContent = function() {
                if (navigator.share) {
                    navigator.share({
                            title: '{{ $kegiatan->judul }}',
                            text: '{{ Str::limit(strip_tags($kegiatan->deskripsi), 100) }}',
                            url: window.location.href,
                        })
                        .then(() => console.log('Berhasil membagikan'))
                        .catch((error) => console.log('Error sharing:', error));
                } else {
                    // Fallback untuk browser yang tidak mendukung Web Share API
                    navigator.clipboard.writeText(window.location.href)
                        .then(() => {
                            alert('Link telah disalin ke clipboard!');
                        })
                        .catch(err => {
                            console.error('Gagal menyalin link:', err);
                        });
                }
            };

            // Efek scroll untuk header
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.kegiatan-article .card-header');
                if (window.scrollY > 100) {
                    header.classList.add('shadow-sm');
                } else {
                    header.classList.remove('shadow-sm');
                }
            });

            // Inisialisasi AOS jika ada
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 50
                });
            }

            console.log('Video modal initialization complete for detail page');
        });

        // Fallback jika Bootstrap tidak ada
        if (typeof bootstrap === 'undefined') {
            console.warn('Bootstrap not loaded, using fallback modal handling');

            // Simple modal function
            window.openVideoModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'block';
                    modal.classList.add('show');
                    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                    modal.style.zIndex = '1050';

                    // Pastikan iframe/video bisa diklik
                    const iframe = modal.querySelector('iframe');
                    const video = modal.querySelector('video');

                    if (iframe) {
                        iframe.style.pointerEvents = 'auto';
                        iframe.style.zIndex = '9999';
                    }

                    if (video) {
                        video.style.pointerEvents = 'auto';
                        video.style.zIndex = '9999';
                    }

                    // Tambahkan event untuk tutup
                    const closeBtns = modal.querySelectorAll('[data-bs-dismiss="modal"], .close-modal-btn');
                    closeBtns.forEach(btn => {
                        btn.addEventListener('click', function() {
                            modal.style.display = 'none';
                            modal.classList.remove('show');
                            modal.style.backgroundColor = '';
                        });
                    });
                }
            };
        }
    </script>
@endpush
