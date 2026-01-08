@extends('layouts.admin')

@section('title', 'Kelola Artikel & Jurnal')
@section('page-title', 'Kelola Artikel & Jurnal')

@section('content')
    <div class="container-fluid px-0">
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Manajemen Artikel & Jurnal</h3>
                <p class="text-muted mb-0">Kelola konten, berita, jurnal, dan publikasi yayasan.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.artikel.create') }}?jenis=artikel"
                    class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i> Buat Artikel
                </a>
                <a href="{{ route('admin.artikel.create') }}?jenis=jurnal"
                    class="btn btn-success rounded-pill fw-bold px-4 shadow-sm">
                    <i class="bi bi-file-earmark-plus me-2"></i> Upload Jurnal
                </a>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="card rounded-4 mb-4 border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="filterForm" method="GET" action="{{ route('admin.artikel.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                class="form-control bg-light border-start-0 py-2" placeholder="Cari judul/penulis...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="jenis" id="jenisSelect" class="bg-light form-select py-2">
                            <option value="">Semua Jenis</option>
                            <option value="artikel" {{ request('jenis') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                            <option value="jurnal" {{ request('jenis') == 'jurnal' ? 'selected' : '' }}>Jurnal</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" id="statusSelect" class="bg-light form-select py-2">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tahun" id="tahunSelect" class="bg-light form-select py-2">
                            <option value="">Semua Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (request('search') || request('jenis') || request('status') || request('tahun'))
                        <div class="col-md-2">
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light w-100 border px-3">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- Tabel Content --}}
        <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table-hover mb-0 table align-middle">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase">
                            <th class="px-4 py-3" style="min-width: 300px;">Info Konten</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Statistik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikel as $item)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                            class="rounded-3 object-fit-cover border shadow-sm" width="60"
                                            height="60">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">{{ Str::limit($item->judul, 50) }}</h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $item->created_at->format('d M Y') }}
                                                @if ($item->penulis)
                                                    <span class="ms-2"><i
                                                            class="bi bi-person me-1"></i>{{ $item->penulis }}</span>
                                                @endif
                                                @if ($item->tahun_terbit)
                                                    <span class="ms-2"><i
                                                            class="bi bi-calendar me-1"></i>{{ $item->tahun_terbit }}</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($item->jenis == 'jurnal')
                                        <span class="badge bg-info rounded-pill px-3 py-2 text-white">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> Jurnal
                                        </span>
                                    @else
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            <i class="bi bi-file-earmark-text me-1"></i> Artikel
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'published')
                                        <span
                                            class="badge bg-success-subtle text-success border-success rounded-pill border border-opacity-25 px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i> Published
                                        </span>
                                    @else
                                        <span
                                            class="badge bg-warning-subtle text-warning border-warning rounded-pill border border-opacity-25 px-3 py-2">
                                            <i class="bi bi-pencil me-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted small text-center">
                                    <i class="bi bi-eye me-1"></i> {{ $item->views ?? 0 }} Views
                                    @if ($item->hasPdf())
                                        <br><i class="bi bi-file-pdf me-1"></i> PDF
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- View --}}
                                        <a href="{{ route('artikel.show', $item->slug) }}" target="_blank"
                                            class="btn btn-sm btn-light text-secondary rounded-3 border"
                                            title="Lihat Publik">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- Download PDF (jika ada) --}}
                                        @if ($item->hasPdf())
                                            <a href="{{ route('admin.artikel.download.pdf', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-3 border text-white"
                                                title="Download PDF">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @endif

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.artikel.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill px-3 text-white" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST"
                                            id="delete-form-{{ $item->id }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                onclick="confirmDelete({{ $item->id }}, '{{ $item->jenis_label }}')"
                                                title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted py-5 text-center">
                                    <i class="bi bi-journal-x display-4"></i>
                                    <p class="mt-2">Tidak ada konten ditemukan.</p>
                                    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mt-2">
                                        Buat Konten Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($artikel->hasPages())
                <div class="card-footer border-0 bg-white py-3">
                    {{ $artikel->links('pagination::bootstrap-5') }}
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

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1) !important;
        }

        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .badge-info {
            background-color: #0dcaf0 !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi Konfirmasi Hapus dengan info jenis
        function confirmDelete(id, jenis) {
            Swal.fire({
                title: 'Hapus ' + jenis + '?',
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

        // Auto Filter & Search
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');
            const jenisSelect = document.getElementById('jenisSelect');
            const statusSelect = document.getElementById('statusSelect');
            const tahunSelect = document.getElementById('tahunSelect');

            // Auto Search dengan debounce
            let timer;
            searchInput.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(() => filterForm.submit(), 800);
            });

            // Auto Filter saat select berubah
            jenisSelect.addEventListener('change', () => filterForm.submit());
            statusSelect.addEventListener('change', () => filterForm.submit());
            tahunSelect.addEventListener('change', () => filterForm.submit());
        });
    </script>
@endpush
