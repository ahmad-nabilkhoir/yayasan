@extends('layouts.admin')

@section('title', 'Kelola Prestasi')
@section('page-title', 'Daftar Prestasi Siswa')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Prestasi</h4>
                <p class="text-muted small mb-0">
                    Total <strong>{{ $prestasi->total() }}</strong> prestasi terdaftar
                </p>
            </div>
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Tambah Prestasi Baru
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Filter & Search --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form id="filterForm" action="{{ route('admin.prestasi.index') }}" method="GET"
                    class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label class="small fw-bold text-muted mb-1">Unit Sekolah</label>
                        <select name="sekolah" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Unit</option>
                            <option value="TK" {{ request('sekolah') == 'TK' ? 'selected' : '' }}>
                                TK Baitul Insan
                            </option>
                            <option value="SD" {{ request('sekolah') == 'SD' ? 'selected' : '' }}>
                                SD IT Baitul Insan
                            </option>
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label class="small fw-bold text-muted mb-1">Cari Judul Prestasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                class="form-control border-start-0" placeholder="Ketik untuk mencari prestasi...">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table-hover mb-0 table align-middle">
                    <thead class="bg-light text-uppercase small">
                        <tr>
                            <th class="ps-4" width="100">Foto</th>
                            <th>Info Prestasi</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Tahun</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasi as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="rounded-3 overflow-hidden shadow-sm" style="width: 65px; height: 65px;">
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            class="w-100 h-100 object-fit-cover"
                                            onerror="this.src='https://placehold.co/200x200?text=No+Img'">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark mb-0">{{ $item->judul }}</div>
                                    <small class="text-muted d-block" style="max-width: 350px;">
                                        {{ Str::limit($item->deskripsi, 70) }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                        {{ $item->sekolah }}
                                    </span>
                                </td>
                                <td class="fw-medium text-center">
                                    {{ $item->tahun }}
                                </td>
                                <td class="px-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.prestasi.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill px-3 text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                            id="delete-form-{{ $item->id }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-center">
                                    <i class="bi bi-trophy text-muted display-6"></i>
                                    <p class="text-muted mt-2">Data prestasi tidak ditemukan.</p>
                                    @if (request()->anyFilled(['search', 'sekolah']))
                                        <a href="{{ route('admin.prestasi.index') }}" class="btn btn-link btn-sm">
                                            Reset Filter
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($prestasi->hasPages())
                <div class="card-footer border-top-0 bg-white py-3">
                    {{ $prestasi->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Prestasi?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Auto Search
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            let timer;

            searchInput.addEventListener('input', function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 700);
            });
        });
    </script>
@endpush
