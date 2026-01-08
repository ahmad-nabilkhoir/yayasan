@extends('layouts.app')

@section('title', 'Alur Pendaftaran')

@section('content')
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto max-w-5xl px-4">

            {{-- ================= JUDUL ================= --}}
            <div class="mb-15 text-center">
                <div class="mb-4 inline-block">
                    <h2 class="bg-primary rounded-pill d-inline-block fw-bold fs-2 px-5 py-3 text-white shadow-sm">
                        <i class="bi bi-diagram-3 me-2"></i>Alur Pendaftaran
                    </h2>
                </div>
                <p class="text-dark fs-5 fw-bold mb-2">
                    Sistem Pendaftaran Peserta Didik Baru Yayasan Al-Ihsan
                </p>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Panduan lengkap proses pendaftaran peserta didik baru di Yayasan Al-Ihsan,
                    mulai dari pengisian formulir hingga tahap penerimaan akhir.
                </p>
            </div>

            {{-- ================= STEP 1 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 gap-5">
                <div class="rounded-4 border-start border-5 border-primary flex-grow-1 bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">1</span>
                        </div>
                        <h3 class="fw-bold text-dark fs-4 mb-0">Pengisian Formulir Online</h3>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Calon wali murid mengisi formulir pendaftaran melalui website PPDB.
                        Formulir mencakup data siswa, informasi orang tua/wali,
                        serta pilihan jenjang pendidikan.
                    </p>
                </div>
                <div class="icon-box bg-primary rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi bi-pencil-square text-primary display-5"></i>
                </div>
            </div>

            {{-- ================= STEP 2 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 flex-row-reverse gap-5">
                <div class="rounded-4 border-start border-5 border-success flex-grow-1 text-md-end bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center justify-content-md-end mb-3">
                        <h3 class="fw-bold text-dark fs-4 order-md-1 order-2 mb-0 me-3">Pengumpulan Berkas</h3>
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center order-md-2 order-1 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">2</span>
                        </div>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Wali murid menyiapkan dan mengunggah berkas persyaratan seperti
                        fotokopi KK, akta kelahiran, pas foto, serta dokumen tambahan lainnya.
                    </p>
                </div>
                <div class="icon-box bg-success rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi bi-folder-check text-success display-5"></i>
                </div>
            </div>

            {{-- ================= STEP 3 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 gap-5">
                <div class="rounded-4 border-start border-5 border-warning flex-grow-1 bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">3</span>
                        </div>
                        <h3 class="fw-bold text-dark fs-4 mb-0">Seleksi Administrasi</h3>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Tim sekolah Al-Ihsan akan melakukan pengecekan kelengkapan
                        dan validasi berkas. Jika ada kekurangan, pihak sekolah akan menghubungi wali murid.
                    </p>
                </div>
                <div class="icon-box bg-warning rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi bi-clipboard-check text-warning display-5"></i>
                </div>
            </div>

            {{-- ================= STEP 4 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 flex-row-reverse gap-5">
                <div class="rounded-4 border-start border-5 border-info flex-grow-1 text-md-end bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center justify-content-md-end mb-3">
                        <h3 class="fw-bold text-dark fs-4 order-md-1 order-2 mb-0 me-3">Pengumuman Hasil</h3>
                        <div class="bg-info rounded-circle d-flex align-items-center justify-content-center order-md-2 order-1 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">4</span>
                        </div>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Hasil seleksi akan diumumkan melalui WhatsApp atau kontak
                        resmi yang dicantumkan pada formulir pendaftaran.
                    </p>
                </div>
                <div class="icon-box bg-info rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi bi-megaphone text-info display-5"></i>
                </div>
            </div>

            {{-- ================= STEP 5 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 gap-5">
                <div class="rounded-4 border-start border-5 border-orange flex-grow-1 bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-orange rounded-circle d-flex align-items-center justify-content-center me-3 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">5</span>
                        </div>
                        <h3 class="fw-bold text-dark fs-4 mb-0">Daftar Ulang</h3>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Bagi calon siswa yang dinyatakan diterima,
                        wali murid wajib melakukan proses daftar ulang
                        sesuai jadwal yang telah ditentukan oleh pihak sekolah.
                    </p>
                </div>
                <div class="icon-box bg-orange rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi-person-check text-danger display-5"></i>
                </div>
            </div>

            {{-- ================= STEP 6 ================= --}}
            <div class="step-container d-flex align-items-center mb-12 flex-row-reverse gap-5">
                <div class="rounded-4 border-start border-5 border-danger flex-grow-1 bg-white p-5 shadow-lg">
                    <div class="d-flex align-items-center justify-content-md-end mb-3">
                        <h3 class="fw-bold text-dark fs-4 order-md-1 order-2 mb-0 me-3">Pengenalan Lingkungan Sekolah (MPLS)
                        </h3>
                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center order-md-2 order-1 text-white shadow-sm"
                            style="width: 45px; height: 45px; min-width: 45px;">
                            <span class="fw-bold">6</span>
                        </div>
                    </div>
                    <p class="text-muted lh-base mb-0">
                        Siswa baru mengikuti kegiatan MPLS sebagai tahap awal
                        pengenalan lingkungan sekolah, guru, serta budaya sekolah
                        sebelum memulai kegiatan belajar mengajar.
                    </p>
                </div>
                <div class="icon-box bg-danger rounded-4 d-none d-md-block bg-opacity-10 p-4">
                    <i class="bi bi-mortarboard text-danger display-5"></i>
                </div>
            </div>

        </div>
    </div>

    <style>
        :root {
            --primary-color: #1a44cc;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
            --orange-color: #fd7e14;
            --purple-color: #6f42c1;
            --danger-color: #e74a3b;
        }

        /* Custom Colors */
        .bg-orange {
            background-color: var(--orange-color) !important;
        }

        .border-orange {
            border-color: var(--orange-color) !important;
        }

        .text-orange {
            color: var(--orange-color) !important;
        }

        .bg-purple {
            background-color: var(--purple-color) !important;
        }

        .border-purple {
            border-color: var(--purple-color) !important;
        }

        .text-purple {
            color: var(--purple-color) !important;
        }

        .mb-12 {
            margin-bottom: 5rem !important;
        }

        .mb-15 {
            margin-bottom: 7rem !important;
        }

        .shadow-lg {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .shadow-lg:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        /* Desktop Border Logic */
        @media (min-width: 769px) {
            .border-end-custom {
                border-right: 5px solid !important;
            }
        }

        /* Perbaikan untuk tampilan Mobile */
        @media (max-width: 768px) {
            .mb-12 {
                margin-bottom: 3rem !important;
            }

            .step-container {
                flex-direction: column !important;
            }

            .icon-box i {
                line-height: 1;
                display: block;
            }

            /* Paksa border semua di kiri saat mobile agar rapi */
            .border-end-custom {
                border-right: 0 !important;
                border-left: 5px solid !important;
            }

            /* Pewarnaan border kiri otomatis di mobile untuk step genap */
            .step-container:nth-child(even) .rounded-4 {
                border-left-width: 5px !important;
            }

            .text-md-end {
                text-align: left !important;
            }

            .justify-content-md-end {
                justify-content: flex-start !important;
            }
        }
    </style>
@endsection
