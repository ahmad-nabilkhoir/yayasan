@extends('layouts.app')

@section('title', 'PPDB - Penerimaan Peserta Didik Baru')

@section('content')
    <div class="container py-5">

        {{-- ================= HERO ================= --}}
        <section class="mb-6 text-center">
            <h1 class="bg-title-blue fs-2 mb-2 shadow-sm">
                Penerimaan Peserta Didik Baru
            </h1>

            <p class="text-muted fs-5 fw-medium mx-auto" style="max-width:720px">
                Membangun generasi berakhlak mulia, cerdas, dan mandiri melalui pendidikan berkualitas berbasis nilai Islam.
            </p>

            <div class="d-flex justify-content-center mt-4 flex-wrap gap-3">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                    <i class="bi bi-check-circle me-1"></i>Pendaftaran Dibuka
                </span>
                <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2">
                    <i class="bi bi-calendar-event me-1"></i>Kuota Terbatas
                </span>
            </div>
        </section>

        {{-- ================= KEUNGGULAN ================= --}}
        <section class="mb-6">
            <div class="mb-5 text-center">
                <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
                <p class="text-muted">Komitmen kami dalam memberikan pendidikan terbaik</p>
            </div>

            <div class="row g-4 text-center">
                @php
                    $features = [
                        [
                            'icon' => 'stars',
                            'color' => 'warning',
                            'title' => 'Kurikulum Terpadu',
                            'desc' => 'Kurikulum nasional terintegrasi nilai keislaman.',
                        ],
                        [
                            'icon' => 'shield-check',
                            'color' => 'success',
                            'title' => 'Lingkungan Aman',
                            'desc' => 'Fasilitas nyaman dan aman bagi peserta didik.',
                        ],
                        [
                            'icon' => 'people',
                            'color' => 'primary',
                            'title' => 'Pengajar Profesional',
                            'desc' => 'Tenaga pendidik berpengalaman dan berdedikasi.',
                        ],
                    ];
                @endphp

                @foreach ($features as $f)
                    <div class="col-md-4">
                        <div class="card h-100 rounded-4 feature-card border-0 p-4 shadow-sm">
                            <i class="bi bi-{{ $f['icon'] }} text-{{ $f['color'] }} display-5 mb-3"></i>
                            <h5 class="fw-bold">{{ $f['title'] }}</h5>
                            <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ================= JENJANG ================= --}}
        <section class="mb-6">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 rounded-4 jenjang-card border-0 p-4 shadow-sm">
                        <div class="icon-circle bg-soft-primary text-primary mb-3">
                            <i class="bi bi-puzzle fs-2"></i>
                        </div>
                        <h4 class="fw-bold">Jenjang TK</h4>
                        <p class="text-muted">
                            Fokus pada motorik, kreativitas, dan pembentukan karakter islami melalui metode belajar
                            menyenangkan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 rounded-4 jenjang-card border-0 p-4 shadow-sm">
                        <div class="icon-circle bg-soft-success text-success mb-3">
                            <i class="bi bi-book fs-2"></i>
                        </div>
                        <h4 class="fw-bold">Jenjang SD</h4>
                        <p class="text-muted">
                            Penguatan akademik, kemandirian belajar, dan dasar hafalan Al-Qur’an.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= JADWAL ================= --}}
        <section class="mb-6">
            <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                <div class="card-header bg-primary px-4 py-3 text-white">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-calendar-event me-2"></i>Jadwal Pendaftaran
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table align-middle">
                        <tbody>
                            <tr>
                                <td class="fw-semibold px-4">Gelombang I</td>
                                <td>Januari – Maret 2024</td>
                                <td class="px-4 text-end">
                                    <span class="badge bg-success">Dibuka</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold px-4">Gelombang II</td>
                                <td>April – Juni 2024</td>
                                <td class="px-4 text-end">
                                    <span class="badge bg-secondary">Menyusul</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- ================= INFORMASI PEMBAYARAN ================= --}}
        <section class="mb-6">
            <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                <div class="card-header bg-success px-4 py-3 text-white">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-wallet2 me-2"></i>Informasi Biaya Pendidikan
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="px-4">Jenjang</th>
                                <th scope="col">Uang Gedung</th>
                                <th scope="col">SPP Bulanan</th>
                                <th scope="col">Lainnya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold px-4">TK</td>
                                <td>Rp 2.500.000</td>
                                <td>Rp 450.000</td>
                                <td>
                                    <span class="badge bg-info-subtle text-info">Seragam: Rp 350.000</span><br>
                                    <small class="text-muted">Buku & ATK: Rp 200.000</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold px-4">SD</td>
                                <td>Rp 4.000.000</td>
                                <td>Rp 650.000</td>
                                <td>
                                    <span class="badge bg-info-subtle text-info">Seragam: Rp 450.000</span><br>
                                    <small class="text-muted">Buku & Field Trip: Rp 300.000</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light small text-muted px-4 py-3">
                    <i class="bi bi-info-circle me-1"></i>
                    Pembayaran dapat dicicil. Diskon 10% untuk pendaftaran Gelombang I.
                </div>
            </div>
        </section>

        {{-- ================= SYARAT & FAQ ================= --}}
        <section class="mb-6">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card h-100 rounded-4 border-0 p-4 shadow-sm">
                        <h4 class="fw-bold mb-4">Persyaratan Pendaftaran</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach (['Akta & KK', 'Pas Foto 3x4', 'KTP Orang Tua', 'Formulir Pendaftaran', 'Ijazah/Rapor (jika ada)'] as $item)
                                <li class="d-flex mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-3"></i>
                                    <span class="text-muted">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100 rounded-4 border-0 p-4 shadow-sm">
                        <h4 class="fw-bold mb-4">Pertanyaan Umum</h4>
                        <div class="accordion accordion-flush">
                            <div class="accordion-item">
                                <button class="accordion-button collapsed fw-semibold px-0" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Apakah ada biaya pendaftaran?
                                </button>
                                <div id="faq1" class="accordion-collapse collapse">
                                    <div class="accordion-body text-muted small px-0">
                                        Ya, biaya mencakup administrasi dan observasi awal.
                                    </div>
                                </div>
                                <button class="accordion-button collapsed fw-semibold px-0" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Apakah bisa mendaftar online?
                                </button>
                                <div id="faq1" class="accordion-collapse collapse">
                                    <div class="accordion-body text-muted small px-0">
                                        Ya, sangat bisa mendaftar online dan dapat diakses dari mana saja.
                                    </div>
                                </div>
                                <button class="accordion-button collapsed fw-semibold px-0" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Apakah bisa Pembayaran online
                                </button>
                                <div id="faq1" class="accordion-collapse collapse">
                                    <div class="accordion-body text-muted small px-0">
                                        Ya, bisa dilakukan melalui bank transfer atau e-wallet.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= CTA ================= --}}
        <section class="cta-ppdb rounded-4 p-5 text-center text-white shadow-lg">
            <h2 class="fw-bold mb-2">Daftarkan Putra–Putri Anda Sekarang</h2>
            <p class="fs-5 mb-4 opacity-75">
                Tempat terbatas • Pendidikan terbaik dimulai hari ini
            </p>

            <!-- TOMBOL YANG BENAR: Menggunakan route Laravel -->
            <a href="{{ route('daftar-sekarang') }}" class="btn btn-light btn-lg rounded-pill fw-semibold mb-3 px-5">
                <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
            </a>

            <p class="text-white-50 small mt-3">
                <i class="bi bi-info-circle me-1"></i>
                Isi formulir pendaftaran secara online
            </p>
        </section>

    </div>

    {{-- ================= STYLE ================= --}}
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

        .mb-6 {
            margin-bottom: 4rem
        }

        .bg-soft-primary {
            background: rgba(13, 110, 253, .1)
        }

        .bg-soft-success {
            background: rgba(25, 135, 84, .1)
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-card,
        .jenjang-card {
            transition: .3s ease;
        }

        .feature-card:hover,
        .jenjang-card:hover {
            transform: translateY(-8px);
        }

        .cta-ppdb {
            background: linear-gradient(135deg, #2547bc, #3b82f6);
        }
    </style>
@endsection
