@extends('layouts.app')

@section('title', 'Tentang Yayasan - Yayasan Baitul Insan')

@section('content')
    <style>
        /* Styling Header */
        .bg-title-blue {
            background-color: #2547bc;
            border-radius: 50px;
            padding: 12px 60px;
            display: inline-block;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(37, 71, 188, 0.2);
        }

        /* Card Staff HD Version */
        .card-staff-custom {
            border-radius: 20px;
            background: #2547bc;
            padding: 10px;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
            max-width: 280px;
            margin: 0 auto;
        }

        .card-staff-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(37, 71, 188, 0.2);
        }

        /* Container Foto HD - Square Ratio 1:1 */
        .img-frame {
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 15px;
            background: #f8fafc;
        }

        .img-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        /* Label Nama & Jabatan */
        .staff-info {
            background: white;
            margin-top: 10px;
            border-radius: 12px;
            padding: 12px 8px;
            text-align: center;
        }

        .staff-info h6 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .staff-info span {
            font-size: 0.75rem;
            color: #2547bc;
            font-weight: 600;
            text-transform: uppercase;
            display: block;
        }

        /* Section Spacing */
        .section-title-custom {
            letter-spacing: 2px;
            font-size: 1.25rem;
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        .section-title-custom::after {
            content: '';
            width: 50%;
            height: 3px;
            background: #2547bc;
            position: absolute;
            bottom: -10px;
            left: 25%;
            border-radius: 10px;
        }

        /* Sejarah Section Styles */
        .sejarah-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .sejarah-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #002366;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .sejarah-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 25%;
            width: 50%;
            height: 4px;
            background: linear-gradient(90deg, #2547bc, #1a44cc);
            border-radius: 2px;
        }

        .sejarah-content {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 35, 102, 0.08);
            margin-bottom: 50px;
        }

        /* Styling untuk gambar dalam konten sejarah */
        .sejarah-content img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .sejarah-content img:hover {
            transform: scale(1.02);
        }

        /* Layout khusus untuk gambar + teks side by side */
        .image-text-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 30px;
            margin: 30px 0;
        }

        .image-text-wrapper img {
            flex: 0 0 300px;
            max-width: 100%;
        }

        .image-text-wrapper .text-content {
            flex: 1;
            min-width: 300px;
        }

        /* Responsive images */
        .img-fluid-hd {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .img-rounded-lg {
            border-radius: 15px;
        }

        .img-shadow {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Timeline untuk sejarah */
        .timeline {
            position: relative;
            padding-left: 30px;
            margin: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #2547bc;
            opacity: 0.3;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 5px;
            width: 16px;
            height: 16px;
            background: #2547bc;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px rgba(37, 71, 188, 0.2);
        }

        .timeline-year {
            font-weight: 700;
            color: #2547bc;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .timeline-content {
            background: #f8f9ff;
            padding: 15px;
            border-radius: 10px;
            border-left: 3px solid #2547bc;
        }
    </style>

    <div class="container py-5">
        {{-- Header --}}
        <div class="mb-5 text-center">
            <div class="bg-title-blue fs-2 mb-2 shadow-sm">Tentang Kami</div>
            <p class="text-muted fs-5 fw-medium">Profil Yayasan & Struktur Tenaga Pendidik</p>
        </div>


        {{-- Section Sejarah --}}
        <div class="sejarah-header">
            <h2 class="sejarah-title">Sejarah Yayasan</h2>
            <p class="text-muted fs-5">Perjalanan panjang dalam membangun pendidikan berkualitas</p>
        </div>

        {{-- Container untuk konten sejarah --}}
        <div class="sejarah-content">
            {{-- Jika ada gambar utama sejarah --}}
            @if (isset($tentang->thumbnail))
                <div class="mb-5 text-center">
                    <img src="{{ asset('storage/' . $tentang->thumbnail) }}" alt="Sejarah Yayasan Baitul Insan"
                        class="img-fluid img-rounded-lg img-shadow w-100" style="max-height: 500px; object-fit: cover;">
                    <p class="text-muted small mt-2">Gedung Yayasan Baitul Insan</p>
                </div>
            @endif

            {{-- Konten dinamis dari database --}}
            <div class="content-dynamic">
                {!! $tentang->isi !!}
            </div>

            {{-- Timeline Sejarah (Opsional) --}}
            @if (isset($timeline))
                <div class="timeline">
                    @foreach ($timeline as $item)
                        <div class="timeline-item">
                            <div class="timeline-year">{{ $item->tahun }}</div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-2">{{ $item->judul }}</h6>
                                <p class="mb-0">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Gallery Sejarah --}}
            <div class="row g-4 mt-5">
                @for ($i = 1; $i <= 3; $i++)
                    @if (file_exists(public_path("img/sejarah-{$i}.jpg")))
                        <div class="col-md-4">
                            <img src="{{ asset("img/sejarah-{$i}.jpg") }}" alt="Sejarah Yayasan {{ $i }}"
                                class="img-fluid img-rounded-lg img-shadow w-100" style="height: 250px; object-fit: cover;">
                        </div>
                    @endif
                @endfor
            </div>
        </div>


        {{-- Struktur Kepemimpinan --}}
        <div class="mb-5 text-center">
            <h4 class="fw-bold text-primary text-uppercase section-title-custom">Pimpinan Yayasan</h4>
            <div class="row g-4 justify-content-center">
                @foreach ($pimpinan as $p)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card-staff-custom">
                            <div class="img-frame">
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" class="img-fluid-hd"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p->nama) }}&size=500&background=2547bc&color=fff'">
                            </div>
                            <div class="staff-info">
                                <h6>{{ $p->nama }}</h6>
                                <span>{{ $p->jabatan }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5 text-center">
            <h4 class="fw-bold text-primary text-uppercase section-title-custom">Kepala Sekolah</h4>
            <div class="row g-4 justify-content-center">
                @forelse ($kepsek as $k)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card-staff-custom">
                            <div class="img-frame">
                                <img src="{{ asset('storage/' . $k->foto) }}" alt="{{ $k->nama }}"
                                    class="img-fluid-hd"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($k->nama) }}&size=500&background=2547bc&color=fff'">
                            </div>
                            <div class="staff-info">
                                <h6>{{ $k->nama }}</h6>
                                <span>{{ $k->jabatan }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted italic">Data belum tersedia.</p>
                @endforelse
            </div>
        </div>

        <div class="mb-5 text-center">
            <h4 class="fw-bold text-primary text-uppercase section-title-custom">Guru</h4>
            <div class="row g-4 justify-content-center">
                @foreach ($guru as $g)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card-staff-custom">
                            <div class="img-frame">
                                <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->nama }}"
                                    class="img-fluid-hd"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($g->nama) }}&size=500&background=2547bc&color=fff'">
                            </div>
                            <div class="staff-info">
                                <h6>{{ $g->nama }}</h6>
                                <span>{{ $g->jabatan }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="my-5 opacity-10">



    </div>
@endsection

@push('styles')
    <style>
        /* Additional styles for better responsiveness */
        @media (max-width: 768px) {
            .bg-title-blue {
                padding: 10px 30px;
                font-size: 1.5rem !important;
            }

            .sejarah-content {
                padding: 20px;
            }

            .sejarah-title {
                font-size: 2rem;
            }

            .image-text-wrapper {
                flex-direction: column;
            }

            .image-text-wrapper img {
                width: 100% !important;
                margin-bottom: 20px;
            }
        }

        /* Print styles */
        @media print {

            .card-staff-custom:hover,
            .sejarah-content img:hover {
                transform: none !important;
            }

            .img-shadow {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }
        }
    </style>
@endpush
