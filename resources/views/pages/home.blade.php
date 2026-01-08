@extends('layouts.app')

@section('title', 'Beranda - Yayasan Pendidikan Al-Ihsan')

@section('content')
    {{-- ================= HERO / BANNER ================= --}}
    <section class="hero-section">
        <div class="container-fluid p-0">
            <img src="{{ asset('img/banner-utama.jpg') }}" alt="Welcome Banner" class="img-fluid w-100">
        </div>
    </section>

    {{-- ================= WRAPPER SMOOTH BACKGROUND (MOTTO SAMPAI PIMPINAN) ================= --}}
    <section class="position-relative overflow-hidden"
        style="background: linear-gradient(180deg, #f8fbff 0%, #a6daff 100% );">
        {{-- Elemen Dekorasi Cahaya (Glow) --}}
        <div class="position-absolute start-50 translate-middle-x rounded-circle top-0"
            style="width: 600px; height: 600px; background: radial-gradient(circle, rgba(0,123,255,0.15) 0%, rgba(255,255,255,0) 70%); filter: blur(80px); z-index: 0;">
        </div>
        <div class="position-absolute translate-middle-y rounded-circle bottom-0 start-0"
            style="width: 400px; height: 400px; background: radial-gradient(circle, rgba(0,123,255,0.1) 0%, rgba(255,255,255,0) 70%); filter: blur(60px); z-index: 0;">
        </div>

        <div class="position-relative container py-5" style="z-index: 1;">
            {{-- ================= MOTTO • VISI • MISI ================= --}}
            <div class="container py-5">
                <div class="mb-5 text-center">
                    <h2 class="fw-bold mb-4" style="color: #002366; letter-spacing: 2px;">MOTTO</h2>
                    <div class="d-inline-block rounded-pill mb-5 px-5 py-3 shadow-sm"
                        style="background: linear-gradient(180deg, #f8fbff 0%, #97d2ff 100% ); ">
                        <h3 class="fw-italic text-dark mb-0" style="font-size: 1.8rem;">"Berakhlak, Berilmu, Berdaya"</h3>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">
                    {{-- Visi - Bubble Oval --}}
                    <div class="col-md-5">
                        <div class="h-100 p-5 text-center shadow-sm"
                            style="border-radius: 50px; background: linear-gradient(180deg, #f8fbff 0%, #a6daff 100% ); ">
                            <div class="mb-3">
                                <i class="bi bi-eye-fill fs-1 text-primary"></i>
                            </div>
                            <h2 class="fw-bold mb-3" style="color: #002366;">VISI</h2>
                            <p class="fs-5 text-dark lh-base">
                                "Menjadi Sekolah Islam yang memiliki karakter Profetik."
                            </p>
                        </div>
                    </div>

                    {{-- Misi - Bubble Semi-Oval --}}
                    <div class="col-md-7">
                        <div class="h-100 p-5 shadow-sm"
                            style="border-radius: 40px; background: linear-gradient(180deg, #f8fbff 0%, #a6daff 100% );">
                            <h2 class="fw-bold mb-4 text-center" style="color: #002366;">MISI</h2>

                            @php
                                $misiList = [
                                    'Melaksanakan proses kepengasuhan berdasarkan nilai-nilai Islam.',
                                    'Menyelenggarakan pembelajaran terpadu, menyenangkan, dan mengoptimalkan kecerdasan anak (Asah, Asih, Asuh).',
                                    'Menumbuhkan kesiapan anak untuk jenjang pendidikan berikutnya dengan bekal nilai Islam.',
                                    'Pengelolaan sekolah yang amanah, berkualitas, efektif, efisien, dan berorientasi pelayanan.',
                                ];
                            @endphp

                            <div class="row g-3">
                                @foreach ($misiList as $index => $misi)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center rounded-4 border-0 p-3 shadow-sm"
                                            style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(5px);">

                                            <div class="d-flex align-items-center justify-content-center rounded-circle me-3 flex-shrink-0 shadow-sm"
                                                style="width: 40px; height: 40px; background: #002366; color: white; font-weight: bold; border: 2px solid #ffffff;">
                                                {{ $index + 1 }}
                                            </div>

                                            <div class="text-dark small fw-medium lh-sm">{{ $misi }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ================= PIMPINAN YAYASAN ================= --}}
            <section class="py-5">
                <div class="row align-items-center g-5 pt-5">
                    {{-- Bagian Kiri: Foto --}}
                    <div class="col-lg-5 text-center">
                        <div class="position-relative d-inline-block">
                            @php
                                $dataPimpinan = \App\Models\Staff::where('kategori', 'pimpinan')->first();
                                $fotoFinal =
                                    $dataPimpinan && $dataPimpinan->foto
                                        ? asset('storage/' . $dataPimpinan->foto)
                                        : 'https://placehold.co/400x500/1a44cc/ffffff?text=Foto+Pimpinan';
                                $namaPimpinan = $dataPimpinan ? $dataPimpinan->nama : 'Bapak Dr. Edi Saputro';
                                $jabatanPimpinan = $dataPimpinan
                                    ? ($dataPimpinan->jabatan ?:
                                    'Ketua Yayasan')
                                    : 'Ketua Yayasan';
                            @endphp

                            {{-- Glow effect --}}
                            <div class="position-absolute top-50 start-50 translate-middle rounded-circle"
                                style="width: 120%; height: 120%; background: radial-gradient(circle, rgba(0,123,255,0.2) 0%, rgba(255,255,255,0) 70%); filter: blur(40px); z-index: -1;">
                            </div>

                            <img src="{{ $fotoFinal }}" class="img-fluid rounded-4 mb-4 shadow-lg"
                                style="width: 350px; height: 450px; object-fit: cover;" alt="{{ $namaPimpinan }}">

                            <h2 class="fw-bold mb-1 mt-3" style="color: #002366; font-size: 2.2rem;">{{ $namaPimpinan }}
                            </h2>
                            <p class="text-muted mb-0" style="font-size: 1.1rem;">
                                <i class="bi bi-award me-1"></i>
                                {{ $jabatanPimpinan }}
                            </p>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Teks Sambutan --}}
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <span
                                class="badge bg-primary text-primary border-primary mb-3 border border-opacity-25 bg-opacity-10 px-3 py-2">
                                <i class="bi bi-star-fill me-1"></i>
                                Kepemimpinan
                            </span>
                            <h1 class="fw-bold mb-3" style="color: #002366; font-size: 3rem; line-height: 1.1;">
                                Pimpinan Yayasan <br>
                                <span class="text-gradient-primary">Baitul Insan</span>
                            </h1>
                        </div>

                        <div class="text-muted lh-lg fs-5 mb-5" style="text-align: justify;">
                            <p class="mb-4">
                                Pimpinan <strong class="text-dark">Yayasan Baitul Insan</strong> adalah sosok yang
                                berkomitmen dalam
                                memajukan pendidikan Islam terpadu di Kabupaten Pesawaran.
                                Beliau dikenal sebagai figur yang visioner, ramah, dan berdedikasi tinggi
                                dalam mengembangkan lembaga pendidikan berbasis karakter profetik.
                            </p>

                            <p class="mb-4">
                                Di bawah kepemimpinannya, Yayasan Baitul Insan terus berupaya
                                menghadirkan layanan pendidikan berkualitas, berlandaskan nilai-nilai Islam,
                                serta menciptakan lingkungan belajar yang amanah, profesional, dan
                                berorientasi pada pembinaan akhlak serta kecerdasan peserta didik.
                            </p>

                            <div class="bg-light rounded-4 mb-4 p-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center bg-opacity-10"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-people-fill text-primary" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Tim Pendidik Berkualitas</h5>
                                        <p class="text-muted mb-0">
                                            Didukung oleh para pendidik profesional yang berkompeten di bidangnya
                                            masing-masing.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <p class="mb-0">
                                Untuk mengenal lebih dekat dengan pimpinan dan seluruh keluarga besar Yayasan Baitul Insan:
                            </p>
                        </div>

                        <div class="border-top border-light mt-5 pt-4">
                            <a href="{{ route('tentang') }}"
                                class="btn btn-primary btn-lg d-flex align-items-center justify-content-center position-relative overflow-hidden"
                                style="
                                    background: linear-gradient(135deg, #1a44cc 0%, #002366 100%);
                                    border: none;
                                    border-radius: 50px;
                                    padding: 1rem 2rem;
                                    font-weight: 600;
                                    min-width: 220px;
                                    transition: all 0.3s ease;
                                    box-shadow: 0 10px 25px rgba(26, 68, 204, 0.25);
                                ">

                                {{-- Teks --}}
                                <span class="position-relative z-2">
                                    Lihat Selengkapnya
                                </span>

                                {{-- Icon panah --}}
                                <span class="position-relative z-2 d-flex align-items-center justify-content-center ms-3"
                                    style="
                                        background: rgba(255, 255, 255, 0.15);
                                        width: 36px;
                                        height: 36px;
                                        border-radius: 50%;
                                        transition: all 0.3s ease;
                                    ">
                                    <i class="bi bi-arrow-right" style="font-size: 1.2rem;"></i>
                                </span>

                                {{-- Efek hover shine --}}
                                <span class="position-absolute start-0 top-0 h-full w-full"
                                    style="
                                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                                        transform: translateX(-100%);
                                        transition: transform 0.6s ease;
                                    ">
                                </span>
                            </a>

                            <p class="text-muted small mb-0 mt-3" style="font-size: 0.9rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Kenali lebih dekat struktur organisasi dan tim pengajar kami
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    {{-- ================= JENJANG SEKOLAH ================= --}}
    <section class="py-5" style="background-color:#1635BD;">
        <div class="container py-5">
            <div class="mb-5 text-center">
                <h1 class="fw-bold mb-2 text-white" style="font-size: 2.5rem;">2 Jenjang Sekolah di Baitul Insan</h1>
                <p class="text-white-50">Membentuk Generasi Profetik di Baitul Insan</p>
            </div>

            <div class="row g-4 justify-content-center">
                {{-- TK --}}
                <div class="col-md-5">
                    <a href="{{ route('jenjang.tk') }}" class="text-decoration-none">
                        <div class="card h-100 rounded-5 custom-card overflow-hidden border-0 shadow-lg">
                            <div class="position-relative overflow-hidden" style="height:400px;">
                                <img src="{{ asset('img/tk.png') }}" class="w-100 h-100 card-img-top"
                                    style="object-fit:cover; transition: transform 0.5s ease;" alt="TK Baitul Insan">
                                <div class="position-absolute start-0 top-0 m-3">
                                    <span class="badge rounded-pill bg-warning text-dark fw-bold px-3 py-2">JENJANG
                                        TK</span>
                                </div>
                                <div class="position-absolute w-100 bottom-0 p-4 text-white"
                                    style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                    <h3 class="fw-bold mb-2">TK Baitul Insan</h3>
                                    <p class="small mb-0 opacity-75">Klik untuk info lengkap</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- SD --}}
                <div class="col-md-5">
                    <a href="{{ route('jenjang.sd') }}" class="text-decoration-none">
                        <div class="card h-100 rounded-5 custom-card overflow-hidden border-0 shadow-lg">
                            <div class="position-relative overflow-hidden" style="height:400px;">
                                <img src="{{ asset('img/sd.png') }}" class="w-100 h-100 card-img-top"
                                    style="object-fit:cover; transition: transform 0.5s ease;" alt="SD IT Baitul Insan">
                                <div class="position-absolute start-0 top-0 m-3">
                                    <span class="badge rounded-pill bg-info fw-bold px-3 py-2 text-white">JENJANG SD</span>
                                </div>
                                <div class="position-absolute w-100 bottom-0 p-4 text-white"
                                    style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                    <h3 class="fw-bold mb-2">SD IT Baitul Insan</h3>
                                    <p class="small mb-0 opacity-75">Klik untuk info lengkap</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= KEGIATAN ================= --}}
    <section class="bg-white py-5">
        <div class="container py-5">
            @php
                // Ambil 2 kegiatan terbaru yang aktif
                $kegiatans = \App\Models\Kegiatan::where('status', true)
                    ->orderBy('urutan', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->take(2)
                    ->get();

                $kegiatan_pertama = $kegiatans->first();
                $kegiatan_kedua = $kegiatans->skip(1)->first();

                $hexColors = [
                    'primary' => '#667eea',
                    'success' => '#4CAF50',
                    'warning' => '#FFB300',
                    'info' => '#00BCD4',
                    'purple' => '#9C27B0',
                    'danger' => '#F44336',
                ];
            @endphp

            {{-- Cek jika ada kegiatan --}}
            @if ($kegiatan_pertama)
                @php
                    $currentColor = $hexColors[$kegiatan_pertama->warna] ?? '#667eea';
                    // Check if video is available and clickable
                    $hasVideo = $kegiatan_pertama->has_video;
                    $isYouTube = $kegiatan_pertama->is_youtube;
                    $isVideoClickable = $kegiatan_pertama->is_video_clickable;
                    $videoId = $isYouTube ? $kegiatan_pertama->getYouTubeId() : null;
                @endphp
                {{-- Kegiatan 1 --}}
                <div class="row align-items-center g-5 mb-5">
                    <div class="col-md-6">
                        <div class="position-relative rounded-5 kegiatan-card video-thumbnail overflow-hidden shadow-lg"
                            style="height: 450px;"
                            @if ($isVideoClickable) data-bs-toggle="modal" data-bs-target="#videoModal{{ $kegiatan_pertama->id }}" @endif>

                            {{-- Gunakan thumbnail_url dari model --}}
                            @if ($kegiatan_pertama->thumbnail_url && filter_var($kegiatan_pertama->thumbnail_url, FILTER_VALIDATE_URL))
                                <img src="{{ $kegiatan_pertama->thumbnail_url }}" class="w-100 h-100 kegiatan-image"
                                    style="object-fit: cover;" alt="{{ $kegiatan_pertama->judul }}"
                                    onerror="this.src='https://via.placeholder.com/800x450/6c757d/ffffff?text=Kegiatan'">
                            @elseif($kegiatan_pertama->gambar)
                                <img src="{{ asset('storage/' . $kegiatan_pertama->gambar) }}"
                                    class="w-100 h-100 kegiatan-image" style="object-fit: cover;"
                                    alt="{{ $kegiatan_pertama->judul }}"
                                    onerror="this.src='https://via.placeholder.com/800x450/6c757d/ffffff?text=Kegiatan'">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-event display-1 text-muted"></i>
                                </div>
                            @endif
                            <div class="position-absolute w-100 h-100 d-flex flex-column overlay-gradient start-0 top-0">
                                {{-- Badge Kategori --}}
                                <div class="position-absolute start-0 top-0 m-4">
                                    <span class="badge rounded-pill fw-normal category-badge px-3 py-2"
                                        style="background: {{ $currentColor }}; color: white; font-size: 0.8rem;">
                                        <i class="bi {{ $kegiatan_pertama->ikon ?? 'bi-star-fill' }} me-1"></i>
                                        {{ strtoupper($kegiatan_pertama->kategori_label ?? 'KEGIATAN') }}
                                    </span>
                                </div>

                                {{-- Icon Play untuk video yang bisa diklik --}}
                                @if ($isVideoClickable)
                                    <div class="m-auto">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center play-button bg-white bg-opacity-25 shadow-sm"
                                            style="width: 80px; height: 80px; backdrop-filter: blur(8px); border: 2px solid rgba(255,255,255,0.5);">
                                            <i class="fs-3 play-icon text-white" style="margin-left: 5px;">▶</i>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-auto p-4">
                                    <h3 class="fw-bold title-overlay mb-1 text-white">{{ $kegiatan_pertama->judul }}</h3>
                                    <p class="text-white-50 small description-overlay mb-0">
                                        {{ Str::limit(strip_tags($kegiatan_pertama->deskripsi), 100) }}
                                    </p>

                                    {{-- Tags --}}
                                    @if ($kegiatan_pertama->tags)
                                        <div class="tag-container mt-2">
                                            @php
                                                // Handle tags in multiple formats
                                                if (is_string($kegiatan_pertama->tags)) {
                                                    $tagArray = explode(',', $kegiatan_pertama->tags);
                                                } elseif (is_array($kegiatan_pertama->tags)) {
                                                    $tagArray = $kegiatan_pertama->tags;
                                                } else {
                                                    $tagArray = [];
                                                }

                                                // Filter and clean tags
                                                $tagArray = array_filter(array_map('trim', $tagArray));
                                            @endphp
                                            @foreach (array_slice($tagArray, 0, 3) as $tag)
                                                @if (!empty($tag))
                                                    <span
                                                        class="badge bg-light tag-badge mb-1 me-1 border-0 bg-opacity-25 text-white"
                                                        style="border-color: rgba(255,255,255,0.3)!important;">
                                                        <i class="bi bi-tag-fill me-1" style="opacity: 0.8;"></i>
                                                        {{ $tag }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ps-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center icon-container p-2"
                                    style="background-color: {{ $currentColor }}20; color: {{ $currentColor }}; width: 50px; height: 50px;">
                                    <i class="bi {{ $kegiatan_pertama->ikon ?? 'bi-calendar-event' }} fs-4"></i>
                                </div>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark order-badge border px-3 py-1"
                                    style="border-color: {{ $currentColor }};">
                                    <i class="bi bi-sort-numeric-down me-1"></i>
                                    Urutan: {{ $kegiatan_pertama->urutan }}
                                </span>
                            </div>
                        </div>

                        <h1 class="fw-bold mb-4" style="color: #002366; font-size: 3.5rem; line-height: 1.1;">
                            {{ $kegiatan_pertama->judul }}
                        </h1>
                        <div class="text-muted fs-5 lh-lg description-main mb-4">
                            {!! Str::limit($kegiatan_pertama->deskripsi, 300) !!}
                        </div>

                        <div class="text-muted small date-info mb-4">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $kegiatan_pertama->created_at->translatedFormat('d F Y') }}
                        </div>

                        {{-- Tombol untuk membuka video --}}
                        @if ($hasVideo)
                            <div class="d-flex mb-4 gap-2">
                                <button class="btn btn-outline-danger watch-video-btn d-inline-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#videoModal{{ $kegiatan_pertama->id }}">
                                    @if ($isYouTube)
                                        <i class="bi bi-youtube me-2"></i>
                                        <span>Tonton di YouTube</span>
                                    @else
                                        <i class="bi bi-play-circle me-2"></i>
                                        <span>Tonton Video</span>
                                    @endif
                                </button>

                                {{-- Optional: Tombol detail kegiatan --}}
                                <a href="{{ route('kegiatan.show', $kegiatan_pertama->slug ?? $kegiatan_pertama->id) }}"
                                    class="btn btn-outline-primary d-inline-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span>Detail Kegiatan</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Modal Video untuk kegiatan pertama --}}
                @if ($hasVideo)
                    <div class="modal fade video-modal" id="videoModal{{ $kegiatan_pertama->id }}" tabindex="-1"
                        aria-labelledby="videoModalLabel{{ $kegiatan_pertama->id }}" aria-hidden="true"
                        data-video-type="{{ $isYouTube ? 'youtube' : 'local' }}"
                        data-video-id="{{ $isYouTube ? $videoId : '' }}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="videoModalLabel{{ $kegiatan_pertama->id }}">
                                        @if ($isYouTube)
                                            <i class="bi bi-youtube me-2"></i>
                                        @else
                                            <i class="bi bi-play-circle me-2"></i>
                                        @endif
                                        {{ $kegiatan_pertama->judul }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    @if ($isYouTube && $videoId)
                                        {{-- Embed YouTube --}}
                                        <div class="ratio ratio-16x9">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1"
                                                title="{{ $kegiatan_pertama->judul }}"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen style="border: none;"
                                                id="youtubeIframe{{ $kegiatan_pertama->id }}"
                                                data-src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1">
                                            </iframe>
                                        </div>
                                    @elseif($hasVideo && !$isYouTube && $kegiatan_pertama->video_url)
                                        {{-- Video lokal --}}
                                        <div class="ratio ratio-16x9">
                                            <video controls class="w-100 h-100 local-video"
                                                id="localVideo{{ $kegiatan_pertama->id }}"
                                                poster="{{ $kegiatan_pertama->thumbnail_url ?? '' }}" preload="metadata">
                                                <source src="{{ $kegiatan_pertama->video_url }}" type="video/mp4">
                                                Browser Anda tidak mendukung pemutaran video.
                                            </video>
                                        </div>
                                    @else
                                        <div class="p-5 text-center">
                                            <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                            <p class="mt-3">Video tidak dapat dimuat. Silakan coba lagi.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <div class="w-100">
                                        <h6 class="mb-2">{{ $kegiatan_pertama->judul }}</h6>
                                        <p class="text-muted small mb-0">
                                            {{ Str::limit($kegiatan_pertama->deskripsi, 150) }}
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-secondary d-flex align-items-center"
                                        data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i>
                                        <span>Tutup</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Kegiatan 2 --}}
            @if ($kegiatan_kedua)
                @php
                    $currentColor2 = $hexColors[$kegiatan_kedua->warna] ?? '#667eea';
                    // Check if video is available and clickable
                    $hasVideo2 = $kegiatan_kedua->has_video;
                    $isYouTube2 = $kegiatan_kedua->is_youtube;
                    $isVideoClickable2 = $kegiatan_kedua->is_video_clickable;
                    $videoId2 = $isYouTube2 ? $kegiatan_kedua->getYouTubeId() : null;
                @endphp
                <div class="row align-items-center g-5 pt-5">
                    <div class="col-md-6 order-md-1 order-2">
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center icon-container p-2"
                                    style="background-color: {{ $currentColor2 }}20; color: {{ $currentColor2 }}; width: 50px; height: 50px;">
                                    <i class="bi {{ $kegiatan_kedua->ikon ?? 'bi-calendar-event' }} fs-4"></i>
                                </div>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark order-badge border px-3 py-1"
                                    style="border-color: {{ $currentColor2 }};">
                                    <i class="bi bi-sort-numeric-down me-1"></i>
                                    Urutan: {{ $kegiatan_kedua->urutan }}
                                </span>
                            </div>
                        </div>

                        <h1 class="fw-bold display-4 mb-4" style="color: #002366; line-height: 1.1;">
                            {{ $kegiatan_kedua->judul }}
                        </h1>

                        <div class="text-muted fs-5 lh-lg description-main mb-5">
                            {!! Str::limit($kegiatan_kedua->deskripsi, 300) !!}
                        </div>

                        <div class="text-muted small date-info mb-4">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $kegiatan_kedua->created_at->translatedFormat('d F Y') }}
                        </div>

                        {{-- Tombol untuk membuka video --}}
                        @if ($hasVideo2)
                            <div class="d-flex mb-4 gap-2">
                                <button class="btn btn-outline-danger watch-video-btn d-inline-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#videoModal{{ $kegiatan_kedua->id }}">
                                    @if ($isYouTube2)
                                        <i class="bi bi-youtube me-2"></i>
                                        <span>Tonton di YouTube</span>
                                    @else
                                        <i class="bi bi-play-circle me-2"></i>
                                        <span>Tonton Video</span>
                                    @endif
                                </button>

                                {{-- Optional: Tombol detail kegiatan --}}
                                <a href="{{ route('kegiatan.show', $kegiatan_kedua->slug ?? $kegiatan_kedua->id) }}"
                                    class="btn btn-outline-primary d-inline-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span>Detail Kegiatan</span>
                                </a>
                            </div>
                        @endif

                        <div class="mt-5 pt-4">
                            <a href="{{ route('kegiatan.index') }}"
                                class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center position-relative shadow-lg"
                                style="
                                    padding: 1rem 2.5rem;
                                    background: linear-gradient(135deg, #1a44cc 0%, #002366 100%);
                                    border-radius: 12px;
                                    font-weight: 600;
                                    border: none;
                                ">
                                <span class="me-2">📋</span>
                                <span>Lihat Semua Kegiatan</span>
                                <span class="d-flex align-items-center justify-content-center ms-3"
                                    style="
                                        background: rgba(255, 255, 255, 0.2);
                                        width: 30px;
                                        height: 30px;
                                        border-radius: 50%;
                                    ">
                                    <i class="bi bi-arrow-right-short"></i>
                                </span>
                            </a>

                            <p class="text-muted small mt-3" style="font-size: 0.9rem;">
                                Temukan lebih banyak kegiatan menarik lainnya
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 order-md-2 order-1">
                        <div class="position-relative rounded-5 kegiatan-card video-thumbnail overflow-hidden shadow-lg"
                            style="height: 450px;"
                            @if ($isVideoClickable2) data-bs-toggle="modal" data-bs-target="#videoModal{{ $kegiatan_kedua->id }}" @endif>

                            {{-- Gunakan thumbnail_url dari model --}}
                            @if ($kegiatan_kedua->thumbnail_url && filter_var($kegiatan_kedua->thumbnail_url, FILTER_VALIDATE_URL))
                                <img src="{{ $kegiatan_kedua->thumbnail_url }}" class="w-100 h-100 kegiatan-image"
                                    style="object-fit: cover;" alt="{{ $kegiatan_kedua->judul }}"
                                    onerror="this.src='https://via.placeholder.com/800x450/6c757d/ffffff?text=Kegiatan'">
                            @elseif($kegiatan_kedua->gambar)
                                <img src="{{ asset('storage/' . $kegiatan_kedua->gambar) }}"
                                    class="w-100 h-100 kegiatan-image" style="object-fit: cover;"
                                    alt="{{ $kegiatan_kedua->judul }}"
                                    onerror="this.src='https://via.placeholder.com/800x450/6c757d/ffffff?text=Kegiatan'">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-event display-1 text-muted"></i>
                                </div>
                            @endif

                            <div class="position-absolute w-100 h-100 d-flex flex-column overlay-gradient start-0 top-0">
                                {{-- Badge Kategori --}}
                                <div class="position-absolute start-0 top-0 m-4">
                                    <span class="badge rounded-pill fw-normal category-badge px-3 py-2"
                                        style="background: {{ $currentColor2 }}; color: white; font-size: 0.8rem;">
                                        <i class="bi {{ $kegiatan_kedua->ikon ?? 'bi-star-fill' }} me-1"></i>
                                        {{ strtoupper($kegiatan_kedua->kategori_label ?? 'KEGIATAN') }}
                                    </span>
                                </div>

                                {{-- Icon Play untuk video yang bisa diklik --}}
                                @if ($isVideoClickable2)
                                    <div class="m-auto">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center play-button bg-white bg-opacity-25 shadow-sm"
                                            style="width: 80px; height: 80px; backdrop-filter: blur(8px); border: 2px solid rgba(255,255,255,0.5);">
                                            <i class="fs-3 play-icon text-white" style="margin-left: 5px;">▶</i>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-auto p-4 text-start">
                                    <h3 class="fw-bold title-overlay mb-1 text-white">{{ $kegiatan_kedua->judul }}</h3>
                                    <p class="text-white-50 small description-overlay mb-0">
                                        {{ Str::limit(strip_tags($kegiatan_kedua->deskripsi), 100) }}
                                    </p>

                                    {{-- Tags --}}
                                    @if ($kegiatan_kedua->tags)
                                        <div class="tag-container mt-2">
                                            @php
                                                // Handle tags in multiple formats
                                                if (is_string($kegiatan_kedua->tags)) {
                                                    $tagArray = explode(',', $kegiatan_kedua->tags);
                                                } elseif (is_array($kegiatan_kedua->tags)) {
                                                    $tagArray = $kegiatan_kedua->tags;
                                                } else {
                                                    $tagArray = [];
                                                }

                                                // Filter and clean tags
                                                $tagArray = array_filter(array_map('trim', $tagArray));
                                            @endphp
                                            @foreach (array_slice($tagArray, 0, 3) as $tag)
                                                @if (!empty($tag))
                                                    <span
                                                        class="badge bg-light tag-badge mb-1 me-1 border-0 bg-opacity-25 text-white"
                                                        style="border-color: rgba(255,255,255,0.3)!important;">
                                                        <i class="bi bi-tag-fill me-1" style="opacity: 0.8;"></i>
                                                        {{ $tag }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Video untuk kegiatan kedua --}}
                @if ($hasVideo2)
                    <div class="modal fade video-modal" id="videoModal{{ $kegiatan_kedua->id }}" tabindex="-1"
                        aria-labelledby="videoModalLabel{{ $kegiatan_kedua->id }}" aria-hidden="true"
                        data-video-type="{{ $isYouTube2 ? 'youtube' : 'local' }}"
                        data-video-id="{{ $isYouTube2 ? $videoId2 : '' }}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="videoModalLabel{{ $kegiatan_kedua->id }}">
                                        @if ($isYouTube2)
                                            <i class="bi bi-youtube me-2"></i>
                                        @else
                                            <i class="bi bi-play-circle me-2"></i>
                                        @endif
                                        {{ $kegiatan_kedua->judul }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    @if ($isYouTube2 && $videoId2)
                                        {{-- Embed YouTube --}}
                                        <div class="ratio ratio-16x9">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $videoId2 }}?rel=0&modestbranding=1"
                                                title="{{ $kegiatan_kedua->judul }}"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen style="border: none;"
                                                id="youtubeIframe{{ $kegiatan_kedua->id }}"
                                                data-src="https://www.youtube.com/embed/{{ $videoId2 }}?rel=0&modestbranding=1">
                                            </iframe>
                                        </div>
                                    @elseif($hasVideo2 && !$isYouTube2 && $kegiatan_kedua->video_url)
                                        {{-- Video lokal --}}
                                        <div class="ratio ratio-16x9">
                                            <video controls class="w-100 h-100 local-video"
                                                id="localVideo{{ $kegiatan_kedua->id }}"
                                                poster="{{ $kegiatan_kedua->thumbnail_url ?? '' }}" preload="metadata">
                                                <source src="{{ $kegiatan_kedua->video_url }}" type="video/mp4">
                                                Browser Anda tidak mendukung pemutaran video.
                                            </video>
                                        </div>
                                    @else
                                        <div class="p-5 text-center">
                                            <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
                                            <p class="mt-3">Video tidak dapat dimuat. Silakan coba lagi.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <div class="w-100">
                                        <h6 class="mb-2">{{ $kegiatan_kedua->judul }}</h6>
                                        <p class="text-muted small mb-0">
                                            {{ Str::limit($kegiatan_kedua->deskripsi, 150) }}
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-secondary d-flex align-items-center"
                                        data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i>
                                        <span>Tutup</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Jika tidak ada kegiatan --}}
            @if (!$kegiatan_pertama && !$kegiatan_kedua)
                <div class="py-5 text-center">
                    <i class="bi bi-calendar-x display-1 text-muted mb-4"></i>
                    <h3 class="fw-bold mb-3" style="color: #002366;">Belum Ada Kegiatan Saat Ini</h3>
                    <p class="text-muted mb-4">Tidak ada kegiatan yang sedang berlangsung. Silakan kembali lagi nanti.</p>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-primary rounded-pill fw-bold px-5 py-3"
                        style="background-color: #1a44cc; border:none;">
                        Lihat Halaman Kegiatan
                    </a>
                </div>
            @endif
        </div>
    </section>


    {{-- ================= ARTIKEL TERBARU ================= --}}
    {{-- ================= ARTIKEL TERBARU ================= --}}
    <section class="py-5" style="background-color: #f8fbff; border-radius: 0 0 50px 50px;">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <small class="text-primary fw-bold text-uppercase d-block mb-2 tracking-widest"
                        style="letter-spacing: 2px;">
                        Informasi Terkini
                    </small>
                    <h1 class="fw-bold m-0" style="color: #002366; font-size: 3rem; letter-spacing: -1px;">Artikel Terbaru
                    </h1>
                </div>
                <a href="{{ route('artikel.index') }}"
                    class="btn btn-outline-primary rounded-pill fw-bold bg-white px-4 shadow-sm">
                    Lihat Semua <i class="ms-1">→</i>
                </a>
            </div>

            <div class="row g-4">
                @php
                    // Ambil artikel terbaru yang sudah dipublikasikan
                    use App\Models\Artikel;
                    $latest_articles = Artikel::where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
                @endphp

                @forelse ($latest_articles as $item)
                    <div class="col-md-4">
                        <div class="card h-100 item-oval overflow-hidden border-0 shadow-sm"
                            style="border-radius: 60px 20px 60px 20px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); background: #ffffff;">

                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-100 h-100 img-zoom"
                                    style="object-fit:cover;" alt="{{ $item->judul }}">

                                <div class="position-absolute start-0 top-0 m-4">
                                    <span class="badge text-primary rounded-pill fw-bold bg-white px-3 py-2 shadow-sm">
                                        @php
                                            // Gunakan published_at jika ada, jika tidak gunakan created_at
                                            $articleDate = $item->published_at ?? $item->created_at;
                                        @endphp
                                        {{ $articleDate->format('d M Y') }}
                                    </span>
                                </div>

                                {{-- Badge Jenis --}}
                                <div class="position-absolute end-0 top-0 m-4">
                                    <span
                                        class="badge {{ $item->jenis == 'jurnal' ? 'bg-info text-white' : 'bg-primary text-white' }} rounded-pill fw-bold px-3 py-2 shadow-sm">
                                        {{ $item->jenis_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column p-4 pt-3">
                                <h5 class="fw-bold text-dark mb-3" style="line-height: 1.5; color: #002366 !important;">
                                    {{ Str::limit($item->judul, 50) }}
                                </h5>

                                {{-- Info Penulis untuk Jurnal --}}
                                @if ($item->jenis == 'jurnal' && $item->penulis)
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-person me-1"></i> {{ $item->penulis }}
                                    </p>
                                @endif

                                <p class="text-muted small mb-4 opacity-75">
                                    {{-- Gunakan ringkasan jika ada, jika tidak gunakan excerpt dari isi --}}
                                    {{ $item->ringkasan ?? Str::limit(strip_tags($item->isi), 80) }}
                                </p>

                                <div class="mt-auto">
                                    <a href="{{ route('artikel.show', $item->slug) }}"
                                        class="btn-read-more d-inline-flex align-items-center text-decoration-none fw-bold text-primary">
                                        @if ($item->jenis == 'jurnal')
                                            Baca Jurnal
                                        @else
                                            Baca Artikel
                                        @endif
                                        <div class="arrow-icon rounded-circle bg-primary d-flex align-items-center justify-content-center ms-2 text-white"
                                            style="width: 28px; height: 28px;">
                                            <small>→</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 text-center">
                        <div class="d-inline-block rounded-circle mb-3 bg-white p-4 shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60"
                                class="opacity-50">
                        </div>
                        <p class="text-muted fs-5 fw-medium">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================= PRESTASI ================= --}}
    <section class="position-relative reveal py-5"
        style="background:#d8e7ff; border-radius: 100px; margin: 40px 15px; overflow: hidden;">

        {{-- Elemen Dekorasi Cahaya di Latar Belakang --}}
        <div class="position-absolute w-100 h-100 start-0 top-0" style="pointer-events: none;">
            <div class="position-absolute rounded-circle"
                style="width: 300px; height: 300px; background: rgba(255,255,255,0.4); filter: blur(80px); top: -100px; left: -50px;">
            </div>
        </div>

        <div class="position-relative container py-5" style="z-index: 1;">
            <div class="row g-4 align-items-stretch">

                {{-- Bagian Kiri: Card Utama --}}
                @if ($prestasi->count() > 0)
                    @php $utama = $prestasi->first(); @endphp
                    <div class="col-lg-5 animate-left">
                        <div class="card h-100 card-prestasi-utama border-0 p-3 shadow-lg"
                            style="border-radius: 70px 20px 70px 20px; background: #ffffff;">
                            <div class="rounded-custom-img overflow-hidden" style="border-radius: 60px 15px 60px 15px;">
                                <img src="{{ asset('storage/' . $utama->foto) }}" class="w-100 img-hover-zoom"
                                    alt="{{ $utama->judul }}" style="height:380px; object-fit:cover;">
                            </div>

                            <div class="card-body px-2 py-4">
                                <span class="badge bg-primary text-primary rounded-pill mb-3 bg-opacity-10 px-3 py-2">🏆
                                    Prestasi Utama</span>
                                <h3 class="fw-bold mb-3" style="color: #002366; letter-spacing: -0.5px;">
                                    {{ $utama->judul }}</h3>
                                <p class="text-muted mb-4">
                                    {{ Str::limit($utama->deskripsi, 140) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center border-top mt-auto pt-3">
                                    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>
                                        {{ $utama->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Bagian Kanan: Teks & Grid Kecil --}}
                <div class="col-lg-7 d-flex flex-column justify-content-between animate-right">
                    <div class="ps-lg-5 mb-5">
                        <div class="badge-custom mb-3">✨ PRESTASI TERBARU</div>
                        <h1 class="fw-bold display-4 mb-3 mt-2" style="color: #002366; line-height: 1.1;">
                            SD IT Baitul Insan <br> <span class="text-primary text-gradient">Terus Berprestasi</span>
                        </h1>
                        <p class="text-muted fs-5 mb-4 opacity-75">
                            Inilah bukti dedikasi siswa-siswi kami dalam mengharumkan nama sekolah di tingkat daerah maupun
                            nasional.
                        </p>
                        <a href="{{ route('prestasi.index') }}" class="btn-modern-primary">
                            Lihat Semua Prestasi
                            <span class="icon-circle shadow-sm"><i class="bi bi-arrow-right-short"></i></span>
                        </a>
                    </div>

                    <div class="row g-3 ps-lg-5">
                        @foreach ($prestasi->skip(1)->take(2) as $item)
                            <div class="col-md-6">
                                <div class="card h-100 card-prestasi-mini border-0 p-2 shadow-sm"
                                    style="border-radius: 35px 12px 35px 12px; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px);">
                                    <div class="overflow-hidden" style="border-radius: 30px 10px 30px 10px;">
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 img-hover-zoom"
                                            style="height:170px; object-fit:cover;">
                                    </div>
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-2" style="color: #002366;">
                                            {{ Str::limit($item->judul, 45) }}</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small
                                                class="text-muted opacity-75">{{ $item->created_at->format('M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= ULASAN ORANG TUA ================= --}}
    <section class="section-testi-full position-relative overflow-hidden py-5">

        <div class="glow-container">
            <div class="glow-center"></div>
        </div>

        <div class="position-relative container py-5" style="z-index: 2;">
            <div class="mb-5 text-center">
                <h1 class="fw-bold mb-3" style="color: #002366; font-size: 3.5rem; letter-spacing: -1px;">
                    Ulasan Orangtua <br> Siswa Tentang Kami
                </h1>
                <p class="text-secondary fs-5 opacity-75">Tulis ulasan anda untuk menjadikan kami lebih baik lagi</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 position-relative">

                    <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                        <div class="carousel-inner p-4">

                            {{-- Slide 1 --}}
                            <div class="carousel-item active">
                                <div class="card-capsule mx-auto">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="position-relative">
                                            <img src="{{ asset('img/testi1.jpg') }}" class="avatar-img shadow">
                                            <div class="star-badge">★</div>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h5 class="fw-bold mb-0" style="color: #002366;">Aisyah Al - Jufry</h5>
                                            <div class="text-warning small">★★★★★</div>
                                        </div>
                                    </div>
                                    <p class="text-muted lh-base fs-5 italic-text mb-0 text-start">
                                        "SD IT Baitul Insan ini sekolah yang sangat bagus! Lingkungannya bersih,
                                        guru-gurunya ramah, dan anak-anak belajar dengan senang."
                                    </p>
                                </div>
                            </div>

                            {{-- Slide 2 --}}
                            <div class="carousel-item">
                                <div class="card-capsule mx-auto">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="position-relative">
                                            <img src="{{ asset('img/testi2.jpg') }}" class="avatar-img shadow">
                                            <div class="star-badge">★</div>
                                        </div>
                                        <div class="ms-3 text-start">
                                            <h5 class="fw-bold mb-0" style="color: #002366;">Bunda Rizky</h5>
                                            <div class="text-warning small">★★★★★</div>
                                        </div>
                                    </div>
                                    <p class="text-muted lh-base fs-5 italic-text mb-0 text-start">
                                        "Alhamdulillah, sejak sekolah di sini anak saya jadi lebih rajin sholat dan
                                        hafalannya lancar. Program tahfidz-nya sangat membantu."
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- Tombol Navigasi (Navigasi Gelap) --}}
                        <button class="carousel-control-prev custom-nav-dark" type="button"
                            data-bs-target="#carouselTestimoni" data-bs-slide="prev">
                            <span class="nav-circle">←</span>
                        </button>
                        <button class="carousel-control-next custom-nav-dark" type="button"
                            data-bs-target="#carouselTestimoni" data-bs-slide="next">
                            <span class="nav-circle">→</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .text-gradient-primary {
            background: linear-gradient(135deg, #1a44cc, #4dabf7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-testi-full {
            background-color: #f8fafc;
        }

        /* Memusatkan Efek Cahaya */
        .glow-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            pointer-events: none;
        }

        .glow-center {
            width: 700px;
            height: 450px;
            background: radial-gradient(circle, rgba(162, 194, 230, 0.7) 0%, rgba(255, 255, 255, 0) 70%);
            filter: blur(80px);
            border-radius: 50%;
        }

        /* Kartu Kapsul Glassmorphism */
        .card-capsule {
            max-width: 750px;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 150px;
            padding: 40px 60px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .avatar-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
        }

        .star-badge {
            position: absolute;
            bottom: 0;
            right: 15px;
            background: #ffc107;
            color: white;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border: 2px solid white;
        }

        .italic-text {
            font-style: italic;
        }

        /* Navigasi Nav Dark */
        .custom-nav-dark {
            width: 60px;
            opacity: 1 !important;
        }

        .nav-circle {
            background: #1e293b;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .carousel-control-prev.custom-nav-dark {
            left: -40px;
        }

        .carousel-control-next.custom-nav-dark {
            right: -40px;
        }

        /* Tombol Pill */
        .btn-primary-pill {
            background: #1d4ed8;
            color: white;
            border: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            transition: 0.3s;
        }

        .arrow-icon {
            background: white;
            color: #1d4ed8;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin-left: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 992px) {
            .card-capsule {
                border-radius: 50px;
                padding: 25px;
            }

            .custom-nav-dark {
                display: none;
            }

            .glow-center {
                width: 100%;
            }
        }

        /* Efek untuk tombol modern */
        .modern-btn:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 15px 35px rgba(26, 68, 204, 0.4);
        }

        .modern-btn:hover span:last-child {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.25);
        }

        .modern-btn:hover span:first-child {
            transform: translateX(-5px);
        }

        /* Efek untuk tombol floating */
        .btn-floating:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(26, 68, 204, 0.4);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* --- 2. Efek Oval (Artikel & Prestasi) --- */
        .item-oval {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 60px 20px 60px 20px !important;
        }

        .item-oval:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 35, 102, 0.15) !important;
            border-radius: 20px 60px 20px 60px !important;
        }

        /* Zoom Gambar di dalam kartu oval */
        .img-zoom {
            transition: transform 0.6s ease;
        }

        .item-oval:hover .img-zoom,
        .custom-card:hover img,
        .card-prestasi-utama:hover .img-hover-zoom {
            transform: scale(1.1);
        }

        /* --- 3. Efek Prestasi & Section --- */
        .card-prestasi-utama {
            transition: all 0.4s ease;
            border-radius: 70px 20px 70px 20px !important;
        }

        .card-prestasi-utama:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 35, 102, 0.2) !important;
        }

        /* Button Modern dengan Ikon Lingkaran */
        .btn-modern-primary {
            background: #002366;
            color: white;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-modern-primary:hover {
            background: #0036a1;
            color: white;
            transform: scale(1.05);
        }

        /* --- 4. Jenjang Sekolah (TK/SD) --- */
        .custom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 40px !important;
        }

        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
        }

        /* --- 7. Card Kegiatan yang bisa diklik --- */
        .video-thumbnail {
            cursor: pointer !important;
        }

        .video-thumbnail:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        /* Gambar dengan efek zoom */
        .kegiatan-image {
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .video-thumbnail:hover .kegiatan-image {
            transform: scale(1.08);
        }

        /* Overlay Gradient */
        .overlay-gradient {
            transition: all 0.5s ease;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 30%, rgba(0, 0, 0, 0.65) 100%) !important;
        }

        .video-thumbnail:hover .overlay-gradient {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 30%, rgba(0, 0, 0, 0.85) 100%) !important;
        }

        /* Badge Kategori */
        .category-badge {
            transition: all 0.3s ease;
            opacity: 0.9;
        }

        .video-thumbnail:hover .category-badge {
            transform: translateY(-5px);
            opacity: 1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Tombol Play */
        .play-button {
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .video-thumbnail:hover .play-button {
            transform: scale(1.15);
            background-color: rgba(255, 255, 255, 0.4) !important;
            border-color: rgba(255, 255, 255, 0.9) !important;
        }

        .play-icon {
            transition: transform 0.3s ease;
        }

        .video-thumbnail:hover .play-icon {
            transform: translateX(3px);
        }

        /* Teks Overlay */
        .title-overlay {
            transition: all 0.4s ease;
            transform: translateY(10px);
            opacity: 0.9;
        }

        .description-overlay {
            transition: all 0.4s ease 0.1s;
            transform: translateY(10px);
            opacity: 0.7;
        }

        .video-thumbnail:hover .title-overlay,
        .video-thumbnail:hover .description-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        /* Tag Badge */
        .tag-badge {
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .video-thumbnail:hover .tag-badge {
            opacity: 1;
            transform: translateY(-2px);
        }

        /* Bagian Informasi */
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

        /* Deskripsi */
        .description-main {
            position: relative;
            transition: all 0.3s ease;
        }

        .description-main:hover {
            color: #495057 !important;
        }

        /* Info Tanggal */
        .date-info {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .date-info:hover {
            transform: translateX(5px);
            color: #1a44cc !important;
        }

        /* Tombol Watch Video */
        .watch-video-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .watch-video-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3) !important;
            background-color: #dc3545 !important;
            color: white !important;
        }

        /* Tombol Empty State */
        .empty-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .empty-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(26, 68, 204, 0.3) !important;
        }

        .empty-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .empty-button:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        /* Animasi Ripple */
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(40, 40);
                opacity: 0;
            }
        }

        /* Animasi Fade In untuk Card */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .row.align-items-center {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .row.align-items-center:nth-child(2) {
            animation-delay: 0.2s;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .kegiatan-card {
                height: 350px !important;
            }

            .title-main {
                font-size: 2.5rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Efek parallax ringan pada gambar
            const kegiatanCards = document.querySelectorAll('.kegiatan-card');

            kegiatanCards.forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const {
                        left,
                        top,
                        width,
                        height
                    } = this.getBoundingClientRect();
                    const x = (e.clientX - left) / width;
                    const y = (e.clientY - top) / height;

                    const image = this.querySelector('.kegiatan-image');
                    if (image) {
                        image.style.transform =
                            `scale(1.08) translate(${(x - 0.5) * 10}px, ${(y - 0.5) * 10}px)`;
                    }
                });

                card.addEventListener('mouseleave', function() {
                    const image = this.querySelector('.kegiatan-image');
                    if (image) {
                        image.style.transform = 'scale(1.08)';
                        setTimeout(() => {
                            image.style.transform = 'scale(1)';
                        }, 300);
                    }
                });
            });

            // Handle video modal pada halaman beranda
            const videoModals = document.querySelectorAll('.video-modal');

            videoModals.forEach(function(modal) {
                modal.addEventListener('shown.bs.modal', function() {
                    const videoType = this.getAttribute('data-video-type');
                    const videoId = this.getAttribute('data-video-id');
                    const modalId = this.id;
                    const kegiatanId = modalId.replace('videoModal', '');

                    if (videoType === 'youtube' && videoId) {
                        const iframe = document.getElementById(`youtubeIframe${kegiatanId}`);
                        if (iframe) {
                            const src = iframe.getAttribute('data-src');
                            iframe.src = src + '&autoplay=1';
                        }
                    } else if (videoType === 'local') {
                        const video = document.getElementById(`localVideo${kegiatanId}`);
                        if (video) {
                            video.play().catch(e => {
                                video.controls = true;
                            });
                        }
                    }
                });

                modal.addEventListener('hide.bs.modal', function() {
                    const videoType = this.getAttribute('data-video-type');
                    const modalId = this.id;
                    const kegiatanId = modalId.replace('videoModal', '');

                    if (videoType === 'youtube') {
                        const iframe = document.getElementById(`youtubeIframe${kegiatanId}`);
                        if (iframe) {
                            const src = iframe.src;
                            iframe.src = src.replace('&autoplay=1', 'autoplay=0').replace(
                                /&autoplay=1/, '');
                        }
                    } else if (videoType === 'local') {
                        const video = document.getElementById(`localVideo${kegiatanId}`);
                        if (video) {
                            video.pause();
                            video.currentTime = 0;
                        }
                    }
                });
            });

            // Animasi saat halaman dimuat
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.kegiatan-card, .icon-container, .title-main').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endpush
