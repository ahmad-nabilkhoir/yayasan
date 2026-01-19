@extends('layouts.app')

@section('title', 'Tentang Yayasan - Yayasan Pendidikan Baitul Insan')

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
            object-position: center;
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

        /* Section Title */
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

        /* Sejarah Section */
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
            line-height: 1.7;
        }

        /* Konten Dinamis dari CKEditor */
        .content-dynamic h1,
        .content-dynamic h2,
        .content-dynamic h3,
        .content-dynamic h4 {
            color: #002366;
            margin: 1.5em 0 1em;
        }

        .content-dynamic p {
            margin-bottom: 1.2em;
            color: #333;
        }

        .content-dynamic ul,
        .content-dynamic ol {
            padding-left: 1.5rem;
            margin-bottom: 1.2em;
        }

        .content-dynamic li {
            margin-bottom: 0.4em;
        }

        /* Gambar dalam konten */
        .content-dynamic img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.2em 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .content-dynamic img:hover {
            transform: scale(1.02);
        }

        /* Layout side-by-side (opsional) */
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
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .image-text-wrapper .text-content {
            flex: 1;
            min-width: 300px;
        }

        /* Timeline */
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

        /* Gallery */
        .gallery-img {
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.03);
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
            <h2 class="sejarah-title">{{ $tentang?->judul ?? 'Sejarah Yayasan' }}</h2>
            <p class="text-muted fs-5">Perjalanan panjang dalam membangun pendidikan berkualitas</p>
        </div>

        {{-- Konten Sejarah --}}
        @if ($tentang)
            <div class="sejarah-content">
                {{-- Thumbnail utama dari Database --}}
                @if ($tentang->thumbnail)
                    <div class="mb-5 text-center">
                        <img src="{{ asset('storage/' . $tentang->thumbnail) }}" alt="{{ $tentang->judul }}"
                            class="img-fluid rounded-3 w-100 shadow-sm" style="max-height: 500px; object-fit: cover;">
                        <p class="text-muted small mt-2">Gedung Yayasan Pendidikan Baitul Insan</p>
                    </div>
                @endif

                {{-- Konten dinamis (HTML dari CKEditor) --}}
                <div class="content-dynamic">
                    {!! $tentang->isi !!}
                </div>

                {{-- Timeline (sinkron dengan variabel dari controller) --}}
                @if (isset($timeline) && $timeline->isNotEmpty())
                    <div class="timeline mt-5 pt-3">
                        @foreach ($timeline as $item)
                            <div class="timeline-item">
                                <div class="timeline-year">{{ $item->tahun }}</div>
                                <div class="timeline-content">
                                    <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                                    <p class="mb-0">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Gallery Sejarah --}}
                <div class="row g-4 mt-5">
                    @for ($i = 1; $i <= 3; $i++)
                        @php $imgSejarah = "img/sejarah-{$i}.jpg"; @endphp
                        @if (file_exists(public_path($imgSejarah)))
                            <div class="col-md-4">
                                <img src="{{ asset($imgSejarah) }}" alt="Dokumentasi Sejarah {{ $i }}"
                                    class="w-100 gallery-img">
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        @else
            <div class="py-5 text-center">
                <i class="bi bi-exclamation-circle text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Konten sejarah yayasan belum tersedia.</p>
            </div>
        @endif

        {{-- Struktur Organisasi --}}
        @if ($pimpinan->isNotEmpty() || $kepsek->isNotEmpty() || $guru->isNotEmpty())

            {{-- Bagian Pimpinan --}}
            @if ($pimpinan->isNotEmpty())
                <div class="mb-5 text-center">
                    <h4 class="fw-bold text-primary text-uppercase section-title-custom">Pimpinan Yayasan</h4>
                    <div class="row g-4 justify-content-center">
                        @foreach ($pimpinan as $p)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card-staff-custom">
                                    <div class="img-frame">
                                        <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                            class="w-100 h-100"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(trim($p->nama)) }}&size=500&background=2547bc&color=fff'">
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
            @endif

            {{-- Bagian Kepala Sekolah --}}
            @if ($kepsek->isNotEmpty())
                <div class="mb-5 text-center">
                    <h4 class="fw-bold text-primary text-uppercase section-title-custom">Kepala Sekolah</h4>
                    <div class="row g-4 justify-content-center">
                        @foreach ($kepsek as $k)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card-staff-custom">
                                    <div class="img-frame">
                                        <img src="{{ asset('storage/' . $k->foto) }}" alt="{{ $k->nama }}"
                                            class="w-100 h-100"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(trim($k->nama)) }}&size=500&background=2547bc&color=fff'">
                                    </div>
                                    <div class="staff-info">
                                        <h6>{{ $k->nama }}</h6>
                                        <span>{{ $k->jabatan }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Bagian Guru --}}
            @if ($guru->isNotEmpty())
                <div class="mb-5 text-center">
                    <h4 class="fw-bold text-primary text-uppercase section-title-custom">Guru</h4>
                    <div class="row g-4 justify-content-center">
                        @foreach ($guru as $g)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card-staff-custom">
                                    <div class="img-frame">
                                        <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->nama }}"
                                            class="w-100 h-100"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(trim($g->nama)) }}&size=500&background=2547bc&color=fff'">
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
            @endif
        @else
            <div class="py-5 text-center">
                <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Struktur organisasi belum tersedia.</p>
            </div>
        @endif

        <hr class="my-5 opacity-10">
    </div>
@endsection

@push('styles')
    <style>
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

            .card-staff-custom {
                max-width: 220px;
            }
        }

        @media print {

            .card-staff-custom:hover,
            .sejarah-content img:hover {
                transform: none !important;
            }

            .img-shadow,
            .gallery-img {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }

            .sejarah-content {
                box-shadow: none;
                border: 1px solid #eee;
            }
        }
    </style>
@endpush
