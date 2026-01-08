@extends('layouts.app')

@section('title', 'Tata Tertib')

@section('content')
    <div class="container py-5">

        {{-- Header Judul --}}
        <div class="mb-5 text-center">
            <h1 class="bg-title-blue fs-2 mb-2 shadow-sm">
                Tata Tertib
            </h1>
            <p class="text-muted fs-5 fw-medium mx-auto">
                Panduan kedisiplinan di lingkungan Yayasan Baitul Insan
            </p>
        </div>

        {{-- Intro Text --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <p class="text-muted">
                    Tata tertib ini disusun sebagai pedoman bagi seluruh siswa dalam menjaga kedisiplinan,
                    membentuk karakter, serta menciptakan suasana belajar yang tertib, aman, dan kondusif
                    di lingkungan Yayasan Baitul Insan.
                </p>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- BAGIAN 1: TATA TERTIB UMUM --}}
                <div class="card mb-5 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold border-bottom mb-4 pb-2">Tata Tertib Umum</h3>

                        <div class="row g-4">
                            {{-- A. Kehadiran --}}
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary">A. Kehadiran & Ketepatan Waktu</h5>
                                <ul class="text-muted small">
                                    <li class="mb-2">Siswa wajib hadir sebelum jam pelajaran dimulai.</li>
                                    <li class="mb-2">Siswa yang terlambat wajib melapor kepada guru piket.</li>
                                    <li>Ketidakhadiran harus disertai surat keterangan orang tua.</li>
                                </ul>
                            </div>

                            {{-- B. Kerapian --}}
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary">B. Kerapian & Seragam</h5>
                                <ul class="text-muted small">
                                    <li class="mb-2">Siswa wajib mengenakan seragam sesuai ketentuan hari.</li>
                                    <li class="mb-2">Rambut harus rapi dan sesuai aturan sekolah.</li>
                                    <li>Tidak diperkenankan memakai aksesoris berlebihan.</li>
                                </ul>
                            </div>

                            {{-- C. Sikap --}}
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary">C. Sikap & Perilaku</h5>
                                <ul class="text-muted small">
                                    <li class="mb-2">Siswa wajib menjaga sopan santun terhadap guru, staf, dan sesama
                                        siswa.</li>
                                    <li class="mb-2">Dilarang membawa barang yang tidak sesuai dengan lingkungan sekolah.
                                    </li>
                                    <li>Siswa harus menjaga kebersihan kelas dan lingkungan sekolah.</li>
                                </ul>
                            </div>

                            {{-- D. KBM --}}
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary">D. Kegiatan Belajar Mengajar</h5>
                                <ul class="text-muted small">
                                    <li class="mb-2">Siswa wajib membawa perlengkapan belajar yang diperlukan.</li>
                                    <li class="mb-2">Dilarang mengganggu jalannya pembelajaran.</li>
                                    <li>Tugas harus dikumpulkan sesuai tenggat waktu.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 2: SANKSI --}}
                <div class="card bg-light mb-5 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold text-danger mb-3">Sanksi</h3>
                        <ul class="text-muted mb-0">
                            <li class="mb-2">Teguran lisan oleh guru.</li>
                            <li class="mb-2">Pencatatan pelanggaran oleh guru piket.</li>
                            <li class="mb-2">Pemanggilan orang tua untuk pelanggaran berulang.</li>
                            <li>Tindakan pembinaan sesuai kebijakan sekolah.</li>
                        </ul>
                    </div>
                </div>

                {{-- FOOTER NOTE --}}
                <div class="text-muted small fst-italic text-center">
                    Tata tertib ini berlaku bagi seluruh siswa di lingkungan Yayasan Baitul Insan
                    dan dapat diperbarui sesuai kebutuhan sekolah.
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
