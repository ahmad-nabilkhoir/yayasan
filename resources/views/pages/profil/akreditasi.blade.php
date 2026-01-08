@extends('layouts.app')

@section('title', 'Akreditasi')

@section('content')
    <div class="container py-5">

        {{-- Bagian Judul --}}
        <div class="mb-5 text-center">
            <span>
                <h2 class="bg-title-blue fs-2 mb-2 shadow-sm">Akreditasi</h2>
            </span>
            <p class="text-muted fs-5 fw-medium mx-auto">Kami berstandar akreditasi unggul dan terpercaya.</p>
        </div>

        {{-- Bagian Gambar --}}
        <div class="mb-5">
            {{-- Pastikan Anda mengganti path gambar sesuai lokasi file Anda --}}
            <img src="{{ asset('img/akreditasi/akreditasi.png') }}" alt="Foto Bersama Yayasan Baitul Insan"
                class="img-fluid w-100 rounded shadow-sm" style="object-fit: cover; max-height: 500px;">
        </div>

        {{-- Bagian Teks Deskripsi --}}
        <div class="mb-4">
            <p>
                Yayasan Baitul Insan menaungi satuan pendidikan yang telah melalui proses penilaian
                akreditasi oleh Badan Akreditasi Nasional (BAN-PAUD dan BAN-S/M). Penilaian dilakukan berdasarkan
                standar nasional pendidikan yang meliputi mutu pendidik, proses pembelajaran, sarana prasarana,
                dan manajemen sekolah.
            </p>
            <p>
                Informasi akreditasi ini menjadi wujud komitmen Yayasan Baitul Insan dalam memberikan layanan pendidikan
                terbaik, terukur, dan terpercaya bagi masyarakat.
            </p>
        </div>

        {{-- Bagian Tabel --}}
        <div class="table-responsive mb-5">
            <table class="table-bordered border-dark table align-middle">
                <thead>
                    <tr class="py-3 text-center">
                        <th scope="col" class="py-3" style="width: 70%;">Sekolah</th>
                        <th scope="col" class="py-3" style="width: 30%;">Akreditasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4">SD IT Baitul Insan (Kab. Pesawaran, Lampung)</td>
                        <td class="fw-bold fs-5 text-center">B</td>
                    </tr>
                    <tr>
                        <td class="p-4">TK IT Baitul Insan (Kab. Pesawaran, Lampung)</td>
                        <td class="fw-bold fs-5 text-center">C</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Bagian Standar Penilaian --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-4">Standar Penilaian Akreditasi</h5>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Standar Kompetensi Lulusan
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Standar Proses Pembelajaran
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Standar Pendidik dan Tenaga Kependidikan
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Sarana dan Prasarana
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Pengelolaan Sekolah
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="me-2">✔</span> Pembiayaan Pendidikan
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bagian Penutup --}}
        <div>
            <p class="text-muted">
                Yayasan Baitul Insan berkomitmen untuk terus meningkatkan mutu pendidikan dengan memperbaiki
                kurikulum, pembinaan guru, dan peningkatan fasilitas agar mencapai akreditasi yang lebih baik di masa
                mendatang.
            </p>
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
