@extends('layouts.app')

@section('title', 'Preview PDF - ' . $artikel->judul)

@section('content')
    <style>
        .pdf-viewer-container {
            min-height: 80vh;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .pdf-toolbar {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
            border-radius: 1rem 1rem 0 0;
        }

        .pdf-iframe {
            width: 100%;
            height: 70vh;
            border: none;
        }
    </style>

    <div class="container py-5">
        <nav class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel & Jurnal</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('artikel.show', $artikel->slug) }}">{{ Str::limit($artikel->judul, 30) }}</a></li>
                <li class="breadcrumb-item active">Preview PDF</li>
            </ol>
        </nav>

        <div class="pdf-viewer-container">
            <div class="pdf-toolbar d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">{{ $artikel->judul }}</h4>
                    <small class="text-muted">Preview PDF • {{ $artikel->penulis }} • {{ $artikel->tahun_terbit }}</small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('artikel.download.pdf', $artikel->slug) }}" class="btn btn-danger">
                        <i class="bi bi-download me-1"></i> Download
                    </a>
                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <iframe src="{{ $pdfUrl }}" class="pdf-iframe"></iframe>
        </div>

        <div class="mt-4">
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Jika PDF tidak muncul, silakan <a href="{{ route('artikel.download.pdf', $artikel->slug) }}"
                    class="alert-link">download file</a> terlebih dahulu.
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto height adjustment for iframe
        function adjustIframeHeight() {
            const iframe = document.querySelector('.pdf-iframe');
            iframe.style.height = (window.innerHeight * 0.7) + 'px';
        }

        window.addEventListener('resize', adjustIframeHeight);
        document.addEventListener('DOMContentLoaded', adjustIframeHeight);
    </script>
@endpush
