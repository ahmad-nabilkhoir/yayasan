@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Yayasan Pendidikan Al-Ihsan')

@section('content')
    {{-- Hero/Header Section --}}
    <section class="public-gallery-hero py-5">
        <div class="container text-center">
            <div class="d-inline-block mb-3">
                <h1 class="bg-title-blue fs-2 mb-3 shadow-sm">Galeri Kegiatan</h1>
            </div>
            <p class="text-muted fs-5 fw-medium mx-auto" style="max-width: 700px;">
                Mengintip keceriaan dan proses belajar mengajar santri di lingkungan Yayasan Pendidikan Al-Ihsan.
            </p>
        </div>
    </section>

    {{-- Filter & Blue Bar Section --}}
    <div class="container mb-5">
        <div class="public-filter-wrapper rounded-pill d-flex justify-content-center flex-wrap gap-2 bg-white p-3 shadow-sm">
            <a href="{{ route('galeri.index', ['kategori' => 'all']) }}"
                class="btn public-btn-filter {{ $kategoriFilter == 'all' ? 'active' : '' }}">
                Semua Unit
            </a>

            @php
                $kategoris = $galeri->pluck('kategori')->unique();
            @endphp

            @foreach ($kategoris as $kategori)
                <a href="{{ route('galeri.index', ['kategori' => $kategori]) }}"
                    class="btn public-btn-filter {{ $kategoriFilter == $kategori ? 'active' : '' }}">
                    Unit {{ strtoupper($kategori) }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Blue Decorative Bar --}}
    <div class="public-motto-bar py-3 text-center shadow-sm">
        <h6 class="fw-bold letter-spacing-2 mb-0 text-white">
            <i class="bi bi-star-fill me-2"></i> MENCETAK GENERASI QUR'ANI & BERPRESTASI <i
                class="bi bi-star-fill ms-2"></i>
        </h6>
    </div>

    {{-- Main Gallery Grid --}}
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-4" id="public-galeri-grid">
                @forelse ($galeri as $item)
                    <div class="col-lg-4 col-md-6 public-galeri-item" data-kategori="{{ $item->kategori }}"
                        style="{{ $kategoriFilter != 'all' && $kategoriFilter != $item->kategori ? 'display: none;' : '' }}">
                        <div class="public-gallery-card shadow-sm" onclick="openPublicLightbox(this)"
                            data-image="{{ asset('storage/' . $item->foto) }}" data-title="{{ $item->judul }}"
                            data-description="{{ $item->deskripsi }}">

                            <div class="public-gallery-img-wrapper position-relative">
                                {{-- Category Badge --}}
                                <div class="public-category-label public-badge-{{ strtolower($item->kategori) }}">
                                    {{ strtoupper($item->kategori) }}
                                </div>

                                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid public-gallery-thumb"
                                    alt="{{ $item->judul }}" loading="lazy" decoding="async" width="400" height="300"
                                    onerror="this.src='https://via.placeholder.com/400x280/1a44cc/ffffff?text=YPAI'">


                                <div class="public-gallery-overlay">
                                    <div class="public-overlay-icon"><i class="bi bi-zoom-in"></i></div>
                                </div>
                            </div>

                            <div class="card-body-custom bg-white p-4">
                                <small class="text-primary fw-bold text-uppercase d-block mb-1">
                                    Unit {{ $item->kategori }}
                                </small>
                                <h5 class="fw-bold text-dark public-text-truncate-2 mb-2">{{ $item->judul }}</h5>
                                <p class="text-muted small public-text-truncate-3 mb-0">
                                    {{ $item->deskripsi ?? 'Klik untuk detail dokumentasi kegiatan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 text-center">
                        <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">Belum ada foto kegiatan yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination dengan Parameter Filter --}}
            @if ($galeri->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $galeri->appends(['kategori' => $kategoriFilter])->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

    {{-- Modal Lightbox --}}
    <div class="modal fade" id="publicLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 bg-transparent shadow-lg">
                <div class="modal-header justify-content-end mb-2 border-0 p-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card rounded-4 overflow-hidden border-0">
                        <img id="publicLightboxImage" src="" class="img-fluid w-100"
                            style="max-height: 75vh; object-fit: cover;" loading="lazy">
                        <div class="bg-white p-4">
                            <h4 id="publicLightboxTitle" class="fw-bold text-dark"></h4>
                            <p id="publicLightboxDescription" class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
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

        /* Public Gallery Specific Styles - Tidak akan bentrok dengan admin */
        /* Motto Bar Styling */
        .public-motto-bar {
            background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%);
            border-bottom: 4px solid #fbbf24;
        }

        .letter-spacing-2 {
            letter-spacing: 3px;
        }

        /* Title Styling */
        .public-title-divider {
            width: 80px;
            height: 4px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        /* Filter Styling */
        .public-filter-wrapper {
            width: fit-content;
            margin: 0 auto;
            border: 1px solid #e5e7eb;
        }

        .public-btn-filter {
            border-radius: 30px;
            padding: 8px 24px;
            font-weight: 600;
            border: none;
            color: #4b5563;
            transition: 0.3s;
            background-color: #f8f9fa;
            text-decoration: none;
            display: inline-block;
        }

        .public-btn-filter.active,
        .public-btn-filter:hover {
            background-color: #1e3a8a;
            color: white;
            transform: translateY(-2px);
        }

        /* Card Styling */
        .public-gallery-card {
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #e9ecef;
        }

        .public-gallery-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .public-gallery-img-wrapper {
            height: 280px;
            overflow: hidden;
            position: relative;
        }

        .public-gallery-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.6s ease;
        }

        .public-gallery-card:hover .public-gallery-thumb {
            transform: scale(1.1);
        }

        /* Overlays */
        .public-gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(30, 58, 138, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
        }

        .public-gallery-card:hover .public-gallery-overlay {
            opacity: 1;
        }

        .public-overlay-icon {
            font-size: 2.5rem;
            color: white;
            border: 2px solid white;
            border-radius: 50%;
            padding: 10px 15px;
            background: rgba(0, 0, 0, 0.3);
        }

        /* Badges */
        .public-category-label {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
            padding: 5px 15px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
        }

        .public-badge-tk {
            background-color: #fbbf24;
            color: #000;
        }

        .public-badge-sd {
            background-color: #3b82f6;
            color: #fff;
        }

        .public-badge-smp {
            background-color: #10b981;
            color: #fff;
        }

        .public-badge-sma {
            background-color: #8b5cf6;
            color: #fff;
        }

        /* Utilities */
        .public-text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .public-text-truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Hero Section */
        .public-gallery-hero {
            background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
            position: relative;
            overflow: hidden;
        }

        .public-gallery-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 70%);
        }


        /* Modal Styling */
        #publicLightboxModal .modal-content {
            background: transparent;
            border: none;
        }

        #publicLightboxModal .btn-close-white {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            background-size: 1.2em;
        }

        #publicLightboxModal .btn-close-white:hover {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .public-gallery-img-wrapper {
                height: 220px;
            }

            .public-filter-wrapper {
                width: 100%;
                border-radius: 15px !important;
            }

            .public-btn-filter {
                padding: 6px 16px;
                font-size: 0.9rem;
            }

            .public-motto-bar h6 {
                font-size: 0.9rem;
                letter-spacing: 1px;
            }
        }

        @media (max-width: 576px) {
            .public-gallery-hero h1 {
                font-size: 2.5rem;
            }

            .public-gallery-img-wrapper {
                height: 200px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Lightbox Functionality - Public Gallery
        function openPublicLightbox(el) {
            const modal = new bootstrap.Modal(document.getElementById('publicLightboxModal'));
            const image = document.getElementById('publicLightboxImage');
            const title = document.getElementById('publicLightboxTitle');
            const description = document.getElementById('publicLightboxDescription');

            // Preload image
            image.src = '';
            image.classList.add('loading');

            const img = new Image();
            img.onload = function() {
                image.src = el.dataset.image;
                image.classList.remove('loading');
            };
            img.src = el.dataset.image;

            title.textContent = el.dataset.title;
            description.textContent = el.dataset.description || 'Tidak ada deskripsi yang tersedia.';

            modal.show();
        }

        // Add fade-in animation for gallery items
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.public-galeri-item');
            items.forEach((item, index) => {
                if (item.style.display !== 'none') {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });

            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                        'publicLightboxModal'));
                    if (modal) {
                        modal.hide();
                    }
                }
            });
        });
    </script>
@endpush
