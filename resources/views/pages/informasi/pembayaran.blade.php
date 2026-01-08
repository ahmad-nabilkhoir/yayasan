@extends('layouts.app')

@section('title', 'Informasi Pembayaran')

@section('content')
    <div class="container py-5">

        {{-- Header Judul --}}
        <div class="mb-5 text-center">
            <div class="mb-4">
                <h2 class="bg-title-blue fs-2 mb-2 shadow-sm">
                    Pembayaran
                </h2>
            </div>
            <p class="text-muted fs-5 fw-medium mx-auto" style="max-width: 700px;">
                Informasi mengenai ketentuan, metode, dan alur pembayaran di Yayasan Al-Ihsan.
                Seluruh transaksi dilakukan melalui kanal resmi yang telah ditentukan pihak sekolah.
            </p>
            <div class="d-flex justify-content-center mt-4 flex-wrap gap-3">
                <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2">
                    <i class="bi bi-shield-check me-1"></i>Aman & Terpercaya
                </span>
                <span class="badge bg-soft-success text-success rounded-pill px-3 py-2">
                    <i class="bi bi-clock-history me-1"></i>Transparan
                </span>
                <span class="badge bg-soft-info text-info rounded-pill px-3 py-2">
                    <i class="bi bi-wallet2 me-1"></i>Metode Bervariasi
                </span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- BAGIAN 1: JENIS PEMBAYARAN --}}
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-soft-primary text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-0">Jenis Pembayaran</h3>
                    </div>

                    <div class="row g-4">
                        @php
                            $jenisPembayaran = [
                                [
                                    'icon' => 'bi-file-earmark-text',
                                    'color' => 'primary',
                                    'title' => 'Biaya Pendaftaran',
                                    'desc' => 'Meliputi administrasi awal saat calon siswa melakukan pendaftaran.',
                                ],
                                [
                                    'icon' => 'bi-building',
                                    'color' => 'success',
                                    'title' => 'Biaya Uang Pangkal / Dana Pengembangan',
                                    'desc' => 'Dibayarkan satu kali saat masuk sebagai peserta didik baru.',
                                ],
                                [
                                    'icon' => 'bi-calendar-month',
                                    'color' => 'info',
                                    'title' => 'SPP Bulanan',
                                    'desc' => 'Pembayaran rutin setiap bulan untuk operasional pendidikan.',
                                ],
                                [
                                    'icon' => 'bi-person-badge',
                                    'color' => 'warning',
                                    'title' => 'Seragam & Perlengkapan',
                                    'desc' => 'Biaya pembelian seragam sekolah, atribut, dan perlengkapan belajar.',
                                ],
                                [
                                    'icon' => 'bi-people',
                                    'color' => 'purple',
                                    'title' => 'Kegiatan & Ekstrakurikuler',
                                    'desc' => 'Biaya kegiatan tahunan, wisata edukasi, pramuka, dan ekstrakurikuler.',
                                ],
                                [
                                    'icon' => 'bi-book',
                                    'color' => 'danger',
                                    'title' => 'Buku & Modul Pembelajaran',
                                    'desc' => 'Biaya pembelian buku paket dan lembar kerja siswa.',
                                ],
                                [
                                    'icon' => 'bi-clipboard-check',
                                    'color' => 'secondary',
                                    'title' => 'Ujian / Penilaian Akhir',
                                    'desc' => 'Biaya untuk pelaksanaan PAS/PAT (jika ada kebijakan).',
                                ],
                            ];
                        @endphp

                        @foreach ($jenisPembayaran as $item)
                            <div class="col-md-6">
                                <div class="card h-100 hover-lift border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-start">
                                            <div
                                                class="rounded-circle bg-soft-{{ $item['color'] }} d-flex align-items-center justify-content-center me-3 p-3">
                                                <i class="bi {{ $item['icon'] }} text-{{ $item['color'] }} fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-2">{{ $item['title'] }}</h6>
                                                <p class="text-muted small mb-0">{{ $item['desc'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- BAGIAN 2: METODE PEMBAYARAN --}}
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-soft-success text-success rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-0">Metode Pembayaran</h3>
                    </div>

                    <div class="accordion" id="accordionPembayaran">

                        {{-- 1. Transfer Bank --}}
                        <div class="accordion-item rounded-3 mb-3 overflow-hidden border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold fs-5 py-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#metodeTransfer" aria-expanded="true"
                                    style="background-color: #f8f9fa;">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-primary text-primary rounded-circle me-3 p-2">
                                            <i class="bi bi-bank"></i>
                                        </div>
                                        <div class="text-start">
                                            <div class="fs-6 text-muted">METODE 1</div>
                                            <div class="fw-bold text-dark">Pembayaran Transfer Bank</div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="metodeTransfer" class="accordion-collapse show collapse"
                                data-bs-parent="#accordionPembayaran">
                                <div class="accordion-body">
                                    <p class="text-muted mb-3">Pembayaran dapat dilakukan melalui bank berikut:</p>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="card bg-soft-primary border-0">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-soft-primary rounded-circle me-3 p-2">
                                                            <i class="bi bi-building text-primary"></i>
                                                        </div>
                                                        <h6 class="fw-bold text-dark mb-0">Bank BSI</h6>
                                                    </div>
                                                    <ul class="list-unstyled small mb-0">
                                                        <li class="mb-2">
                                                            <i class="bi bi-credit-card text-primary me-2"></i>
                                                            <span class="text-muted">No. Rekening:</span>
                                                            <span class="fw-bold text-dark">1234 5678 90</span>
                                                        </li>
                                                        <li>
                                                            <i class="bi bi-person text-primary me-2"></i>
                                                            <span class="text-muted">Atas Nama:</span>
                                                            <span class="fw-bold text-dark">Yayasan Al-Ihsan</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card bg-soft-success border-0">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-soft-success rounded-circle me-3 p-2">
                                                            <i class="bi bi-building text-success"></i>
                                                        </div>
                                                        <h6 class="fw-bold text-dark mb-0">Bank BRI</h6>
                                                    </div>
                                                    <ul class="list-unstyled small mb-0">
                                                        <li class="mb-2">
                                                            <i class="bi bi-credit-card text-success me-2"></i>
                                                            <span class="text-muted">No. Rekening:</span>
                                                            <span class="fw-bold text-dark">0987 6543 21</span>
                                                        </li>
                                                        <li>
                                                            <i class="bi bi-person text-success me-2"></i>
                                                            <span class="text-muted">Atas Nama:</span>
                                                            <span class="fw-bold text-dark">Yayasan Al-Ihsan</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-soft-info mt-4 border-0">
                                        <div class="d-flex">
                                            <i class="bi bi-info-circle text-info fs-5 me-3"></i>
                                            <div>
                                                <strong class="text-dark">Catatan Penting:</strong>
                                                <ul class="small text-muted mb-0 mt-2">
                                                    <li>Gunakan berita transfer: <strong class="text-dark">Nama Siswa -
                                                            Kelas - Jenis Pembayaran</strong></li>
                                                    <li>Contoh: <span class="text-dark">Aisyah - 2A - SPP Januari</span>
                                                    </li>
                                                    <li>Simpan bukti transfer untuk verifikasi</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. Tunai di Tata Usaha --}}
                        <div class="accordion-item rounded-3 mb-3 overflow-hidden border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold fs-5 py-3" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#metodeTunai"
                                    style="background-color: #f8f9fa;">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-success text-success rounded-circle me-3 p-2">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                        <div class="text-start">
                                            <div class="fs-6 text-muted">METODE 2</div>
                                            <div class="fw-bold text-dark">Pembayaran Tunai di Tata Usaha</div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="metodeTunai" class="accordion-collapse collapse"
                                data-bs-parent="#accordionPembayaran">
                                <div class="accordion-body">
                                    <div class="card bg-soft-success border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold text-dark mb-3">
                                                            <i class="bi bi-clock text-success me-2"></i>
                                                            Jam Pelayanan
                                                        </h6>
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="mb-2">
                                                                <i class="bi bi-check-circle text-success me-2"></i>
                                                                <span class="text-dark">Senin – Jumat</span>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-check-circle text-success me-2"></i>
                                                                <span class="text-dark">Pukul 08.00 – 14.00 WIB</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold text-dark mb-3">
                                                            <i class="bi bi-receipt text-success me-2"></i>
                                                            Bukti Pembayaran
                                                        </h6>
                                                        <p class="text-muted small mb-0">
                                                            <i class="bi bi-check-circle text-success me-2"></i>
                                                            Orang tua akan menerima kuitansi resmi setelah pembayaran.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. Melalui Wali Kelas --}}
                        <div class="accordion-item rounded-3 mb-3 overflow-hidden border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold fs-5 py-3" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#metodeWaliKelas"
                                    style="background-color: #f8f9fa;">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-info text-info rounded-circle me-3 p-2">
                                            <i class="bi bi-person-check"></i>
                                        </div>
                                        <div class="text-start">
                                            <div class="fs-6 text-muted">METODE 3</div>
                                            <div class="fw-bold text-dark">Pembayaran Melalui Wali Kelas</div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="metodeWaliKelas" class="accordion-collapse collapse"
                                data-bs-parent="#accordionPembayaran">
                                <div class="accordion-body">
                                    <div class="card bg-soft-info border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold text-dark mb-3">
                                                            <i class="bi bi-list-check text-info me-2"></i>
                                                            Jenis Pembayaran
                                                        </h6>
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="mb-2">
                                                                <i class="bi bi-check-circle text-info me-2"></i>
                                                                <span class="text-dark">Kegiatan kelas</span>
                                                            </li>
                                                            <li class="mb-2">
                                                                <i class="bi bi-check-circle text-info me-2"></i>
                                                                <span class="text-dark">Ekstrakurikuler tertentu</span>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-check-circle text-info me-2"></i>
                                                                <span class="text-dark">Iuran seragam tambahan</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold text-dark mb-3">
                                                            <i class="bi bi-file-earmark-text text-info me-2"></i>
                                                            Bukti Pembayaran
                                                        </h6>
                                                        <p class="text-muted small mb-0">
                                                            <i class="bi bi-check-circle text-info me-2"></i>
                                                            Wali kelas akan memberikan bukti penerimaan pembayaran berupa
                                                            kuitansi resmi.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- BAGIAN 3: KETENTUAN PEMBAYARAN (SUDAH BENAR) --}}
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-soft-warning text-warning rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-0">Ketentuan Pembayaran</h3>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @php
                                    $ketentuan = [
                                        'SPP dibayarkan maksimal tanggal 10 setiap bulan.',
                                        'Pembayaran dianggap sah setelah bukti diterima dan diverifikasi oleh TU.',
                                        'Harap simpan bukti transfer sebagai arsip pribadi.',
                                        'Keterlambatan pembayaran akan diberitahukan melalui wali murid.',
                                        'Semua pembayaran hanya melalui rekening resmi yayasan (bukan rekening pribadi guru/staf).',
                                        'Jika ada perubahan biaya atau metode, sekolah akan memberikan pengumuman resmi.',
                                    ];
                                @endphp

                                @foreach ($ketentuan as $index => $item)
                                    <div class="list-group-item {{ $index % 2 == 0 ? 'bg-light' : '' }} border-0 py-3">
                                        <div class="d-flex align-items-start">
                                            <div class="rounded-circle bg-soft-warning text-warning me-3 p-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-dark mb-0">{{ $item }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFO TAMBAHAN --}}
                <div class="alert alert-soft-primary border-0 shadow-sm">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-info-circle-fill fs-4 text-primary me-3 mt-1"></i>
                        <div>
                            <h5 class="fw-bold text-dark mb-2">Informasi Kontak</h5>
                            <p class="text-muted mb-2">Untuk informasi lebih lanjut mengenai pembayaran, silakan hubungi:
                            </p>
                            <div class="d-flex flex-wrap gap-4">
                                <div>
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <span class="text-dark">(021) 1234-5678</span>
                                </div>
                                <div>
                                    <i class="bi bi-whatsapp text-success me-2"></i>
                                    <span class="text-dark">0812-3456-7890</span>
                                </div>
                                <div>
                                    <i class="bi bi-envelope text-info me-2"></i>
                                    <span class="text-dark">info@alihsan.sch.id</span>
                                </div>
                            </div>
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

        /* Warna Soft/Pastel */
        .bg-soft-primary {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }

        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1) !important;
        }

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1) !important;
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .bg-soft-purple {
            background-color: rgba(111, 66, 193, 0.1) !important;
        }

        .bg-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1) !important;
        }

        .alert-soft-primary {
            background-color: rgba(13, 110, 253, 0.05) !important;
            border-color: rgba(13, 110, 253, 0.2) !important;
        }

        .alert-soft-info {
            background-color: rgba(13, 202, 240, 0.05) !important;
            border-color: rgba(13, 202, 240, 0.2) !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(13, 110, 253, 0.7) 100%) !important;
        }

        /* Hover Effects */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important;
        }

        /* Accordion Styling */
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa !important;
            color: #212529 !important;
            box-shadow: none;
        }

        .accordion-button {
            color: #212529;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Text Contrast */
        .text-dark {
            color: #343a40 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        /* Card Styling */
        .card {
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        /* Badge Styling */
        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .fs-2 {
                font-size: 1.75rem !important;
            }

            .px-6 {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }

            .d-flex.gap-4 {
                gap: 1rem !important;
            }
        }

        .rounded-3 {
            border-radius: 0.75rem !important;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth accordion interaction
            const accordionButtons = document.querySelectorAll('.accordion-button');
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove all active classes
                    accordionButtons.forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });

            // Add subtle animation to cards on load
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate__animated', 'animate__fadeIn');
            });
        });
    </script>
@endsection
