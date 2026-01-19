{{-- resources/views/pages/jenjang/tk.blade.php --}}
@extends('layouts.app')

@section('title', 'Jenjang TK - TK IT Baitul Insan')
@section('description', 'Informasi lengkap tentang TK IT Baitul Insan - Pendidikan anak usia dini berbasis nilai Islam')

@section('content')
    <!-- Hero Section -->
    <section class="tk-hero-section position-relative overflow-hidden">
        <div class="position-relative container py-5" style="z-index: 2;">
            <div class="row align-items-center min-vh-80 py-5">
                <div class="col-lg-7">
                    <div class="mb-5">
                        <span class="badge text-warning rounded-pill fw-semibold mb-3 bg-white px-4 py-2 shadow-sm">
                            <i class="bi bi-emoji-smile-fill me-2"></i>JENJANG TK
                        </span>
                        <h1 class="display-3 fw-bold mb-4 text-white">TK IT Baitul Insan</h1>
                        <p class="lead text-white-75 mb-4">
                            Membentuk karakter profetik sejak dini melalui pendidikan Islam terpadu yang menyenangkan
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
                        <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                            <i class="bi bi-building me-1"></i> Profil Sekolah
                        </span>
                        <h2 class="fw-bold text-dark mb-4">Tentang TK IT Baitul Insan</h2>
                    </div>
                    @if ($tentang)
                        <div class="tk-sejarah-content"> <!-- Gunakan class tk-sejarah-content -->
                            @if ($tentang->thumbnail)
                                <div class="mb-4 text-center">
                                    <img src="{{ asset('storage/' . $tentang->thumbnail) }}"
                                        alt="Gambar Profil TK IT Baitul Insan"
                                        class="img-fluid img-rounded-lg img-shadow mx-auto"
                                        style="max-height: 400px; object-fit: cover;">
                                    <p class="text-muted small mt-2">Gambar Profil TK IT Baitul Insan</p>
                                </div>
                            @endif
                            <div class="text-dark-75 fs-5 lh-base">
                                {!! $tentang->isi !!}
                            </div>
                        </div>
                    @else
                        <p class="text-dark-75 fs-5 lh-base mb-6">
                            TK IT Baitul Insan merupakan lembaga pendidikan anak usia dini Islam terpadu yang
                            mengintegrasikan
                            nilai-nilai Islam ke dalam kegiatan belajar mengajar. Kami berkomitmen untuk membentuk generasi
                            emas yang beriman, berilmu, dan berakhlak mulia sejak dini.
                        </p>
                    @endif
                    <div class="row g-4 mt-5"> <!-- Tambahkan mt-5 untuk jarak -->
                        <div class="col-md-6">
                            <div class="tk-info-highlight h-100"> <!-- Gunakan class card TK -->
                                <div class="tk-info-icon bg-gradient-warning"> <!-- Gunakan warna TK -->
                                    <i class="bi bi-calendar2-check text-white"></i>
                                </div>
                                <div class="tk-info-text"> <!-- Gunakan class teks TK -->
                                    <h6 class="fw-bold text-dark mb-1">Tahun Berdiri</h6>
                                    <p class="text-muted mb-0">{{ $tahun_berdiri }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tk-info-highlight h-100"> <!-- Gunakan class card TK -->
                                <div class="tk-info-icon bg-gradient-warning"> <!-- Gunakan warna TK -->
                                    <i class="bi bi-award text-white"></i>
                                </div>
                                <div class="tk-info-text"> <!-- Gunakan class teks TK -->
                                    <h6 class="fw-bold text-dark mb-1">Kepala Sekolah</h6>
                                    <p class="text-muted mb-0">{{ $kepala_sekolah }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tk-info-highlight h-100"> <!-- Gunakan class card TK -->
                                <div class="tk-info-icon bg-gradient-warning"> <!-- Gunakan warna TK -->
                                    <i class="bi bi-clock-history text-white"></i>
                                </div>
                                <div class="tk-info-text"> <!-- Gunakan class teks TK -->
                                    <h6 class="fw-bold text-dark mb-1">Jam Belajar</h6>
                                    <p class="text-muted mb-0">{{ $jam_belajar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tk-info-highlight h-100"> <!-- Gunakan class card TK -->
                                <div class="tk-info-icon bg-gradient-warning"> <!-- Gunakan warna TK -->
                                    <i class="bi bi-telephone-forward text-white"></i>
                                </div>
                                <div class="tk-info-text"> <!-- Gunakan class teks TK -->
                                    <h6 class="fw-bold text-dark mb-1">Kontak</h6>
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
                <span class="badge bg-primary-soft text-primary rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-compass me-1"></i> Visi & Misi
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Visi Misi TK Baitul Insan</h2>
                <p class="text-muted fs-5">Panduan dalam menyelenggarakan pendidikan dasar Islam terpadu</p>
            </div>

            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="sd-vision-card">
                        <div class="mb-4 text-center">
                            <div class="sd-icon-circle bg-primary-soft mb-4">
                                <i class="bi bi-eye text-primary fs-2"></i>
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
                            <div class="sd-icon-circle bg-primary-soft mb-4">
                                <i class="bi bi-bullseye text-primary fs-2"></i>
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

    <!-- Visi Misi -->
    <section class="py-lg-10 bg-light py-8" id="visi-misi">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-compass me-1"></i> Visi & Misi
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Visi Misi TK Baitul Insan</h2>
                <p class="text-muted fs-5">Panduan dalam menyelenggarakan pendidikan anak usia dini</p>
            </div>

            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="tk-vision-card">
                        <div class="mb-4 text-center">
                            <div class="tk-icon-circle bg-warning-soft mb-4">
                                <i class="bi bi-eye text-warning fs-2"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-4">Visi</h3>
                        </div>
                        <div class="tk-vision-content">
                            <p class="fs-4 fw-semibold text-dark mb-0">{{ $visi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tk-mission-card">
                        <div class="mb-4 text-center">
                            <div class="tk-icon-circle bg-warning-soft mb-4">
                                <i class="bi bi-bullseye text-warning fs-2"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-4">Misi</h3>
                        </div>
                        <div class="tk-mission-list">
                            @foreach ($misi as $index => $item)
                                <div class="tk-mission-item">
                                    <span class="tk-mission-number">{{ $index + 1 }}</span>
                                    <div class="tk-mission-text">
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

    <!-- Program Unggulan -->
    <section class="py-lg-10 bg-white py-8" id="program">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-stars me-1"></i> Program
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Program Unggulan TK</h2>
                <p class="text-muted fs-5">Program khusus yang menjadi keunggulan TK Baitul Insan</p>
            </div>

            <div class="row g-4">
                @foreach ($program_unggulan as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="tk-program-card">
                            <div class="tk-icon-circle bg-warning-soft mb-4">
                                <i class="bi bi-balloon-heart text-warning fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">{{ $program }}</h5>
                            <p class="text-muted mb-0">
                                Program terstruktur untuk mengembangkan potensi anak secara optimal
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="py-lg-10 bg-light py-8" id="fasilitas">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-palette me-1"></i> Fasilitas
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Fasilitas Lengkap & Nyaman</h2>
                <p class="text-muted fs-5">Dukung proses belajar dengan fasilitas yang memadai</p>
            </div>

            <div class="row g-4">
                @foreach ($fasilitas as $fasilitas_item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tk-facility-card">
                            <div class="tk-icon-circle bg-warning-soft mx-auto mb-3">
                                <i class="bi bi-check-circle text-warning fs-2"></i>
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
                <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-joystick me-1"></i> Ekstrakurikuler
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Kegiatan Ekstrakurikuler</h2>
                <p class="text-muted fs-5">Pengembangan bakat dan minat di luar jam pelajaran</p>
            </div>

            <div class="row g-4">
                @foreach ($ekstrakurikuler as $ekstra)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tk-extracurricular-card">
                            <div class="tk-icon-circle bg-warning-soft mx-auto mb-3">
                                <i class="bi bi-heart-pulse text-warning fs-2"></i>
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
                        class="badge bg-warning-soft text-warning rounded-pill d-inline-block fw-semibold mb-2 px-4 py-2">
                        <i class="bi bi-camera-fill me-1"></i> Galeri
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-0">Momen Terbaik TK Baitul Insan</h2>
                </div>
                <a href="{{ route('galeri.index', ['kategori' => 'TK']) }}"
                    class="btn btn-outline-warning rounded-pill fw-semibold px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            @if ($galeri->count() > 0)
                <div class="row g-4">
                    @foreach ($galeri as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="tk-gallery-card">
                                <div class="tk-gallery-image">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 h-100 object-fit-cover"
                                        alt="{{ $item->judul }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1516627145497-ae6958d5a0dd?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                    <span class="tk-gallery-badge">{{ $item->kategori }}</span>
                                </div>
                                <div class="tk-gallery-content">
                                    <h6 class="fw-bold text-dark mb-2">{{ Str::limit($item->judul, 40) }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($item->deskripsi, 60) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="tk-icon-circle bg-warning-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-images text-warning fs-1"></i>
                    </div>
                    <h5 class="text-muted">Belum ada galeri untuk TK</h5>
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
                        class="badge bg-warning-soft text-warning rounded-pill d-inline-block fw-semibold mb-2 px-4 py-2">
                        <i class="bi bi-trophy me-1"></i> Prestasi
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-0">Prestasi Siswa TK</h2>
                </div>
                <a href="{{ route('prestasi.index', ['sekolah' => 'TK']) }}"
                    class="btn btn-outline-warning rounded-pill fw-semibold px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            @if ($prestasi->count() > 0)
                <div class="row g-4">
                    @foreach ($prestasi as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="tk-achievement-card">
                                <div class="tk-achievement-image">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 h-100 object-fit-cover"
                                        alt="{{ $item->judul }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                    <span class="tk-achievement-year">{{ $item->tahun }}</span>
                                </div>
                                <div class="tk-achievement-content">
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
                    <div class="tk-icon-circle bg-warning-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-trophy text-warning fs-1"></i>
                    </div>
                    <h5 class="text-muted">Belum ada prestasi untuk TK</h5>
                </div>
            @endif
        </div>
    </section>

    <!-- Staff & Guru TK -->
    <section class="py-lg-10 bg-white py-8" id="staff">
        <div class="container">
            <div class="mb-8 text-center">
                <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                    <i class="bi bi-people-fill me-1"></i> Tenaga Pendidik
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">Staff & Guru TK</h2>
                <p class="text-muted fs-5">Dedikasi dan kompetensi untuk pendidikan terbaik</p>
            </div>

            @php
                // Filter staff berdasarkan kategori untuk TK
                $kepalaYayasanTK = isset($staff)
                    ? $staff->filter(function ($item) {
                        return stripos($item->jabatan, 'Yayasan') !== false ||
                            stripos($item->jabatan, 'Ketua Yayasan') !== false ||
                            stripos($item->jabatan, 'Pimpinan Yayasan') !== false;
                    })
                    : collect();

                $kepalaSekolahTK = isset($staff)
                    ? $staff->filter(function ($item) {
                        return (stripos($item->jabatan, 'TK') !== false ||
                            stripos($item->jabatan, 'Taman Kanak') !== false ||
                            stripos($item->jabatan, 'PAUD') !== false) &&
                            (stripos($item->jabatan, 'Kepala') !== false ||
                                stripos($item->jabatan, 'Kepsek') !== false ||
                                stripos($item->jabatan, 'Kepala Sekolah') !== false);
                    })
                    : collect();

                $guruTK = isset($staff)
                    ? $staff->filter(function ($item) {
                        return stripos($item->jabatan, 'TK') !== false ||
                            stripos($item->jabatan, 'Taman Kanak') !== false ||
                            stripos($item->jabatan, 'PAUD') !== false ||
                            stripos($item->jabatan, 'Guru TK') !== false ||
                            stripos($item->jabatan, 'Wali Kelas') !== false;
                    })
                    : collect();

                $totalStaffTK = $kepalaYayasanTK->count() + $kepalaSekolahTK->count() + $guruTK->count();
            @endphp

            @if ($totalStaffTK > 0)
                <!-- Kepala Yayasan -->
                @if ($kepalaYayasanTK->count() > 0)
                    <div class="mb-8">
                        <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">
                            <i class="bi bi-building text-warning me-2"></i>Pimpinan Yayasan
                        </h3>
                        <div class="row justify-content-center">
                            @foreach ($kepalaYayasanTK as $item)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="tk-leader-card">
                                        <div class="tk-leader-avatar">
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="rounded-circle object-fit-cover border-warning border-4"
                                                width="140" height="140" alt="{{ $item->nama }}"
                                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=f59e0b&color=fff&size=140'">
                                            <div class="tk-leader-badge bg-warning">
                                                <i class="bi bi-award-fill"></i>
                                            </div>
                                        </div>
                                        <div class="tk-leader-content">
                                            <h4 class="fw-bold text-dark mb-2">{{ $item->nama }}</h4>
                                            <p class="text-warning fw-semibold mb-3">{{ $item->jabatan }}</p>

                                            @if (isset($item->jenjang_info))
                                                <span class="badge bg-warning-soft text-warning rounded-pill mb-3">
                                                    {{ $item->jenjang_info }}
                                                </span>
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

                <!-- Kepala Sekolah TK -->
                @if ($kepalaSekolahTK->count() > 0)
                    <div class="mb-8">
                        <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">
                            <i class="bi bi-person-badge text-warning me-2"></i>Kepala Sekolah
                        </h3>
                        <div class="row justify-content-center">
                            @foreach ($kepalaSekolahTK as $item)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="tk-headmaster-card">
                                        <div class="tk-headmaster-avatar">
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="rounded-circle object-fit-cover border-warning border-4"
                                                width="130" height="130" alt="{{ $item->nama }}"
                                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=f59e0b&color=fff&size=130'">
                                            <div class="tk-headmaster-badge bg-warning">
                                                <i class="bi bi-mortarboard-fill"></i>
                                            </div>
                                        </div>
                                        <div class="tk-headmaster-content">
                                            <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
                                            <p class="text-warning fw-semibold mb-3">{{ $item->jabatan }}</p>

                                            @if (isset($item->jenjang_info))
                                                <span class="badge bg-warning-soft text-warning rounded-pill mb-3">
                                                    {{ $item->jenjang_info }}
                                                </span>
                                            @endif

                                            @if ($item->keterangan)
                                                <p class="text-muted small mb-0">{{ Str::limit($item->keterangan, 80) }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Guru TK -->
                @if ($guruTK->count() > 0)
                    <div>
                        <h3 class="fw-bold text-dark border-bottom mb-5 pb-3 text-center">
                            <i class="bi bi-people text-warning me-2"></i>Tim Pengajar TK
                        </h3>
                        <div class="row g-4 justify-content-center">
                            @foreach ($guruTK as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="tk-teacher-card">
                                        <div class="tk-teacher-avatar">
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="rounded-circle object-fit-cover border-3 border-warning"
                                                width="120" height="120" alt="{{ $item->nama }}"
                                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=f59e0b&color=fff&size=120'">
                                        </div>
                                        <div class="tk-teacher-content">
                                            <h6 class="fw-bold text-dark mb-2">{{ $item->nama }}</h6>
                                            <p class="text-warning fw-semibold small mb-2">{{ $item->jabatan }}</p>

                                            @if (isset($item->jenjang_info))
                                                <span class="badge bg-warning-soft text-warning rounded-pill small mb-2">
                                                    {{ $item->jenjang_info }}
                                                </span>
                                            @endif

                                            @if ($item->keterangan)
                                                <p class="text-muted extra-small mb-0">
                                                    {{ Str::limit($item->keterangan, 60) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class="py-5 text-center">
                    <div class="tk-icon-circle bg-warning-soft mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-people text-warning fs-1"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data staff untuk TK</h5>
                </div>
            @endif
        </div>
    </section>

    <!-- Info Pendaftaran -->
    <section class="py-lg-10 bg-light py-8" id="pendaftaran">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-warning-soft text-warning rounded-pill fw-semibold mb-3 px-4 py-2">
                        <i class="bi bi-pencil-square me-1"></i> Pendaftaran
                    </span>
                    <h2 class="display-5 fw-bold text-dark mb-4">Informasi Pendaftaran TK</h2>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="tk-info-highlight">
                                <div class="tk-info-icon bg-gradient-warning">
                                    <i class="bi bi-calendar-week text-white"></i>
                                </div>
                                <div class="tk-info-text">
                                    <h6 class="fw-bold text-dark mb-1">Jam Belajar</h6>
                                    <p class="text-muted mb-0">{{ $jam_belajar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tk-info-highlight">
                                <div class="tk-info-icon bg-gradient-warning">
                                    <i class="bi bi-telephone-outbound text-white"></i>
                                </div>
                                <div class="tk-info-text">
                                    <h6 class="fw-bold text-dark mb-1">Kontak</h6>
                                    <p class="text-muted mb-0">{{ $telepon }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tk-requirements-card">
                        <h5 class="fw-bold text-dark mb-3">Persyaratan Pendaftaran</h5>
                        <ul class="tk-requirements-list">
                            @if (isset($persyaratan) && is_array($persyaratan))
                                @foreach ($persyaratan as $req)
                                    <li class="tk-requirements-item">
                                        <i class="bi bi-check-circle text-warning"></i>
                                        <span>{{ $req }}</span>
                                    </li>
                                @endforeach
                            @else
                                <!-- Fallback jika data persyaratan tidak tersedia -->
                                @foreach (['Usia minimal 4 tahun', 'Fotokopi akta kelahiran', 'Fotokopi kartu keluarga', 'Pas foto 3x4 (2 lembar)', 'Surat keterangan sehat dari dokter'] as $requirement)
                                    <li class="tk-requirements-item">
                                        <i class="bi bi-check-circle text-warning"></i>
                                        <span>{{ $requirement }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tk-cta-card">
                        <div class="tk-cta-icon bg-warning-soft text-warning rounded-circle mx-auto mb-4"
                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-plus fs-1"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Siap Mendaftar?</h3>
                        <p class="text-muted mb-4">
                            Segera bergabung bersama kami di TK IT Baitul Insan dan berikan pendidikan terbaik untuk
                            putra-putri Anda.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('daftar-sekarang') }}"
                                class="btn btn-warning btn-lg rounded-pill fw-semibold flex-fill px-4 py-3">
                                <i class="bi bi-pencil me-2"></i>Daftar Sekarang
                            </a>
                            <a href="{{ route('alur-pendaftaran') }}"
                                class="btn btn-outline-warning btn-lg rounded-pill fw-semibold flex-fill px-4 py-3">
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
        /* --- TK Specific Styles --- */
        .tk-hero-section {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
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

        /* Global Spacing */
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

        /* Accreditation Badge */
        .tk-accreditation-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            color: white;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.25);
        }

        .tk-accreditation-badge i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
        }

        /* Gradient Colors */
        .bg-gradient-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%) !important;
        }

        /* Info Cards */
        .tk-info-card {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .tk-info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.15);
            border-color: transparent;
        }

        .tk-info-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
        }

        .tk-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.15);
        }

        /* Vision & Mission Cards */
        .tk-vision-card,
        .tk-mission-card {
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

        .tk-vision-card::before,
        .tk-mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .tk-vision-card:hover,
        .tk-mission-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(245, 158, 11, 0.15);
        }

        .tk-vision-content {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            border: 1px solid rgba(245, 158, 11, 0.1);
        }

        .tk-mission-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(0, 35, 102, 0.1);
        }

        .tk-mission-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .tk-mission-number {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
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
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
        }

        /* Program Cards */
        .tk-program-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            height: 100%;
            text-align: center;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tk-program-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.15);
            border-color: transparent;
        }

        /* Facility & Extracurricular Cards */
        .tk-facility-card,
        .tk-extracurricular-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            height: 100%;
            text-align: center;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s ease;
        }

        .tk-facility-card:hover,
        .tk-extracurricular-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.12);
            border-color: transparent;
            background: linear-gradient(135deg, #ffffff 0%, #fefce8 100%);
        }

        /* Gallery & Achievement Cards */
        .tk-gallery-card,
        .tk-achievement-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tk-gallery-card:hover,
        .tk-achievement-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-color: transparent;
        }

        .tk-gallery-image,
        .tk-achievement-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .tk-gallery-image img,
        .tk-achievement-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tk-gallery-card:hover .tk-gallery-image img,
        .tk-achievement-card:hover .tk-achievement-image img {
            transform: scale(1.1);
        }

        .tk-gallery-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .tk-achievement-year {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.3);
        }

        .tk-gallery-content,
        .tk-achievement-content {
            padding: 2rem;
        }

        /* Staff Cards */
        .tk-staff-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .tk-staff-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .tk-staff-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(245, 158, 11, 0.15);
            border-color: transparent;
        }

        .tk-staff-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 2rem;
            border: 4px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .tk-staff-card:hover .tk-staff-avatar {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Registration Form */
        .tk-registration-form {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.1);
            position: relative;
            overflow: hidden;
        }

        .tk-registration-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .tk-requirements-card {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
            border: 2px solid rgba(245, 158, 11, 0.2);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .tk-requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tk-requirements-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 12px;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s ease;
        }

        .tk-requirements-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.1);
        }

        .tk-requirements-item i {
            margin-right: 1rem;
            font-size: 1.25rem;
            color: #f59e0b;
        }

        /* Info Highlight */
        .tk-info-highlight {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s ease;
        }

        .tk-info-highlight:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.1);
            border-color: transparent;
        }

        /* Animations */
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

        /* Colors */
        .bg-warning-soft {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%) !important;
        }

        .text-warning {
            color: #f59e0b !important;
        }

        .text-dark {
            color: #002366 !important;
        }

        .text-dark-75 {
            color: rgba(0, 35, 102, 0.85) !important;
        }

        .bg-light {
            background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%) !important;
        }

        /* Sticky Navigation */
        .sticky-nav {
            position: sticky;
            top: 70px;
            z-index: 1000;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        }

        .nav-scroller {
            position: relative;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
            padding: 1rem 2rem;
            color: #002366;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px 8px 0 0;
            margin: 0 0.25rem;
        }

        .nav-underline .nav-link:hover {
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.05);
            border-bottom-color: #f59e0b;
        }

        .nav-underline .nav-link.active {
            color: #f59e0b;
            border-bottom-color: #f59e0b;
            background: rgba(245, 158, 11, 0.08);
        }

        /* Form Elements */
        .form-control,
        .form-select {
            border: 1px solid rgba(245, 158, 11, 0.2);
            transition: all 0.3s ease;
            padding: 0.75rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        .btn-outline-warning {
            border: 2px solid #f59e0b;
            color: #f59e0b;
            transition: all 0.3s ease;
        }

        .btn-outline-warning:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .tk-icon-circle {
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

            .tk-vision-card,
            .tk-mission-card {
                padding: 2rem;
            }

            .tk-registration-form {
                padding: 2rem;
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

            .tk-staff-card,
            .tk-gallery-card,
            .tk-achievement-card {
                padding: 1.5rem;
            }

            .tk-gallery-image,
            .tk-achievement-image {
                height: 200px;
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

            .tk-info-card {
                padding: 1.25rem;
            }

            .tk-icon-circle {
                width: 60px;
                height: 60px;
            }

            .tk-icon-circle i {
                font-size: 1.5rem;
            }
        }

        /* ================= STICKY NAV ================= */

        .sticky-nav {
            position: sticky;
            top: 72px;
            /* sesuaikan dengan tinggi header */
            z-index: 1020;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
        }

        /* Wrapper scroll */
        .nav-scroller {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .nav-scroller::-webkit-scrollbar {
            display: none;
        }

        /* Nav utama */
        .sticky-nav .nav {
            flex-wrap: nowrap;
            gap: .5rem;
        }

        /* Item nav */
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

        /* Icon */
        .sticky-nav .nav-link i {
            font-size: 1rem;
            opacity: .85;
        }

        /* Hover */
        .sticky-nav .nav-link:hover {
            background: rgba(13, 110, 253, .08);
            color: #0d6efd;
        }

        /* Active (pakai :target-friendly) */
        .sticky-nav .nav-link.active,
        .sticky-nav .nav-link:focus {
            background: #f59e0b;
            color: #fff;
        }

        .sticky-nav .nav-link.active i,
        .sticky-nav .nav-link:focus i {
            color: #fff;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {
            .sticky-nav {
                top: 64px;
            }

            .sticky-nav .nav {
                justify-content: flex-start;
            }
        }

        /* ================= TK STAFF CARDS ================= */

        /* Leader Card (Kepala Yayasan TK) */
        .tk-leader-card {
            background: linear-gradient(135deg, #ffffff 0%, #fefce8 100%);
            border-radius: 24px;
            padding: 2.5rem;
            text-align: center;
            border: 2px solid rgba(245, 158, 11, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.1);
            height: 100%;
        }

        .tk-leader-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.2);
            border-color: #f59e0b;
        }

        .tk-leader-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .tk-leader-avatar {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 1.5rem;
        }

        .tk-leader-avatar img {
            width: 140px;
            height: 140px;
            border: 4px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .tk-leader-badge {
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
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
        }

        /* Headmaster Card (Kepala Sekolah TK) */
        .tk-headmaster-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 2px solid rgba(245, 158, 11, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.1);
            height: 100%;
        }

        .tk-headmaster-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.15);
            border-color: #f59e0b;
        }

        .tk-headmaster-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }

        .tk-headmaster-avatar {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .tk-headmaster-avatar img {
            width: 130px;
            height: 130px;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .tk-headmaster-badge {
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
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        /* Teacher Card (Guru TK) */
        .tk-teacher-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(245, 158, 11, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .tk-teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.1);
            border-color: transparent;
            background: linear-gradient(135deg, #ffffff 0%, #fefce8 100%);
        }

        .tk-teacher-avatar {
            width: 130px;
            height: 130px;
            margin: 0 auto 1rem;
        }

        .tk-teacher-avatar img {
            width: 120px;
            height: 120px;
            border: 3px solid white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .tk-teacher-content h6 {
            font-size: 1.1rem;
            min-height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tk-teacher-content p.text-warning {
            font-size: 0.9rem;
            min-height: 2.5rem;
        }

        /* --- CSS untuk Profil Sekolah (bagian isi konten) - TK --- */
        .tk-sejarah-content {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            /* Padding konsisten dengan tentang.blade.php */
            box-shadow: 0 10px 30px rgba(0, 35, 102, 0.08);
            /* Gaya shadow dari tentang.blade.php */
            margin-bottom: 30px;
            /* Jarak ke konten berikutnya */
        }

        /* Styling untuk gambar dalam konten sejarah/profil - TK */
        .tk-sejarah-content img {
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

        .tk-sejarah-content img:hover {
            transform: scale(1.02);
            /* Sedikit zoom saat hover */
        }

        /* Layout khusus untuk gambar + teks side by side (jika ada di isi) - TK */
        .tk-sejarah-content .image-text-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 30px;
            /* Jarak antar elemen */
            margin: 30px 0;
            /* Jarak atas/bawah */
        }

        .tk-sejarah-content .image-text-wrapper img {
            flex: 0 0 300px;
            /* Lebar tetap 300px */
            max-width: 100%;
            /* Tetap responsif */
        }

        .tk-sejarah-content .image-text-wrapper .text-content {
            flex: 1;
            /* Sisa ruang */
            min-width: 300px;
            /* Lebar minimum */
        }

        /* Gaya tambahan untuk thumbnail di atas konten - TK */
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
                '.tk-program-card, .tk-facility-card, .tk-extracurricular-card, .tk-gallery-card, .tk-achievement-card, .tk-staff-card'
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
