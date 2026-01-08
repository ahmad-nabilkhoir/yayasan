@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
    <div class="container py-5">

        {{-- ================= JUDUL ================= --}}
        <div class="mb-5 text-center">
            <span class="bg-title-blue fs-2 mb-2 shadow-sm">
                Visi Misi
            </span>
            <p class="text-muted fs-5 fw-medium mx-auto">
                Landasan arah dan tujuan lembaga dalam mewujudkan pendidikan yang berkualitas.
            </p>
        </div>


        {{-- ================= VISI ================= --}}
        <div class="row align-items-start mb-5">

            {{-- FOTO --}}
            <div class="col-md-4 mb-md-0 mb-4 text-center">
                <img src="{{ asset('img/visi-misi/ketua-yayasan.jpg') }}" class="img-fluid" style="max-height:420px;">
                <div class="rounded-3 mt-3 p-3" style="background:#E0F2FE;">
                    <strong>Bapak Dr. Edi Saputro</strong><br>
                    <small class="text-muted">Pimpinan Yayasan Baitul Insan</small>
                </div>
            </div>

            {{-- TEKS --}}
            <div class="col-md-8">
                <h3 class="fw-bold mb-5">Visi</h3>
                <p class="text-muted lh-lg">
                    Kurikulum disusun untuk memungkinkan penyesuaian program pendidikan
                    dengan kebutuhan dan potensi yang ada di sekolah. SDIT Baitul Insan
                    Pesawaran sebagai unit penyelenggara pendidikan juga harus
                    memperhatikan dan mengantisipasi perkembangan dan tantangan masa depan.
                </p>

                <p class="text-muted lh-lg">
                    Visi tidak lain merupakan citra moral yang menggambarkan profil sekolah
                    yang diinginkan di masa datang. Namun demikian, visi sekolah tetap
                    mengacu pada kebijakan pendidikan nasional.
                </p>

                <p class="fw-semibold fst-italic">
                    “Menjadi Sekolah Islam yang memiliki karakter profetik”
                </p>
            </div>
        </div>


        {{-- ================= MISI ================= --}}
        <div class="row align-items-start">

            {{-- FOTO --}}
            <div class="col-md-4 mb-md-0 mb-4 text-center">
                <img src="{{ asset('img/visi-misi/wakil-yayasan.png') }}" class="img-fluid" style="max-height:420px;">
                <div class="rounded-3 mt-3 p-3" style="background:#E0F2FE;">
                    <strong>Bapak Dr. Hendrawan</strong><br>
                    <small class="text-muted">Wakil Pimpinan Yayasan Baitul Insan</small>
                </div>
            </div>

            {{-- TEKS --}}
            <div class="col-md-8">
                <h3 class="fw-bold mb-5">Misi</h3>
                <ol class="lh-lg text-muted">
                    <li>Melaksanakan proses kepengasuhan berdasarkan nilai-nilai Islam.</li>
                    <li>
                        Menyelenggarakan pembelajaran terpadu, menyenangkan, mampu
                        menstimulasi dan mengoptimalkan kecerdasan anak dengan pendekatan
                        <strong>Asah, Asih, Asuh</strong>.
                    </li>
                    <li>
                        Menumbuhkan kesiapan anak untuk melanjutkan ke jenjang pendidikan
                        berikutnya melalui bekal nilai-nilai Islam.
                    </li>
                    <li>
                        Melaksanakan pengelolaan sekolah yang amanah, berkualitas, efektif,
                        efisien dan berorientasi pada pelayanan.
                    </li>
                </ol>
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
