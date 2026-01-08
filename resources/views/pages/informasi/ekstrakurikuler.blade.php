@extends('layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
    <div class="container py-5">

        {{-- Judul --}}
        <div class="mb-5 text-center">
            <h2 class="bg-title-blue fs-2 mb-3 shadow-sm">
                Ekstrakurikuler
            </h2>
            <p class="text-muted fs-5 fw-medium mx-auto" style="max-width: 700px;">
                Beragam kegiatan untuk mengembangkan minat, bakat, dan karakter siswa di luar pembelajaran utama.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9"> {{-- Membatasi lebar agar teks tidak meluber ke samping --}}

                {{-- 1. Tahfidz --}}
                <div class="extra-card mb-5">
                    <h4 class="fw-bold color-navy mb-3">1. Tahfidz / BTQ</h4>
                    <div class="img-wrapper mb-3">
                        <img src="{{ asset('img/ekstra/tahfidz.png') }}" class="img-fluid rounded-4 shadow-sm"
                            alt="Tahfidz">
                    </div>
                    <p class="text-muted lh-lg text-justify">
                        Program untuk menumbuhkan kecintaan siswa terhadap Al-Qur’an melalui kegiatan membaca, menghafal,
                        dan
                        memahami tajwid dasar. Kegiatan ini dilakukan secara rutin agar siswa terbiasa berinteraksi dengan
                        Al-Qur’an
                        dan memiliki hafalan yang kuat serta benar.
                    </p>
                </div>

                {{-- 2. Pramuka --}}
                <div class="extra-card mb-5">
                    <h4 class="fw-bold color-navy mb-3">2. Pramuka</h4>
                    <div class="img-wrapper mb-3">
                        <img src="{{ asset('img/ekstra/pramuka.png') }}" class="img-fluid rounded-4 shadow-sm"
                            alt="Pramuka">
                    </div>
                    <p class="text-muted lh-lg text-justify">
                        Ekstrakurikuler yang berfokus pada pembentukan karakter disiplin, tanggung jawab, dan kemandirian
                        siswa.
                        Melalui kegiatan seperti baris-berbaris, permainan edukatif, dan latihan lapangan, siswa diajak
                        belajar
                        bekerja sama, memimpin, serta menyelesaikan masalah.
                    </p>
                </div>

                {{-- 3. Komputer --}}
                <div class="extra-card mb-5">
                    <h4 class="fw-bold color-navy mb-3">3. Komputer / Coding Dasar</h4>
                    <div class="img-wrapper mb-3">
                        <img src="{{ asset('img/ekstra/komputer.png') }}" class="img-fluid rounded-4 shadow-sm"
                            alt="Komputer">
                    </div>
                    <p class="text-muted lh-lg text-justify">
                        Mengenalkan dunia teknologi sejak dini. Siswa diajarkan cara mengoperasikan perangkat komputer
                        dengan benar,
                        mengenal software edukatif, hingga logika pemrograman dasar (coding) untuk mengasah kemampuan
                        berpikir kritis dan kreatif.
                    </p>
                </div>

                {{-- 4. Olahraga --}}
                <div class="extra-card mb-5">
                    <h4 class="fw-bold color-navy mb-3">4. Olahraga</h4>
                    <div class="img-wrapper mb-3">
                        <img src="{{ asset('img/ekstra/olahraga.png') }}" class="img-fluid rounded-4 shadow-sm"
                            alt="Olahraga">
                    </div>
                    <p class="fw-bold color-navy mb-2">Tujuan: Meningkatkan kesehatan fisik, ketangkasan, dan sportivitas.
                    </p>
                    <ul class="text-muted lh-lg">
                        <li><strong>Futsal:</strong> Melatih kerja sama tim dan kecepatan.</li>
                        <li><strong>Badminton:</strong> Meningkatkan ketangkasan dan koordinasi mata-tangan.</li>
                        <li><strong>Senam:</strong> Membangun kebugaran dan kelincahan tubuh.</li>
                    </ul>
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

        .color-navy {
            color: #002366;
        }

        .extra-card img {
            width: 100%;
            /* Memastikan gambar memenuhi lebar kolom */
            max-height: 450px;
            /* Opsional: Membatasi tinggi gambar agar seragam */
            object-fit: cover;
        }

        .text-justify {
            text-align: justify;
        }

        /* Mengatur jarak baris agar lebih enak dibaca */
        .lh-lg {
            line-height: 1.8 !important;
        }

        .img-wrapper {
            overflow: hidden;
            border-radius: 1.5rem;
        }

        @media (max-width: 768px) {
            .bg-title-blue {
                padding: 10px 30px;
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
