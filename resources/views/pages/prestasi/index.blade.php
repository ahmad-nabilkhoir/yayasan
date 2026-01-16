@extends('layouts.app')

@section('title', 'Prestasi Siswa - Yayasan Baitul Insan')

@section('content')
    <style>
        /* Header Styling Konsisten */
        .bg-title-blue {
            background-color: #2547bc;
            border-radius: 50px;
            padding: 12px 60px;
            display: inline-block;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(37, 71, 188, 0.2);
        }

        /* Container List Prestasi */
        .prestasi-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .prestasi-item {
            background: white;
            border-radius: 25px;
            padding: 30px;
            margin-bottom: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
            transition: transform 0.3s ease;
        }

        .prestasi-item:hover {
            transform: translateY(-5px);
        }

        /* Nomor Urut Modern */
        .nomer-urut {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2547bc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .nomer-urut::after {
            content: "";
            flex-grow: 1;
            height: 2px;
            background: #e2e8f0;
            margin-left: 20px;
        }

        /* Foto HD Menurun */
        .img-hd-wrapper {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 15px 30px rgba(37, 71, 188, 0.15);
            background: #f8fafc;
        }

        .img-hd-wrapper img {
            width: 100%;
            height: auto;
            max-height: 500px;
            /* Agar foto tidak terlalu panjang ke bawah */
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* Konten Teks */
        .judul-utama {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .sub-judul {
            font-size: 1rem;
            font-weight: 600;
            color: #2547bc;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: block;
        }

        .badge-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .badge-custom {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .deskripsi-text {
            font-size: 1.05rem;
            color: #475569;
            line-height: 1.8;
            text-align: justify;
        }
    </style>

    <div class="container py-5">
        {{-- Header --}}
        <div class="mb-5 text-center">
            <div class="bg-title-blue fs-2 mb-3 shadow-sm">
                Prestasi Siswa
            </div>
            <p class="text-muted fs-5 fw-medium mx-auto" style="max-width: 800px;">
                Prestasi siswa SD IT Baitul Insan menjadi bukti dedikasi, kerja keras, dan semangat anak-anak dalam
                mengembangkan bakat serta kemampuan mereka.
            </p>
        </div>

        {{-- List Prestasi Menurun --}}
        <div class="prestasi-wrapper">
            @foreach ($prestasi as $index => $item)
                <div class="prestasi-item">


                    {{-- Judul --}}
                    <h2 class="judul-utama">{{ $item->judul }}</h2>

                    {{-- Badges --}}
                    <div class="badge-group">
                        <span class="badge-custom bg-primary text-white shadow-sm">
                            <i class="fas fa-school me-1"></i> {{ $item->sekolah }}
                        </span>
                        <span class="badge-custom bg-light text-dark border">
                            <i class="fas fa-calendar-alt text-primary me-1"></i> {{ $item->tahun }}
                        </span>
                    </div>

                    {{-- Foto HD --}}
                    <div class="img-hd-wrapper">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                            onerror="this.src='https://placehold.co/800x450?text=Foto+Prestasi+HD'">
                    </div>

                    {{-- Sub Judul & Deskripsi --}}
                    @if ($item->sub_judul)
                        <span class="sub-judul">{{ $item->sub_judul }}</span>
                    @endif

                    <div class="deskripsi-text">
                        {!! nl2br(e($item->deskripsi)) !!}
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $prestasi->links() }}
            </div>
        </div>
    </div>
@endsection
