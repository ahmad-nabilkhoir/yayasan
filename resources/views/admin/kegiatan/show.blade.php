@extends('layouts.admin')

@section('title', 'Detail Kegiatan')
@section('page-title', 'Detail Kegiatan')

@section('content')
    <div class="container-fluid px-0">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Detail Kegiatan</h5>
                                <p class="text-muted small mb-0">Informasi lengkap kegiatan sekolah</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                                    class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-light rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali
                                </a>
                            </div>
                        </div>

                        <div class="row g-4">
                            {{-- Gambar --}}
                            <div class="col-md-5">
                                @if ($kegiatan->gambar)
                                    <div class="rounded-4 mb-4 overflow-hidden shadow-lg">
                                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid w-100"
                                            style="height: 300px; object-fit: cover;" alt="{{ $kegiatan->judul }}">
                                    </div>
                                @else
                                    <div class="rounded-4 bg-light d-flex align-items-center justify-content-center mb-4 shadow-sm"
                                        style="height: 300px;">
                                        <i class="bi bi-image display-4 text-muted"></i>
                                    </div>
                                @endif

                                {{-- Info Box --}}
                                <div class="card bg-light mb-3 border-0">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-dark mb-3">Informasi Kegiatan</h6>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="small text-muted">Status</div>
                                                @if ($kegiatan->status)
                                                    <span
                                                        class="badge bg-success text-success rounded-pill bg-opacity-10 px-3 py-1">
                                                        <i class="bi bi-eye me-1"></i>Aktif
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-warning text-warning rounded-pill bg-opacity-10 px-3 py-1">
                                                        <i class="bi bi-eye-slash me-1"></i>Nonaktif
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <div class="small text-muted">Urutan</div>
                                                <div class="fw-bold text-dark">{{ $kegiatan->urutan }}</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small text-muted">Dibuat</div>
                                                <div class="fw-bold text-dark">{{ $kegiatan->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small text-muted">Diperbarui</div>
                                                <div class="fw-bold text-dark">{{ $kegiatan->updated_at->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Detail --}}
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        @php
                                            $warnaClass =
                                                $kegiatan->warna == 'primary'
                                                    ? 'primary'
                                                    : ($kegiatan->warna == 'success'
                                                        ? 'success'
                                                        : ($kegiatan->warna == 'warning'
                                                            ? 'warning'
                                                            : ($kegiatan->warna == 'info'
                                                                ? 'info'
                                                                : ($kegiatan->warna == 'purple'
                                                                    ? 'purple'
                                                                    : 'danger'))));
                                        @endphp
                                        <div class="bg-{{ $warnaClass }} rounded-circle me-3 p-2 text-white">
                                            <i class="bi {{ $kegiatan->ikon ?? 'bi-calendar-event' }} fs-4"></i>
                                        </div>
                                        <h3 class="fw-bold text-dark mb-0">{{ $kegiatan->judul }}</h3>
                                    </div>

                                    <div class="mb-4">
                                        <span
                                            class="badge bg-{{ $warnaClass }} text-{{ $warnaClass }} rounded-pill me-2 bg-opacity-10 px-3 py-2">
                                            <i class="bi bi-tag me-1"></i>
                                            @php
                                                $kategoriLabels = [
                                                    'academic' => 'Akademik',
                                                    'extracurricular' => 'Ekstrakurikuler',
                                                    'competition' => 'Kompetisi',
                                                    'ceremony' => 'Upacara',
                                                    'field_trip' => 'Field Trip',
                                                    'social' => 'Sosial',
                                                    'art' => 'Seni & Budaya',
                                                    'sport' => 'Olahraga',
                                                    'religious' => 'Keagamaan',
                                                ];
                                            @endphp
                                            {{ $kategoriLabels[$kegiatan->kategori] ?? 'Umum' }}
                                        </span>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold text-dark mb-2">Deskripsi Kegiatan</h6>
                                        <div class="text-muted" style="line-height: 1.8;">
                                            {{ $kegiatan->deskripsi }}
                                        </div>
                                    </div>

                                    @if ($kegiatan->tags && count($kegiatan->tags) > 0)
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-dark mb-2">Tags</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($kegiatan->tags as $tag)
                                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                                        <i class="bi bi-hash me-1"></i>{{ $tag }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="d-flex gap-3">
                                        <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                                            class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-pencil me-1"></i>Edit Kegiatan
                                        </a>
                                        <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-pill px-4"
                                                onclick="return confirm('Hapus kegiatan ini?')">
                                                <i class="bi bi-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
