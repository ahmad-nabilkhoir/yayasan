@extends('layouts.admin')

@section('title', 'Manajemen Profil & Staff')
@section('page-title', 'Manajemen Profil Yayasan')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-dark mb-1">Manajemen Profil Yayasan</h3>
                <p class="text-muted small mb-0">Kelola informasi sejarah dan struktur organisasi pengurus</p>
            </div>
            @if (!$tentang)
                <a href="{{ route('admin.tentang.create') }}" class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i>Buat Konten Sejarah
                </a>
            @endif
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Section Sejarah --}}
        <div class="card rounded-4 mb-5 overflow-hidden border-0 shadow-sm">
            <div class="card-header border-bottom bg-white px-4 py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-primary rounded-3 me-3 bg-opacity-10 p-2">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Konten Sejarah</h6>
                </div>
            </div>
            <div class="card-body p-0">
                @if ($tentang)
                    <div class="table-responsive">
                        <table class="table-hover mb-0 table align-middle">
                            <thead class="bg-light text-muted small text-uppercase fw-bold">
                                <tr>
                                    <th class="px-4 py-3">Isi Konten & Informasi Sejarah</th>
                                    <th class="px-4 py-3 text-end" width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-4">
                                        <div class="fw-bold text-dark fs-5 mb-2">
                                            <i class="bi bi-bookmark-star text-primary me-2"></i>
                                            {{ $tentang->judul }}
                                        </div>
                                        <div class="text-muted lh-base">
                                            {{ Str::limit(strip_tags($tentang->isi), 450) }}
                                        </div>
                                    </td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.tentang.edit', $tentang->id) }}"
                                                class="btn btn-warning btn-sm rounded-pill fw-bold px-3 text-white shadow-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm rounded-pill fw-bold px-3"
                                                onclick="confirmDelete('{{ $tentang->id }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-history"
                                            action="{{ route('admin.tentang.destroy', $tentang->id) }}" method="POST"
                                            class="d-none">
                                            @csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-5 text-center">
                        <i class="bi bi-journal-x text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">Konten sejarah yayasan belum dibuat.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Section Staff --}}
        <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center bg-white px-4 py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-success rounded-3 me-3 bg-opacity-10 p-2">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Struktur Pengurus / Staff</h6>
                </div>
                <a href="{{ route('admin.staff.index') }}"
                    class="btn btn-success btn-sm rounded-pill fw-bold px-3 shadow-sm">
                    <i class="bi bi-gear me-1"></i>Kelola Staff
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table align-middle">
                        <thead class="bg-light text-muted small text-uppercase fw-bold">
                            <tr>
                                <th class="py-3 text-center" width="80">Urutan</th>
                                <th class="py-3" width="80">Profil</th>
                                <th class="py-3">Nama Lengkap</th>
                                <th class="py-3">Jabatan</th>
                                <th class="py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staff as $s)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark fw-bold border px-3 py-2">
                                            {{ $s->urutan }}
                                        </span>
                                    </td>
                                    <td class="px-4">
                                        <img src="{{ asset('storage/' . $s->foto) }}"
                                            class="rounded-circle object-fit-cover border shadow-sm" width="45"
                                            height="45"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($s->nama) }}&background=random'">
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">{{ $s->nama }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge rounded-pill bg-info text-info border-info border border-opacity-25 bg-opacity-10 px-3 py-2">
                                            {{ $s->jabatan }}
                                        </span>
                                    </td>
                                    <td class="px-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.staff.edit', $s->id) }}"
                                                class="btn btn-warning btn-sm rounded-pill px-3 text-white">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.staff.destroy', $s->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                    onclick="return confirm('Hapus staff ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-3">Belum ada data pengurus yang ditambahkan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .lh-base {
            line-height: 1.6 !important;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 800px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Hapus konten sejarah ini?')) {
                document.getElementById('delete-history').submit();
            }
        }
    </script>
@endpush
