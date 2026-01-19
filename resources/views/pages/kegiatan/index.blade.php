@extends('layouts.app')
@section('title', 'Kegiatan Kami - Yayasan Baitul Insan')
@section('content')
    <section class="kegiatan-section position-relative overflow-hidden py-5">
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

        {{-- ✅ Perbaikan utama: HAPUS z-1 atau ubah ke z-index: auto --}}
        <div class="position-relative container" style="overflow: visible !important; z-index: auto;">
            {{-- Header: Pill Title --}}
            <div class="header-animation mb-5 text-center">
                <span class="bg-title-blue fs-2 mb-2 shadow-sm">Kegiatan Kami</span>
                <p class="text-muted fs-5 fw-medium mx-auto" style="max-width: 700px;">
                    Rangkaian kegiatan edukatif dan kreatif yang mendukung perkembangan bakat dan minat santri di Yayasan
                    Baitul Insan.
                </p>

                {{-- Filter Kategori --}}
                @if ($kategoriOptions && count($kategoriOptions) > 0)
                    <div class="fade-in-up mt-4" style="animation-delay: 0.4s;">
                        {{-- Mobile --}}
                        {{-- Mobile Swipe Filter --}}
                        <div class="d-lg-none fade-in-up mt-4" style="animation-delay: 0.4s;">
                            <div class="kategori-scroll-wrapper px-2">
                                <div class="kategori-scroll d-flex gap-2">

                                    {{-- Semua --}}
                                    <a href="{{ route('kegiatan.index') }}"
                                        class="kategori-chip {{ !request('kategori') ? 'active' : '' }}">
                                        <i class="bi bi-grid-3x3-gap me-1"></i>
                                        Semua
                                    </a>

                                    {{-- Kategori --}}
                                    @foreach ($kategoriOptions as $key => $label)
                                        <a href="?kategori={{ $key }}"
                                            class="kategori-chip {{ request('kategori') == $key ? 'active' : '' }}">
                                            <i class="bi {{ $kategoriIcons[$key] ?? 'bi-star' }} me-1"></i>
                                            {{ $label }}
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        {{-- Desktop --}}
                        <div class="d-none d-lg-flex justify-content-center">
                            <div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Filter kategori">
                                <a href="{{ route('kegiatan.index') }}"
                                    class="btn btn-outline-primary rounded-pill {{ !request('kategori') ? 'active' : '' }} px-4 py-2">
                                    <i class="bi bi-grid-3x3-gap me-1"></i>Semua
                                </a>
                                @foreach ($kategoriOptions as $key => $label)
                                    <a href="?kategori={{ $key }}"
                                        class="btn btn-outline-primary rounded-pill {{ request('kategori') == $key ? 'active' : '' }} px-4 py-2">
                                        <i class="bi {{ $kategoriIcons[$key] ?? 'bi-star' }} me-1"></i>{{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Daftar Kegiatan --}}
            <div class="row g-5" style="overflow: visible !important;">
                @forelse($kegiatans as $index => $kegiatan)
                    @php
                        $isEven = $index % 2 == 0;
                        $hexColors = [
                            'primary' => '#667eea',
                            'success' => '#4CAF50',
                            'warning' => '#FFB300',
                            'info' => '#00BCD4',
                            'purple' => '#9C27B0',
                            'danger' => '#F44336',
                        ];
                        $currentColor = $hexColors[$kegiatan->warna] ?? '#667eea';
                        $hasVideo = $kegiatan->has_video;
                        $isYouTube = $kegiatan->is_youtube;
                        $hasThumbnail = $kegiatan->has_thumbnail;
                        $isVideoClickable = $kegiatan->is_video_clickable;
                        $thumbnailUrl = $kegiatan->thumbnail_url;
                        $videoId = $isYouTube ? $kegiatan->getYouTubeId() : null;
                        $routeSlug = $kegiatan->route_slug;
                        $darkerColorMap = [
                            'primary' => '#5a67d8',
                            'success' => '#3d8b40',
                            'warning' => '#e6a700',
                            'info' => '#00a5b5',
                            'purple' => '#7b1fa2',
                            'danger' => '#d32f2f',
                        ];
                        $darkerColor = $darkerColorMap[$kegiatan->warna] ?? '#5a67d8';
                    @endphp

                    <div class="col-12 mb-5" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="kegiatan-card card overflow-hidden border-0 shadow-lg">
                            <div class="row align-items-stretch g-0 {{ $isEven ? '' : 'flex-row-reverse' }}">
                                {{-- Sisi Gambar/Video --}}
                                <div class="col-lg-6">
                                    <div class="media-container h-100 position-relative"
                                        @if ($isVideoClickable) data-bs-toggle="modal"
                                    data-bs-target="#videoModal{{ $kegiatan->id }}"
                                    style="cursor: pointer;" @endif>
                                        <span
                                            class="position-absolute badge rounded-pill z-3 start-0 top-0 m-3 px-3 py-2 shadow-sm"
                                            style="background: rgba(255,255,255,0.95); color: {{ $currentColor }}; backdrop-filter: blur(10px);">
                                            <i class="bi {{ $kegiatan->ikon ?? 'bi-star-fill' }} me-1"></i>
                                            {{ strtoupper($kegiatan->kategori_label ?? 'KEGIATAN') }}
                                        </span>

                                        @if ($isVideoClickable)
                                            <div
                                                class="position-absolute top-50 start-50 translate-middle z-2 video-play-wrapper">
                                                <div
                                                    class="rounded-circle video-play-btn pulse-animation bg-white p-4 shadow-lg">
                                                    <i class="bi bi-play-fill text-danger display-4"></i>
                                                </div>
                                                <div class="video-play-text mt-3 text-center text-white">
                                                    <small class="fw-bold">TONTON VIDEO</small>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($thumbnailUrl && filter_var($thumbnailUrl, FILTER_VALIDATE_URL))
                                            <img src="{{ $thumbnailUrl }}"
                                                class="w-100 h-100 object-fit-cover {{ $isVideoClickable ? 'brightness-75' : '' }} media-image"
                                                alt="{{ $kegiatan->judul }}" loading="lazy"
                                                data-kegiatan-id="{{ $kegiatan->id }}"
                                                data-is-youtube="{{ $isYouTube ? '1' : '0' }}"
                                                onerror="handleMediaError(this, '{{ $kegiatan->id }}', {{ $isYouTube ? 'true' : 'false' }})"
                                                @if ($isVideoClickable) style="cursor: pointer;" @endif>
                                        @else
                                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center media-placeholder p-4 text-center"
                                                style="
                                                @if ($hasVideo && $isYouTube) background: linear-gradient(135deg, #FF0000 0%, #CC0000 100%); color: white;
                                                @elseif($hasVideo && !$isYouTube)
                                                    background: linear-gradient(135deg, {{ $currentColor }} 0%, {{ $darkerColor }} 100%); color: white;
                                                @else
                                                    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); color: #6c757d; @endif
                                                cursor: {{ $isVideoClickable ? 'pointer' : 'default' }};
                                            "
                                                data-kegiatan-id="{{ $kegiatan->id }}"
                                                data-is-youtube="{{ $isYouTube ? '1' : '0' }}">
                                                <div class="placeholder-content">
                                                    @if ($hasVideo)
                                                        @if ($isYouTube)
                                                            <i class="bi bi-youtube display-1 mb-3"></i>
                                                            <h5 class="fw-bold mb-1">Video YouTube Tersedia</h5>
                                                            <p class="small mb-0 opacity-75">Klik untuk menonton</p>
                                                        @else
                                                            <i class="bi bi-play-circle display-1 mb-3"></i>
                                                            <h5 class="fw-bold mb-1">Video Lokal Tersedia</h5>
                                                            <p class="small mb-0 opacity-75">Klik untuk menonton</p>
                                                        @endif
                                                    @else
                                                        <i class="bi bi-calendar-event display-1 text-muted mb-3"></i>
                                                        <h5 class="fw-bold mb-1">{{ $kegiatan->judul }}</h5>
                                                        <p class="small mb-0 opacity-75">
                                                            {{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                                                    @endif

                                                    <div class="position-absolute bottom-0 end-0 m-3">
                                                        <span
                                                            class="badge bg-dark rounded-pill bg-opacity-75 px-3 py-2 shadow-sm">
                                                            <i
                                                                class="bi bi-sort-numeric-up me-1"></i>#{{ $kegiatan->urutan }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Sisi Konten --}}
                                <div class="col-lg-6">
                                    <div class="h-100 d-flex flex-column p-md-5 p-4">
                                        <div class="mb-3">
                                            <h2 class="fw-bold mb-3"
                                                style="font-size: 1.8rem; line-height: 1.2; color: #1a1a1a !important;">
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
                                            </h2>
                                            <div class="d-flex align-items-center text-muted small mb-3">
                                                <i class="bi bi-calendar3 me-2"></i>
                                                <span>{{ $kegiatan->created_at->translatedFormat('d F Y') }}</span>
                                                <span class="mx-2">•</span>
                                                <i class="bi bi-clock me-2"></i>
                                                <span>{{ $kegiatan->created_at->format('H:i') }}</span>
                                            </div>
                                        </div>

                                        <div class="description-text flex-grow-1 mb-4" style="font-size: 1rem;">
                                            {!! Str::limit(strip_tags($kegiatan->deskripsi), 250) !!}
                                        </div>

                                        {{-- Tags --}}
                                        @if ($kegiatan->tags)
                                            @php
                                                if (is_string($kegiatan->tags)) {
                                                    $tagArray = explode(',', $kegiatan->tags);
                                                } elseif (is_array($kegiatan->tags)) {
                                                    $tagArray = $kegiatan->tags;
                                                } else {
                                                    $tagArray = [];
                                                }
                                                $tagArray = array_filter(array_map('trim', $tagArray));
                                            @endphp
                                            @if (!empty($tagArray))
                                                <div class="mb-4">
                                                    <div class="tags-container">
                                                        @foreach ($tagArray as $tag)
                                                            @if (!empty($tag))
                                                                <span
                                                                    class="tag-item badge rounded-pill mb-2 me-2 px-3 py-2"
                                                                    style="background: {{ $currentColor }}10; color: {{ $currentColor }}; border: 1px solid {{ $currentColor }}20;">
                                                                    <i class="bi bi-tag me-1"></i>{{ $tag }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        {{-- Tombol Action --}}
                                        <div class="action-buttons mt-auto">
                                            <div class="d-flex flex-wrap gap-2">
                                                @if ($hasVideo)
                                                    <button type="button"
                                                        class="btn watch-video-btn rounded-pill open-video-modal border px-4 py-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#videoModal{{ $kegiatan->id }}"
                                                        style="border-color: #dc3545 !important; color: #dc3545;">
                                                        @if ($isYouTube)
                                                            <i class="bi bi-youtube me-2"></i>Tonton di YouTube
                                                        @else
                                                            <i class="bi bi-play-circle me-2"></i>Tonton Video
                                                        @endif
                                                    </button>
                                                @endif
                                                <a href="{{ route('kegiatan.show', $routeSlug) }}"
                                                    class="btn btn-primary rounded-pill hover-lift px-4 py-2 shadow-sm">
                                                    <i class="bi bi-arrow-right-circle me-2"></i>Detail Lengkap
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Video --}}
                    @if ($hasVideo)
                        <div class="modal fade video-modal" id="videoModal{{ $kegiatan->id }}" tabindex="-1"
                            aria-labelledby="videoModalLabel{{ $kegiatan->id }}" aria-hidden="true"
                            data-modal-id="{{ $kegiatan->id }}" data-video-type="{{ $isYouTube ? 'youtube' : 'local' }}"
                            data-youtube-id="{{ $isYouTube ? $videoId : '' }}">
                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
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
                                                <h5 class="modal-title mb-0" id="videoModalLabel{{ $kegiatan->id }}">
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
                                            {{-- ✅ FIX: HAPUS SPASI DI src YouTube! --}}
                                            <div class="ratio ratio-16x9 youtube-embed-container">
                                                <iframe
                                                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&playsinline=1"
                                                    title="{{ $kegiatan->judul }}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen loading="lazy"></iframe>
                                            </div>
                                        @elseif($hasVideo && !$isYouTube && $kegiatan->video_url)
                                            <div class="ratio ratio-16x9">
                                                <video controls class="w-100 h-100" poster="{{ $thumbnailUrl ?? '' }}"
                                                    controlsList="nodownload">
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
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="fw-bold mb-0">{{ Str::limit($kegiatan->judul, 50) }}</h6>
                                            </div>
                                            <p class="text-muted small mb-0">
                                                {{ Str::limit(strip_tags($kegiatan->deskripsi), 120) }}</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-outline-primary rounded-pill close-modal-btn px-4"
                                            data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <div class="col-12 py-5 text-center" data-aos="fade-up">
                        <i class="bi bi-calendar-x display-1 text-muted mb-3"></i>
                        <h4 class="text-muted mb-3">Belum ada agenda kegiatan saat ini.</h4>
                        <p class="text-muted mb-4">Kami sedang mempersiapkan kegiatan terbaik untuk Anda.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($kegiatans->hasPages())
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    <nav aria-label="Page navigation">
                        <ul class="pagination shadow-sm">
                            {{ $kegiatans->withQueryString()->links() }}
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>

    {{-- ✅ CSS FINAL --}}
    <style>
        .kegiatan-section .container,
        .kegiatan-section .row.g-5 {
            overflow: visible !important;
            z-index: auto !important;
        }

        /* =========================
       MOBILE SWIPE FILTER
    ========================= */
        .kategori-scroll-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            position: relative;
        }

        .kategori-scroll-wrapper::-webkit-scrollbar {
            display: none;
        }

        .kategori-scroll {
            white-space: nowrap;
            padding-bottom: 6px;
        }

        .kategori-chip {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 500;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .kategori-chip:hover {
            background: #e2e8f0;
        }

        .kategori-chip.active {
            background: rgba(13, 110, 253, 0.12);
            color: #0d6efd;
            border-color: rgba(13, 110, 253, 0.3);
        }

        /* Gaya lainnya (tidak berubah) */
        .bg-title-blue {
            background-color: #2547bc;
            border-radius: 50px;
            padding: 12px 60px;
            display: inline-block;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(37, 71, 188, 0.2);
        }

        .modal-backdrop {
            display: none !important;
        }
    </style>

    {{-- ✅ JAVASCRIPT FINAL — HENTIKAN VIDEO SAAT DITUTUP --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle semua modal video
                document.querySelectorAll('.video-modal').forEach(function(modal) {
                    const iframe = modal.querySelector('iframe');
                    const video = modal.querySelector('video');

                    // Saat modal DITUTUP → hentikan video
                    modal.addEventListener('hide.bs.modal', function() {
                        if (iframe) {
                            let src = iframe.src;
                            src = src
                                .replace(/[\?&]autoplay=1/g, '')
                                .replace(/[\?&]mute=1/g, '')
                                .replace(/\?&/g, '?')
                                .replace(/\?$/g, '');
                            iframe.src = src; // ini hentikan YouTube
                        }
                        if (video) {
                            video.pause();
                            video.currentTime = 0;
                        }
                    });

                    // Opsional: autoplay saat dibuka (dengan mute)
                    modal.addEventListener('show.bs.modal', function() {
                        if (iframe && !iframe.src.includes('autoplay=1')) {
                            const sep = iframe.src.includes('?') ? '&' : '?';
                            iframe.src += sep + 'autoplay=1&mute=1';
                        }
                    });
                });

                // Inisialisasi AOS jika ada
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 800,
                        once: true,
                        offset: 50
                    });
                }
            });
        </script>
    @endpush
@endsection
