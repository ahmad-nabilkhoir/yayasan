{{-- resources/views/pages/jenjang/sd.blade.php --}}
@extends('layouts.app')
@section('title', 'Jenjang SD - SD IT Baitul Insan')
@section('description', 'Informasi lengkap tentang SD IT Baitul Insan - Pendidikan dasar Islam terpadu berkualitas')
@section('content')
    <!-- Hero Section -->
    <section class="sd-hero-section position-relative overflow-hidden">
        <div class="position-relative container py-5" style="z-index: 2;">
            <div class="row align-items-center min-vh-80 py-5">
                <div class="col-lg-7">
                    <div class="mb-5">
                        <span class="badge text-success rounded-pill fw-semibold mb-3 bg-white px-4 py-2 shadow-sm">
                            <i class="bi bi-mortarboard-fill me-2"></i>JENJANG SD
                        </span>
                        <h1 class="display-3 fw-bold mb-4 text-white">SD IT Baitul Insan</h1>
                        <p class="lead text-white-75 mb-4">
                            Membentuk generasi profetik yang unggul dalam IMTAQ dan IPTEK melalui pendidikan Islam terpadu
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('daftar-sekarang') }}"
                            class="btn btn-light btn-lg rounded-pill fw-semibold px-4 py-3 shadow-sm">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="#galeri" class="btn btn-outline-light btn-lg rounded-pill fw-semibold px-4 py-3">
                            <i class="bi bi-images me-2"></i>Lihat Galeri
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 mt-lg-0 mt-5 text-center">
                    <div class="position-relative">
                        <div class="rounded-4 animate-float bg-white p-3 shadow-lg">
                            <img src="{{ asset('img/tk-hero.jpg') }}" alt="TK IT Baitul Insan"
                                class="img-fluid rounded-3 shadow"
                                onerror="this.src='https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wave Divider -->
        <div class="wave-divider">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    opacity=".25"></path>
                <path
                    d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                    opacity=".5"></path>
                <path
                    d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Navigation Tabs -->
    <section class="sticky-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="nav-scroller">
                <nav class="nav nav-underline justify-content-center">
                    <a class="nav-link fw-medium" href="#profil">
                        <i class="bi bi-building me-2"></i>Profil
                    </a>
                    <a class="nav-link fw-medium" href="#visi-misi">
                        <i class="bi bi-compass me-2"></i>Visi Misi
                    </a>
                    <a class="nav-link fw-medium" href="#kurikulum">
                        <i class="bi bi-journal-bookmark me-2"></i>Kurikulum
                    </a>
                    <a class="nav-link fw-medium" href="#program">
                        <i class="bi bi-star-fill me-2"></i>Program
                    </a>
                    <a class="nav-link fw-medium" href="#fasilitas">
                        <i class="bi bi-cpu me-2"></i>Fasilitas
                    </a>
                    <a class="nav-link fw-medium" href="#ekstra">
                        <i class="bi bi-joystick me-2"></i>Ekstra
                    </a>
                    <a class="nav-link fw-medium" href="#galeri">
                        <i class="bi bi-camera-fill me-2"></i>Galeri
                    </a>
                    <a class="nav-link fw-medium" href="#prestasi">
                        <i class="bi bi-trophy me-2"></i>Prestasi
                    </a>
                    <a class="nav-link fw-medium" href="#staff">
                        <i class="bi bi-person-vcard me-2"></i>Staff & Guru
                    </a>
                    <a class="nav-link fw-medium" href="#pendaftaran">
                        <i class="bi bi-pencil-square me-2"></i>Pendaftaran
                    </a>
                </nav>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah -->
    <section class="py-lg-10 bg-white py-8" id="profil">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="mb-6 text-center"> <!-- Tambahkan text-center -->
                        <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                            <i class="bi bi-building me-1"></i> Profil Sekolah
                        </span>
                        <h2 class="fw-bold text-dark mb-4">Tentang SD IT Baitul Insan</h2>
                    </div>
                    @if ($tentang)
                        <div class="sd-sejarah-content"> <!-- Ganti class menjadi sd-sejarah-content -->
                            @if ($tentang->thumbnail)
                                <div class="mb-4 text-center">
                                    <img src="{{ asset('storage/' . $tentang->thumbnail) }}"
                                        alt="Gambar Profil SD IT Baitul Insan"
                                        class="img-fluid img-rounded-lg img-shadow mx-auto"
                                        style="max-height: 400px; object-fit: cover;">
                                    <p class="text-muted small mt-2">Gambar Profil SD IT Baitul Insan</p>
                                </div>
                            @endif
                            <div class="text-dark-75 fs-5 lh-base">
                                {!! $tentang->isi !!}
                            </div>
                        </div>
                    @else
                        <p class="text-dark-75 fs-5 lh-base mb-6">
                            SD IT Baitul Insan merupakan lembaga pendidikan dasar Islam terpadu yang mengintegrasikan
                            kurikulum nasional dengan nilai-nilai Islam. Kami berkomitmen untuk membentuk generasi yang
                            beriman, berilmu, dan berakhlak mulia.
                        </p>
                    @endif
                    <div class="row g-4 mt-5"> <!-- Tambahkan mt-5 untuk jarak -->
                        <div class="col-md-6">
                            <div class="sd-info-card h-100">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-calendar2-check text-white"></i>
                                </div>
                                <div class="sd-info-content">
                                    <h6 class="fw-bold text-dark mb-2">Tahun Berdiri</h6>
                                    <p class="text-muted mb-0">{{ $tahun_berdiri }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sd-info-card h-100">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-award text-white"></i>
                                </div>
                                <div class="sd-info-content">
                                    <h6 class="fw-bold text-dark mb-2">Kepala Sekolah</h6>
                                    <p class="text-muted mb-0">{{ $kepala_sekolah }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sd-info-card h-100">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-clock-history text-white"></i>
                                </div>
                                <div class="sd-info-content">
                                    <h6 class="fw-bold text-dark mb-2">Jam Belajar</h6>
                                    <p class="text-muted mb-0">{{ $jam_belajar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sd-info-card h-100">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-telephone-forward text-white"></i>
                                </div>
                                <div class="sd-info-content">
                                    <h6 class="fw-bold text-dark mb-2">Kontak</h6>
                                    <p class="text-muted mb-0">{{ $telepon }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section class="py-lg-10 bg-light py-8" id="visi-misi">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-compass me-1"></i> Visi & Misi
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Visi Misi SD Baitul Insan</h2>
                <p class="text-muted fs-5">Panduan dalam menyelenggarakan pendidikan dasar Islam terpadu</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="sd-vision-card">
                        <div class="mb-4 text-center">
                            <div class="sd-icon-circle bg-success-soft mb-4">
                                <i class="bi bi-eye text-success fs-2"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-4">Visi</h3>
                        </div>
                        <div class="sd-vision-content">
                            <p class="fs-4 fw-semibold text-dark mb-0">{{ $visi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sd-mission-card">
                        <div class="mb-4 text-center">
                            <div class="sd-icon-circle bg-success-soft mb-4">
                                <i class="bi bi-bullseye text-success fs-2"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-4">Misi</h3>
                        </div>
                        <div class="sd-mission-list">
                            @foreach ($misi as $index => $item)
                                <div class="sd-mission-item">
                                    <span class="sd-mission-number">{{ $index + 1 }}</span>
                                    <div class="sd-mission-text">
                                        <p class="fs-5 text-dark-75 mb-0">{{ $item }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kurikulum -->
    <section class="py-lg-10 bg-white py-8" id="kurikulum">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-journal-bookmark me-1"></i> Kurikulum
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Kurikulum Terpadu</h2>
                <p class="text-muted fs-5">Integrasi kurikulum nasional dengan nilai-nilai Islam</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($kurikulum as $kuri)
                    <div class="col-lg-4 col-md-6">
                        <div class="sd-curriculum-card">
                            <div class="sd-icon-circle bg-success-soft mx-auto mb-4">
                                <i class="bi bi-journal-text text-success fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">{{ $kuri }}</h5>
                            <p class="text-muted mb-0">
                                Diterapkan secara komprehensif dalam proses pembelajaran sehari-hari
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Program Unggulan -->
    <section class="py-lg-10 bg-light py-8" id="program">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-stars me-1"></i> Program
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Program Unggulan SD</h2>
                <p class="text-muted fs-5">Program khusus yang menjadi keunggulan SD Baitul Insan</p>
            </div>
            <div class="row g-4">
                @foreach ($program_unggulan as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="sd-program-card">
                            <div class="sd-icon-circle bg-success-soft mb-4">
                                <i class="bi bi-trophy text-success fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">{{ $program }}</h5>
                            <p class="text-muted mb-0">
                                Program terstruktur untuk mengembangkan potensi akademik dan non-akademik siswa
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="py-lg-10 bg-white py-8" id="fasilitas">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-building-gear me-1"></i> Fasilitas
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Fasilitas Lengkap & Modern</h2>
                <p class="text-muted fs-5">Dukung proses belajar dengan fasilitas yang memadai dan modern</p>
            </div>
            <div class="row g-4">
                @foreach ($fasilitas as $fasilitas_item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="sd-facility-card">
                            <div class="sd-icon-circle bg-success-soft mx-auto mb-3">
                                <i class="bi bi-check-circle text-success fs-2"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0">{{ $fasilitas_item }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Ekstrakurikuler -->
    <section class="py-lg-10 bg-light py-8" id="ekstra">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-joystick me-1"></i> Ekstrakurikuler
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Kegiatan Ekstrakurikuler</h2>
                <p class="text-muted fs-5">Pengembangan bakat, minat, dan karakter siswa</p>
            </div>
            <div class="row g-4">
                @foreach ($ekstrakurikuler as $ekstra)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="sd-extracurricular-card">
                            <div class="sd-icon-circle bg-success-soft mx-auto mb-3">
                                <i class="bi bi-heart-pulse text-success fs-2"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0">{{ $ekstra }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section class="py-lg-10 bg-white py-8" id="galeri">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-8">
                <div>
                    <span
                        class="badge bg-success-soft text-success rounded-pill d-inline-block fw-semibold mb-2 px-4 py-2">
                        <i class="bi bi-camera-fill me-1"></i> Galeri
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-0">Momen Terbaik SD Baitul Insan</h2>
                </div>
                <a href="{{ route('galeri.index', ['kategori' => 'SD']) }}"
                    class="btn btn-outline-success rounded-pill fw-semibold px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            @if ($galeri->count() > 0)
                <div class="row g-4">
                    @foreach ($galeri as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="sd-gallery-card">
                                <div class="sd-gallery-image">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 h-100 object-fit-cover"
                                        alt="{{ $item->judul }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                    <span class="sd-gallery-badge">{{ $item->kategori }}</span>
                                </div>
                                <div class="sd-gallery-content">
                                    <h6 class="fw-bold text-dark mb-2">{{ Str::limit($item->judul, 40) }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($item->deskripsi, 60) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="sd-icon-circle bg-success-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-images text-success fs-1"></i>
                    </div>
                    <h5 class="text-muted">Belum ada galeri untuk SD</h5>
                </div>
            @endif
        </div>
    </section>

    <!-- Prestasi -->
    <section class="py-lg-10 bg-light py-8" id="prestasi">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-8">
                <div>
                    <span
                        class="badge bg-success-soft text-success rounded-pill d-inline-block fw-semibold mb-2 px-4 py-2">
                        <i class="bi bi-trophy me-1"></i> Prestasi
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-0">Prestasi Siswa SD</h2>
                </div>
                <a href="{{ route('prestasi.index', ['sekolah' => 'SD']) }}"
                    class="btn btn-outline-success rounded-pill fw-semibold px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            @if ($prestasi->count() > 0)
                <div class="row g-4">
                    @foreach ($prestasi as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="sd-achievement-card">
                                <div class="sd-achievement-image">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 h-100 object-fit-cover"
                                        alt="{{ $item->judul }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1519861531473-920034658307?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                    <span class="sd-achievement-year">{{ $item->tahun }}</span>
                                </div>
                                <div class="sd-achievement-content">
                                    <h5 class="fw-bold text-dark mb-2">{{ $item->judul }}</h5>
                                    @if ($item->sub_judul)
                                        <p class="text-muted small mb-3">{{ $item->sub_judul }}</p>
                                    @endif
                                    <p class="text-muted mb-0">{{ Str::limit($item->deskripsi, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="sd-icon-circle bg-success-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-trophy text-success fs-1"></i>
                    </div>
                    <h5 class="text-muted">Belum ada prestasi untuk SD</h5>
                </div>
            @endif
        </div>
    </section>

    <!-- Staff & Guru SD -->
    <section class="py-lg-10 bg-white py-8" id="staff">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2"><i
                        class="bi bi-people-fill me-1"></i> Tenaga Pendidik</span>
                <h2 class="display-5 fw-bold text-dark mb-3">Staff & Guru SD</h2>
            </div>

            <!-- Kepala Yayasan SD -->
            @if ($kepalaYayasan->count() > 0)
                <div class="mb-8">
                    <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">Kepala Yayasan</h3>
                    <div class="row g-4 justify-content-center">
                        @foreach ($kepalaYayasan as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="sd-leader-card">
                                    <div class="sd-leader-avatar">
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            class="rounded-circle object-fit-cover border-3 border-success" width="140"
                                            height="140" alt="{{ $item->nama }}"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=28a745&color=fff&size=140'">
                                        <div class="sd-leader-badge bg-success"><i class="bi bi-award-fill"></i></div>
                                    </div>
                                    <div class="sd-leader-content">
                                        <h4 class="fw-bold text-dark mb-2">{{ $item->nama }}</h4>
                                        <p class="text-success fw-semibold mb-3">{{ $item->jabatan }}</p>
                                        @if (isset($item->jenjang_info))
                                            <span
                                                class="badge bg-success-soft text-success rounded-pill mb-3">{{ $item->jenjang_info }}</span>
                                        @endif
                                        @if ($item->keterangan)
                                            <p class="text-muted mb-0">{{ Str::limit($item->keterangan, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Kepala Sekolah SD -->
            @if ($kepalaSekolah->count() > 0)
                <div class="mb-8">
                    <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">Kepala Sekolah</h3>
                    <div class="row g-4 justify-content-center">
                        @foreach ($kepalaSekolah as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="sd-headmaster-card">
                                    <div class="sd-headmaster-avatar">
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            class="rounded-circle object-fit-cover border-3 border-success" width="130"
                                            height="130" alt="{{ $item->nama }}"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=28a745&color=fff&size=130'">
                                        <div class="sd-headmaster-badge bg-success"><i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                    </div>
                                    <div class="sd-headmaster-content">
                                        <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
                                        <p class="text-success fw-semibold mb-3">{{ $item->jabatan }}</p>
                                        @if (isset($item->jenjang_info))
                                            <span
                                                class="badge bg-success-soft text-success rounded-pill mb-3">{{ $item->jenjang_info }}</span>
                                        @endif
                                        @if ($item->keterangan)
                                            <p class="text-muted small mb-0">{{ Str::limit($item->keterangan, 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Guru SD -->
            @if ($guru->count() > 0)
                <div>
                    <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">Guru Kelas</h3>
                    <div class="row g-4 justify-content-center">
                        @foreach ($guru as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="sd-teacher-card">
                                    <div class="sd-teacher-avatar">
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            class="rounded-circle object-fit-cover border-3 border-success" width="120"
                                            height="120" alt="{{ $item->nama }}"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=28a745&color=fff&size=120'">
                                    </div>
                                    <div class="sd-teacher-content">
                                        <h6 class="fw-bold text-dark mb-2">{{ $item->nama }}</h6>
                                        <p class="text-success fw-semibold small mb-2">{{ $item->jabatan }}</p>
                                        @if (isset($item->jenjang_info))
                                            <span
                                                class="badge bg-success-soft text-success rounded-pill small mb-2">{{ $item->jenjang_info }}</span>
                                        @endif
                                        @if ($item->keterangan)
                                            <p class="text-muted extra-small mb-0">{{ Str::limit($item->keterangan, 60) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="sd-icon-circle bg-success-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-people text-success"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data tenaga pendidik untuk SD</h5>
                </div>
            @endif
        </div>
    </section>

    <!-- Info Pendaftaran -->
    <section class="py-lg-10 bg-light py-8" id="pendaftaran">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-success-soft text-success rounded-pill fw-semibold mb-3 px-4 py-2">
                        <i class="bi bi-pencil-square me-1"></i> Pendaftaran
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-4">Informasi Pendaftaran SD</h2>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="sd-info-highlight">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-calendar-week text-white"></i>
                                </div>
                                <div class="sd-info-text">
                                    <h6 class="fw-bold text-dark mb-1">Jam Belajar</h6>
                                    <p class="text-muted mb-0">{{ $jam_belajar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sd-info-highlight">
                                <div class="sd-info-icon bg-gradient-success">
                                    <i class="bi bi-telephone-outbound text-white"></i>
                                </div>
                                <div class="sd-info-text">
                                    <h6 class="fw-bold text-dark mb-1">Kontak</h6>
                                    <p class="text-muted mb-0">{{ $telepon }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sd-requirements-card">
                        <h5 class="fw-bold text-dark mb-3">Persyaratan Pendaftaran</h5>
                        <ul class="sd-requirements-list">
                            @if (isset($persyaratan) && is_array($persyaratan))
                                @foreach ($persyaratan as $req)
                                    <li class="sd-requirements-item">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <span>{{ $req }}</span>
                                    </li>
                                @endforeach
                            @else
                                <!-- Fallback jika data persyaratan tidak tersedia -->
                                @foreach (['Usia minimal 6 tahun', 'Fotokopi akta kelahiran', 'Fotokopi kartu keluarga', 'Pas foto 3x4 (3 lembar)', 'Surat keterangan sehat dari dokter', 'Surat keterangan lulus TK'] as $requirement)
                                    <li class="sd-requirements-item">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <span>{{ $requirement }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sd-cta-card">
                        <div class="sd-cta-icon bg-success-soft text-success rounded-circle mx-auto mb-4"
                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-plus fs-1"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Siap Mendaftar?</h3>
                        <p class="text-muted mb-4">
                            Segera bergabung bersama kami di SD IT Baitul Insan dan berikan pendidikan terbaik untuk
                            putra-putri Anda.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('daftar-sekarang') }}"
                                class="btn btn-success btn-lg rounded-pill fw-semibold flex-fill px-4 py-3">
                                <i class="bi bi-pencil me-2"></i>Daftar Sekarang
                            </a>
                            <a href="{{ route('alur-pendaftaran') }}"
                                class="btn btn-outline-success btn-lg rounded-pill fw-semibold flex-fill px-4 py-3">
                                <i class="bi bi-arrow-right-circle me-2"></i>Lihat Alur
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* ================= GLOBAL STYLES ================= */
        .py-8 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .py-lg-10 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .min-vh-80 {
            min-height: 80vh;
        }

        .text-dark {
            color: #004d40 !important;
            /* Dark Green */
        }

        .text-dark-75 {
            color: rgba(0, 77, 64, 0.85) !important;
            /* Dark Green 75% */
        }

        .extra-small {
            font-size: 0.8rem;
            line-height: 1.3;
        }

        /* ================= HERO SECTION ================= */
        .sd-hero-section {
            background: linear-gradient(135deg, #28a745 0%, #007a3d 100%);
            /* Primary Green to Darker Green */
            position: relative;
        }

        .wave-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
        }

        .wave-divider path {
            fill: #ffffff;
        }

        /* ================= NAVIGATION ================= */
        .sticky-nav {
            position: sticky;
            top: 72px;
            z-index: 1020;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
        }

        .nav-scroller {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .nav-scroller::-webkit-scrollbar {
            display: none;
        }

        .sticky-nav .nav {
            flex-wrap: nowrap;
            gap: .5rem;
        }

        .sticky-nav .nav-link {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .55rem 1rem;
            border-radius: 999px;
            color: #495057;
            font-size: .95rem;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .sticky-nav .nav-link i {
            font-size: 1rem;
            opacity: .85;
        }

        .sticky-nav .nav-link:hover {
            background: rgba(40, 167, 69, .08);
            /* Green */
            color: #28a745;
            /* Green */
        }

        .sticky-nav .nav-link.active,
        .sticky-nav .nav-link:focus {
            background: #28a745;
            /* Green */
            color: #fff;
        }

        .sticky-nav .nav-link.active i,
        .sticky-nav .nav-link:focus i {
            color: #fff;
        }

        @media (max-width: 768px) {
            .sticky-nav {
                top: 64px;
            }

            .sticky-nav .nav {
                justify-content: flex-start;
            }
        }

        /* ================= COLOR SYSTEM (GREEN) ================= */
        .bg-success-soft {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(120, 200, 120, 0.1) 100%) !important;
            /* Light Green Soft */
        }

        .bg-warning-soft {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%) !important;
        }

        .text-success {
            color: #28a745 !important;
            /* Bootstrap Success Green */
        }

        .text-warning {
            color: #28a745 !important;
        }

        .bg-light {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #7ec850 100%) !important;
            /* Green to Lighter Green */
        }

        /* ================= COMPONENT STYLES ================= */
        /* Info Cards */
        .sd-info-card {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .sd-info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(40, 167, 69, 0.15);
            /* Green */
            border-color: transparent;
        }

        .sd-info-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.2);
            /* Green */
        }

        /* Icon Circles */
        .sd-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(120, 200, 120, 0.1) 100%);
            /* Light Green Soft */
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
            /* Green */
        }

        /* Vision & Mission Cards */
        .sd-vision-card,
        .sd-mission-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            height: 100%;
            border: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .sd-vision-card::before,
        .sd-mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
        }

        .sd-vision-card:hover,
        .sd-mission-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(40, 167, 69, 0.15);
            /* Green */
        }

        .sd-vision-content {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(120, 200, 120, 0.05) 100%);
            /* Light Green Soft */
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
        }

        .sd-mission-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(0, 77, 64, 0.1);
            /* Dark Green */
        }

        .sd-mission-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .sd-mission-number {
            background: linear-gradient(135deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
            margin-right: 1.5rem;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        /* Curriculum & Program Cards */
        .sd-curriculum-card,
        .sd-program-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            height: 100%;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sd-curriculum-card:hover,
        .sd-program-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(40, 167, 69, 0.15);
            /* Green */
            border-color: transparent;
        }

        /* Facility & Extracurricular Cards */
        .sd-facility-card,
        .sd-extracurricular-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            height: 100%;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s ease;
        }

        .sd-facility-card:hover,
        .sd-extracurricular-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(40, 167, 69, 0.12);
            /* Green */
            border-color: transparent;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        /* Gallery & Achievement Cards */
        .sd-gallery-card,
        .sd-achievement-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sd-gallery-card:hover,
        .sd-achievement-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-color: transparent;
        }

        .sd-gallery-image,
        .sd-achievement-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .sd-gallery-image img,
        .sd-achievement-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sd-gallery-card:hover .sd-gallery-image img,
        .sd-achievement-card:hover .sd-achievement-image img {
            transform: scale(1.1);
        }

        .sd-gallery-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        .sd-achievement-year {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, #004d40 0%, #28a745 100%);
            /* Dark Green to Green */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 77, 64, 0.3);
            /* Dark Green */
        }

        .sd-gallery-content,
        .sd-achievement-content {
            padding: 2rem;
        }

        /* ================= STAFF CARDS ================= */
        /* Leader Card (Kepala Yayasan) */
        .sd-leader-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 24px;
            padding: 2.5rem;
            text-align: center;
            border: 2px solid rgba(40, 167, 69, 0.2);
            /* Green */
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.1);
            /* Green */
        }

        .sd-leader-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(40, 167, 69, 0.2);
            /* Green */
            border-color: #28a745;
            /* Green */
        }

        .sd-leader-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #28a745 0%, #7ec850 100%);
            /* Green */
        }

        .sd-leader-avatar {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 1.5rem;
        }

        .sd-leader-avatar img {
            width: 140px;
            height: 140px;
            border: 4px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .sd-leader-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            border: 3px solid white;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        .sd-leader-content h4 {
            font-size: 1.5rem;
        }

        /* Headmaster Card (Kepala Sekolah) */
        .sd-headmaster-card {
            background: linear-gradient(135deg, #ffffff 0%, #e8f5e9 100%);
            /* Light Green */
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 2px solid rgba(40, 167, 69, 0.15);
            /* Green */
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.1);
            /* Green */
        }

        .sd-headmaster-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(40, 167, 69, 0.15);
            /* Green */
            border-color: #28a745;
            /* Green */
        }

        .sd-headmaster-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
        }

        .sd-headmaster-avatar {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .sd-headmaster-avatar img {
            width: 130px;
            height: 130px;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .sd-headmaster-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        /* Teacher Card (Guru) */
        .sd-teacher-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s ease;
            height: 100%;
        }

        .sd-teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.1);
            /* Green */
            border-color: transparent;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .sd-teacher-avatar {
            width: 130px;
            height: 130px;
            margin: 0 auto 1rem;
        }

        .sd-teacher-avatar img {
            width: 120px;
            height: 120px;
            border: 3px solid white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .sd-teacher-content h6 {
            font-size: 1.1rem;
            min-height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sd-teacher-content p.text-success {
            font-size: 0.9rem;
            min-height: 2.5rem;
        }

        /* General Staff Card (for other staff sections if needed) */
        .sd-staff-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .sd-staff-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
        }

        .sd-staff-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(40, 167, 69, 0.15);
            /* Green */
            border-color: transparent;
        }

        .sd-staff-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 2rem;
            border: 4px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .sd-staff-card:hover .sd-staff-avatar {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* ================= FORM COMPONENTS ================= */
        .sd-registration-form {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            position: relative;
            overflow: hidden;
        }

        .sd-registration-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
        }

        .sd-requirements-card {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(120, 200, 120, 0.05) 100%);
            /* Light Green Soft */
            border: 2px solid rgba(40, 167, 69, 0.2);
            /* Green */
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .sd-requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sd-requirements-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 12px;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s ease;
        }

        .sd-requirements-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.1);
            /* Green */
        }

        .sd-requirements-item i {
            margin-right: 1rem;
            font-size: 1.25rem;
            color: #28a745;
            /* Green */
        }

        /* Info Highlight */
        .sd-info-highlight {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(40, 167, 69, 0.1);
            /* Green */
            transition: all 0.3s ease;
        }

        .sd-info-highlight:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(40, 167, 69, 0.1);
            /* Green */
            border-color: transparent;
        }

        /* ================= FORM ELEMENTS ================= */
        .form-control,
        .form-select {
            border: 1px solid rgba(40, 167, 69, 0.2);
            /* Green */
            transition: all 0.3s ease;
            padding: 0.75rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #28a745;
            /* Green */
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
            /* Green */
            transform: translateY(-2px);
        }

        /* ================= BUTTONS ================= */
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        .btn-outline-success {
            border: 2px solid #28a745;
            /* Green */
            color: #28a745;
            /* Green */
            transition: all 0.3s ease;
        }

        .btn-outline-success:hover {
            background: linear-gradient(135deg, #28a745 0%, #7ec850 100%);
            /* Green to Lighter Green */
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
            /* Green */
        }

        /* ================= ANIMATIONS ================= */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* ================= SECTION HEADERS ================= */
        .border-bottom {
            border-bottom: 2px solid rgba(40, 167, 69, 0.1) !important;
            /* Green */
        }

        /* ================= RESPONSIVE DESIGN ================= */
        @media (max-width: 1200px) {
            .sd-icon-circle {
                width: 70px;
                height: 70px;
            }
        }

        @media (max-width: 992px) {
            .py-lg-10 {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            .display-5 {
                font-size: 2.5rem;
            }

            .sd-vision-card,
            .sd-mission-card {
                padding: 2rem;
            }

            .sd-registration-form {
                padding: 2rem;
            }

            .sd-leader-card,
            .sd-headmaster-card {
                padding: 1.5rem;
            }

            .sd-leader-avatar,
            .sd-headmaster-avatar {
                width: 140px;
                height: 140px;
            }

            .sd-leader-avatar img {
                width: 120px;
                height: 120px;
            }

            .sd-headmaster-avatar img {
                width: 110px;
                height: 110px;
            }
        }

        @media (max-width: 768px) {
            .display-3 {
                font-size: 2.5rem;
            }

            .display-5 {
                font-size: 2rem;
            }

            .sticky-nav {
                top: 60px;
            }

            .nav-underline .nav-link {
                padding: 0.75rem 1.25rem;
                font-size: 0.85rem;
            }

            .sd-staff-card,
            .sd-gallery-card,
            .sd-achievement-card {
                padding: 1.5rem;
            }

            .sd-gallery-image,
            .sd-achievement-image {
                height: 200px;
            }

            .sd-leader-content h4 {
                font-size: 1.3rem;
            }

            .sd-teacher-card {
                padding: 1.25rem;
            }

            .sd-teacher-avatar {
                width: 110px;
                height: 110px;
            }

            .sd-teacher-avatar img {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 576px) {
            .display-3 {
                font-size: 2rem;
            }

            .display-5 {
                font-size: 1.75rem;
            }

            .lead {
                font-size: 1rem;
            }

            .sd-info-card {
                padding: 1.25rem;
            }

            .sd-icon-circle {
                width: 60px;
                height: 60px;
            }

            .sd-icon-circle i {
                font-size: 1.5rem;
            }

            .sd-leader-card,
            .sd-headmaster-card {
                padding: 1.25rem;
            }

            .sd-leader-avatar,
            .sd-headmaster-avatar {
                width: 120px;
                height: 120px;
            }

            .sd-leader-avatar img {
                width: 100px;
                height: 100px;
            }

            .sd-headmaster-avatar img {
                width: 90px;
                height: 90px;
            }

            .sd-teacher-content h6 {
                font-size: 1rem;
            }
        }

        /* --- CSS untuk Profil Sekolah (bagian isi konten) --- */
        .sd-sejarah-content {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            /* Padding konsisten dengan tentang.blade.php */
            box-shadow: 0 10px 30px rgba(0, 35, 102, 0.08);
            /* Gaya shadow dari tentang.blade.php */
            margin-bottom: 30px;
            /* Jarak ke konten berikutnya */
        }

        /* Styling untuk gambar dalam konten sejarah/profil */
        .sd-sejarah-content img {
            max-width: 100%;
            /* Gambar tidak melebihi lebar container */
            height: auto;
            /* Menjaga aspek rasio */
            border-radius: 15px;
            /* Sudut membulat */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            transition: transform 0.3s ease;
            /* Transisi halus untuk hover */
            display: block;
            /* Gambar sebagai blok untuk margin otomatis jika diperlukan */
            margin: 15px auto;
            /* Margin atas/bawah 15px, kiri/kanan auto untuk center */
        }

        .sd-sejarah-content img:hover {
            transform: scale(1.02);
            /* Sedikit zoom saat hover */
        }

        /* Layout khusus untuk gambar + teks side by side (jika ada di isi) */
        .sd-sejarah-content .image-text-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 30px;
            /* Jarak antar elemen */
            margin: 30px 0;
            /* Jarak atas/bawah */
        }

        .sd-sejarah-content .image-text-wrapper img {
            flex: 0 0 300px;
            /* Lebar tetap 300px */
            max-width: 100%;
            /* Tetap responsif */
        }

        .sd-sejarah-content .image-text-wrapper .text-content {
            flex: 1;
            /* Sisa ruang */
            min-width: 300px;
            /* Lebar minimum */
        }

        /* Gaya tambahan untuk thumbnail di atas konten */
        .img-rounded-lg {
            border-radius: 15px;
        }

        .img-shadow {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offset = 100;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - offset;
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Active navigation on scroll
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('section[id]');
                const navLinks = document.querySelectorAll('.nav-underline .nav-link');
                const scrollPos = window.pageYOffset || document.documentElement.scrollTop;
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 150;
                    const sectionHeight = section.clientHeight;
                    const sectionId = section.getAttribute('id');
                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        current = sectionId;
                    }
                });
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href').substring(1) === current) {
                        link.classList.add('active');
                    }
                });
            });

            // Form validation
            (function() {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation');
                Array.from(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();

            // Add hover effects to cards
            const cards = document.querySelectorAll(
                '.sd-program-card, .sd-facility-card, .sd-extracurricular-card, .sd-gallery-card, .sd-achievement-card, .sd-staff-card, .sd-curriculum-card, .sd-info-card, .sd-mission-card, .sd-vision-card, .sd-teacher-card, .sd-headmaster-card, .sd-leader-card, .sd-info-highlight, .sd-requirements-item'
            );
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });

            // Add loading animation for images
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                    this.style.transition = 'opacity 0.5s ease';
                });
                img.style.opacity = '0';
            });
        });
    </script>
@endpush
