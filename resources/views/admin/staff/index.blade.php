@extends('layouts.admin')

@section('title', 'Manajemen Staff & Guru')
@section('page-title', 'Daftar Tenaga Pendidik')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-dark mb-1">Daftar Tenaga Pendidik</h3>
                <p class="text-muted small mb-0">
                    Kelola pimpinan yayasan, kepala sekolah, dan staf pengajar.
                </p>
            </div>
            <a href="{{ route('admin.staff.create') }}" class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Tambah Staff Baru
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

        {{-- Filter Kategori --}}
        @php
            $kategoriOptions = [
                'pimpinan' => 'Pimpinan Yayasan',
                'kepsek' => 'Kepala Sekolah',
                'guru' => 'Guru & Staf',
            ];
            $currentKategori = request('kategori', '');
        @endphp

        @if ($totalAll > 0)
            <div class="card rounded-4 mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <div>
                            <span class="small fw-bold text-muted">Filter Kategori:</span>
                        </div>
                        <div>
                            <a href="{{ route('admin.staff.index') }}"
                                class="btn btn-sm {{ $currentKategori == '' ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">
                                Semua
                            </a>
                        </div>
                        @foreach ($kategoriOptions as $key => $label)
                            <div>
                                <a href="{{ route('admin.staff.index', ['kategori' => $key]) }}"
                                    class="btn btn-sm {{ $currentKategori == $key ? 'btn-primary' : 'btn-light' }} rounded-pill px-3">
                                    {{ $label }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table-hover mb-0 table align-middle">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="px-4 py-3 text-center" width="80">Urutan</th>
                            <th class="px-4 py-3" width="80">Profil</th>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th class="px-4 py-3">Jabatan</th>
                            <th class="px-4 py-3 text-center">Kategori</th>
                            <th class="px-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark fw-bold border px-3 py-2">
                                        {{ $item->urutan }}
                                    </span>
                                </td>
                                <td class="px-4">
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        class="rounded-circle object-fit-cover border shadow-sm" width="50"
                                        height="50"
                                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=random'">
                                </td>
                                <td class="px-4">
                                    <div class="fw-bold text-dark mb-1">{{ $item->nama }}</div>
                                    <div class="text-muted small">{{ $item->jabatan }}</div>
                                </td>
                                <td class="px-4">
                                    <span
                                        class="badge rounded-pill bg-info text-info border-info-subtle border bg-opacity-10 px-3 py-2">
                                        {{ $item->jabatan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $badgeStyles = [
                                            'pimpinan' => 'bg-purple-subtle text-purple border-purple',
                                            'kepsek' => 'bg-primary-subtle text-primary border-primary',
                                            'guru' => 'bg-success-subtle text-success border-success',
                                        ];
                                        $style = $badgeStyles[$item->kategori] ?? 'bg-light text-dark';

                                        $kategoriLabels = [
                                            'pimpinan' => 'Pimpinan',
                                            'kepsek' => 'Kepala Sekolah',
                                            'guru' => 'Guru & Staf',
                                        ];
                                        $label = $kategoriLabels[$item->kategori] ?? ucfirst($item->kategori);
                                    @endphp
                                    <span class="badge {{ $style }} rounded-pill border px-3 py-2">
                                        @if ($item->kategori == 'kepsek')
                                            <i class="bi bi-award me-1"></i>
                                        @elseif($item->kategori == 'pimpinan')
                                            <i class="bi bi-person-badge me-1"></i>
                                        @else
                                            <i class="bi bi-person-video2 me-1"></i>
                                        @endif
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{-- Preview --}}
                                        <a href="#" class="btn btn-sm btn-light text-secondary rounded-3 border"
                                            data-bs-toggle="modal" data-bs-target="#previewModal{{ $item->id }}"
                                            title="Preview">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.staff.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill px-3 text-white" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        {{-- Delete --}}
                                        <form action="{{ route('admin.staff.destroy', $item->id) }}" method="POST"
                                            id="delete-form-{{ $item->id }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                onclick="confirmDelete('{{ $item->id }}')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Preview Modal --}}
                                    <div class="modal fade" id="previewModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">Preview Staff</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4 text-center">
                                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                                        class="rounded-circle object-fit-cover mb-4 border shadow-sm"
                                                        width="120" height="120"
                                                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=random'">

                                                    <h4 class="fw-bold text-dark mb-2">{{ $item->nama }}</h4>

                                                    <div class="mb-3">
                                                        <span
                                                            class="badge {{ $style }} rounded-pill border px-3 py-2">
                                                            {{ $label }}
                                                        </span>
                                                    </div>

                                                    <div class="bg-light rounded-4 mb-4 p-3">
                                                        <p class="text-muted mb-0">
                                                            <i class="bi bi-briefcase me-2"></i>
                                                            <strong>Jabatan:</strong> {{ $item->jabatan }}
                                                        </p>
                                                        <p class="text-muted mb-0">
                                                            <i class="bi bi-sort-numeric-up me-2"></i>
                                                            <strong>Urutan:</strong> {{ $item->urutan }}
                                                        </p>
                                                    </div>

                                                    <div class="small text-muted">
                                                        <i class="bi bi-clock me-1"></i>
                                                        Diperbarui: {{ $item->updated_at->format('d M Y') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <a href="{{ route('admin.staff.edit', $item->id) }}"
                                                        class="btn btn-warning rounded-pill px-4">
                                                        <i class="bi bi-pencil me-2"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted py-5 text-center">
                                    <i class="bi bi-people display-4"></i>
                                    <p class="mt-2">Data staff belum tersedia.</p>
                                    @if (request('kategori'))
                                        <a href="{{ route('admin.staff.index') }}" class="btn btn-link btn-sm">
                                            Tampilkan Semua Staff
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($staff->hasPages())
                <div class="card-footer border-0 bg-white py-3">
                    {{ $staff->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        {{-- Quick Stats --}}
        @if ($totalAll > 0)
            <div class="row g-4 mt-4">
                <div class="col-md-3">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="bg-purple-subtle text-purple rounded-3 d-inline-block mb-3 p-3">
                                <i class="bi bi-person-badge fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $totalPimpinan }}</h3>
                            <p class="text-muted small mb-0">Pimpinan Yayasan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="bg-primary-subtle text-primary rounded-3 d-inline-block mb-3 p-3">
                                <i class="bi bi-award fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $totalKepsek }}</h3>
                            <p class="text-muted small mb-0">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="bg-success-subtle text-success rounded-3 d-inline-block mb-3 p-3">
                                <i class="bi bi-person-video2 fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $totalGuru }}</h3>
                            <p class="text-muted small mb-0">Guru & Staf</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="bg-info-subtle text-info rounded-3 d-inline-block mb-3 p-3">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $totalAll }}</h3>
                            <p class="text-muted small mb-0">Total Staff</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .bg-purple-subtle {
            background-color: rgba(111, 66, 193, 0.1) !important;
            color: #6f42c1 !important;
            border-color: #d0b5ff !important;
        }

        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1) !important;
            color: #0d6efd !important;
            border-color: #9ec5fe !important;
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1) !important;
            color: #198754 !important;
            border-color: #a3cfbb !important;
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.1) !important;
            color: #0dcaf0 !important;
            border-color: #9eeaf9 !important;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.02);
        }

        .badge {
            font-weight: 500;
        }

        .modal-content {
            border: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Data Staff?',
                text: "Data staff dan foto akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                backdrop: 'rgba(0,0,0,0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Urutan otomatis untuk modal preview
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan event listener untuk tombol preview
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-bs-target');
                    const modalElement = document.querySelector(modalId);
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    }
                });
            });
        });
    </script>
@endpush
