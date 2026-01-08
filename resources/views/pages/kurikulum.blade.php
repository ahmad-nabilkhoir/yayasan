@extends('layouts.app')

@section('title', 'Kurikulum')

@section('content')
    <div class="container py-5">

        {{-- Header Judul --}}
        <div class="mb-5 text-center">
            <h1 class="bg-title-blue fs-2 mb-2 shadow-sm">
                Kurikulum
            </h1>
            <p class="text-muted fs-5 fw-medium">
                Informasi kurikulum Yayasan Baitul Insan
            </p>
        </div>

        {{-- BAGIAN 1: KURIKULUM TK IT --}}
        <div class="card mb-5 border-0 shadow-sm">
            <div class="card-header border-bottom-0 bg-white px-4 pt-4">
                <h2 class="fw-bold text-primary">Kurikulum TK IT Baitul Insan</h2>
            </div>
            <div class="card-body px-4 pb-4">
                <p class="text-muted mb-4">
                    Kurikulum TK Baitul Insan dirancang untuk menstimulasi tumbuh kembang anak secara optimal melalui
                    pembelajaran yang menyenangkan, aktif, dan sesuai tahapan usia. Program pendidikan mengintegrasikan
                    kurikulum nasional dengan nilai-nilai Islam untuk membentuk karakter anak sejak dini.
                </p>

                <div class="row g-4">
                    {{-- Fokus Pengembangan (Kiri) --}}
                    <div class="col-lg-7">
                        <h4 class="fw-bold border-bottom mb-3 pb-2">Fokus Pengembangan</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-dark">Pengembangan Nilai Agama & Moral (NAM)</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Pembiasaan doa harian</li>
                                    <li>Pengenalan akhlak baik</li>
                                    <li>Hafalan surat pendek</li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-dark">Kognitif</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Pengenalan angka</li>
                                    <li>Pengenalan pola dan bentuk</li>
                                    <li>Aktivitas eksplorasi dan pemecahan masalah sederhana</li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-dark">Bahasa</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Bercerita</li>
                                    <li>Menyebutkan huruf hijaiyah dan latin</li>
                                    <li>Melatih kemampuan komunikasi</li>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-dark">Motorik Halus & Kasar</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Menggunting dan mewarnai</li>
                                    <li>Senam dan permainan fisik</li>
                                    <li>Koordinasi tubuh</li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <h6 class="fw-bold text-dark">Sosial Emosional</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Belajar antre, Kerjasama dalam kelompok, Mengelola emosi</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Program Unggulan TK (Kanan) --}}
                    <div class="col-lg-5">
                        <div class="bg-light rounded-3 h-100 p-4">
                            <h4 class="fw-bold text-success mb-3">Program Unggulan TK</h4>
                            <ul class="text-secondary">
                                <li class="mb-2">Hafalan Juz 30 (surat pendek)</li>
                                <li class="mb-2">Pembiasaan salat dhuha & salat harian</li>
                                <li class="mb-2">Kegiatan tematik mingguan (theme of the month)</li>
                                <li class="mb-2">Outing Class Edukatif</li>
                                <li>Fun cooking (cooking day / market day)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: KURIKULUM SD IT --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom-0 bg-white px-4 pt-4">
                <h2 class="fw-bold text-primary">Kurikulum SD IT Baitul Insan</h2>
            </div>
            <div class="card-body px-4 pb-4">
                <p class="text-muted mb-4">
                    Kurikulum SD IT Baitul Insan mengintegrasikan Kurikulum Merdeka dengan penguatan pendidikan Islam.
                    Metode pembelajaran difokuskan pada kompetensi akademik, pembentukan karakter, dan pengembangan
                    bakat minat siswa.
                </p>

                {{-- Mata Pelajaran --}}
                <div class="mb-5">
                    <h4 class="fw-bold border-bottom mb-4 pb-2">Mata Pelajaran</h4>
                    <div class="row g-4">
                        {{-- Kolom 1 --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <strong class="d-block text-dark">Al-Qur'an & Tahfidz</strong>
                                <span class="small text-muted">Target hafalan per jenjang, Pembiasaan murojaah
                                    harian.</span>
                            </div>
                            <div class="mb-3">
                                <strong class="d-block text-dark">PAI & Akhlak</strong>
                                <span class="small text-muted">Fiqih dasar, Sirah Nabawiyah, Adab & Akhlak.</span>
                            </div>
                            <div class="mb-3">
                                <strong class="d-block text-dark">Matematika</strong>
                                <span class="small text-muted">Numerasi, Pemecahan Masalah.</span>
                            </div>
                        </div>
                        {{-- Kolom 2 --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <strong class="d-block text-dark">Bahasa Indonesia</strong>
                                <span class="small text-muted">Membaca & Menulis, Pemahaman bacaan, Keterampilan
                                    presentasi.</span>
                            </div>
                            <div class="mb-3">
                                <strong class="d-block text-dark">Bahasa Inggris</strong>
                                <span class="small text-muted">Vocabulary dasar, Percakapan sederhana.</span>
                            </div>
                            <div class="mb-3">
                                <strong class="d-block text-dark">IPAS (Ilmu Pengetahuan Alam & Sosial)</strong>
                                <span class="small text-muted">Eksperimen sains, Observasi lingkungan.</span>
                            </div>
                        </div>
                        {{-- Kolom 3 --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <strong class="d-block text-dark">PJOK</strong>
                                <span class="small text-muted">Senam, Olahraga dasar, Kesehatan.</span>
                            </div>
                            <div class="mb-3">
                                <strong class="d-block text-dark">Seni Budaya</strong>
                                <span class="small text-muted">Menggambar, Kriya, Seni musik.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Program Unggulan SD --}}
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 h-100 p-4">
                            <h5 class="fw-bold text-success mb-3">Program Unggulan SD IT</h5>
                            <ul class="small text-secondary mb-0">
                                <li class="mb-2">Tahfidz (Program bertahap sesuai jenjang)</li>
                                <li class="mb-2">Literasi dan Numerasi Harian</li>
                                <li class="mb-2">Ekstrakurikuler (Taekwondo, Silat, Pramuka, Sains Club, dll)</li>
                                <li class="mb-2">Character Building & Pembiasaan Akhlak</li>
                                <li class="mb-2">Market Day / Entrepreneur Day</li>
                                <li>Outing Class tematik</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Penekanan Nilai --}}
                    <div class="col-md-6">
                        <div class="rounded-3 h-100 border p-4">
                            <h5 class="fw-bold text-primary mb-3">Penekanan Nilai & Karakter</h5>

                            <strong class="d-block text-dark small mt-2">Nilai Profetik (Kenabian)</strong>
                            <p class="small text-muted mb-2">Shidiq, Amanah, Tabligh, Fathanah.</p>

                            <strong class="d-block text-dark small mt-2">Pembiasaan Ibadah</strong>
                            <p class="small text-muted mb-2">Shalat dhuha, Dzikir pagi, Shalat dzuhur berjamaah, Adab masuk
                                kelas.</p>

                            <strong class="d-block text-dark small mt-2">Lingkungan Belajar</strong>
                            <p class="small text-muted mb-0">Aktif, kolaboratif, dan menyenangkan. Menghargai keberagaman.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
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
    </style>
@endsection
