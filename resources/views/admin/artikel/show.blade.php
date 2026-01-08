@extends('layouts.admin')

@section('title', 'Detail Artikel')
@section('page-title', 'Detail Artikel')

@section('content')
    <div class="container-fluid px-0">
        {{-- Header Navigation --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center mb-md-0 mb-3 gap-3">
                <a href="{{ route('admin.artikel.index') }}"
                    class="btn btn-white rounded-circle d-flex align-items-center justify-content-center p-2 shadow-sm"
                    style="width: 40px; height: 40px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Detail Artikel</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb small mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
                            <li class="breadcrumb-item active">Pratinjau</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                    class="btn btn-warning rounded-pill fw-medium px-4 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" class="me-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Artikel
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card rounded-4 mb-5 overflow-hidden border-0 shadow-sm">
                    {{-- Hero Thumbnail --}}
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $artikel->thumbnail) }}" class="img-fluid w-100 object-fit-cover"
                            style="height: 400px;" alt="{{ $artikel->judul }}">
                        <div class="position-absolute w-100 bottom-0 start-0 p-4"
                            style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                            <span
                                class="badge rounded-pill {{ $artikel->status == 'published' ? 'bg-success' : 'bg-warning text-dark' }} mb-2 px-3 py-2 shadow-sm">
                                {{ ucfirst($artikel->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-md-5 p-4">
                        {{-- Meta Info --}}
                        <div
                            class="d-flex align-items-center text-muted border-bottom border-light small mb-4 flex-wrap gap-3 pb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 me-1"></i> {{ $artikel->created_at->format('d F Y') }}
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-eye me-1"></i> Dilihat {{ $artikel->views ?? 0 }} kali
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person me-1"></i> Administrator
                            </div>
                        </div>

                        {{-- Judul --}}
                        <h1 class="fw-extrabold text-dark lh-sm display-6 mb-4">{{ $artikel->judul }}</h1>

                        {{-- KONTAINER READ MORE --}}
                        <div class="position-relative">
                            <div id="articleContent" class="article-body text-secondary lh-lg fs-5 overflow-hidden"
                                style="max-height: 500px; transition: max-height 0.5s ease;">
                                {!! $artikel->isi !!}
                            </div>

                            {{-- Overlay & Tombol --}}
                            <div id="readMoreWrapper" class="position-relative mt-3 text-center">
                                <div id="textOverlay" class="position-absolute w-100 start-0"
                                    style="height: 100px; bottom: 40px; background: linear-gradient(transparent, white); pointer-events: none;">
                                </div>
                                <button type="button" id="btnReadMore" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                    Baca Selengkapnya <i class="bi bi-chevron-down ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-0 p-4 text-center">
                        <p class="text-muted small mb-0">Yayasan Al-Ihsan &copy; {{ date('Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .article-body {
            text-align: justify;
        }

        .fw-extrabold {
            font-weight: 800;
        }

        .btn-white {
            background-color: #fff;
            border: 1px solid #edf2f7;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.getElementById('articleContent');
            const btn = document.getElementById('btnReadMore');
            const wrapper = document.getElementById('readMoreWrapper');
            const overlay = document.getElementById('textOverlay');

            // Jika konten pendek, sembunyikan fitur Read More
            if (content.scrollHeight <= 500) {
                wrapper.style.display = 'none';
                content.style.maxHeight = 'none';
            }

            btn.addEventListener('click', function() {
                if (content.style.maxHeight !== 'none') {
                    content.style.maxHeight = 'none';
                    overlay.classList.add('d-none');
                    btn.innerHTML = 'Tutup Bacaan <i class="bi bi-chevron-up ms-1"></i>';
                } else {
                    content.style.maxHeight = '500px';
                    overlay.classList.remove('d-none');
                    btn.innerHTML = 'Baca Selengkapnya <i class="bi bi-chevron-down ms-1"></i>';
                    // Scroll balik ke atas artikel supaya tidak bingung
                    content.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
