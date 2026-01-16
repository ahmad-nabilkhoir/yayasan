@extends('layouts.admin')

@section('title', 'Data Pendaftar PPDB')
@section('page-title', 'Manajemen PPDB')
@section('page-icon', 'bi-person-plus')

@section('content')
    <div class="container-fluid px-0">
        {{-- Page Header --}}
        <div class="admin-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-user-graduate text-primary fa-2x"></i>
                            </div>
                            <div>
                                <h2 class="h4 fw-bold mb-1">Data Pendaftar PPDB</h2>
                                <p class="text-muted mb-0">Kelola data calon siswa SD IT Baitul Insan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.registrations.statistics') }}" class="btn btn-outline-primary">
                                <i class="fas fa-chart-bar me-2"></i> Statistik Lengkap
                            </a>

                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-download me-2"></i> Export Data
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.registrations.export', array_merge(request()->query(), ['type' => 'csv'])) }}">
                                            <i class="fas fa-file-csv text-success me-2"></i> Export CSV (Excel)
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.registrations.export', ['status' => 'all']) }}">
                                            <i class="fas fa-database me-2"></i> Semua Data
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.registrations.export', ['status' => 'menunggu']) }}">
                                            <i class="fas fa-clock me-2"></i> Data Menunggu
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.registrations.export', ['status' => 'diterima']) }}">
                                            <i class="fas fa-check-circle me-2"></i> Data Diterima
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.registrations.export', ['status' => 'ditolak']) }}">
                                            <i class="fas fa-times-circle me-2"></i> Data Ditolak
                                        </a>
                                    </li>
                                    @if (request()->has('search') || request()->has('tanggal_mulai'))
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.registrations.export', request()->query()) }}">
                                                <i class="fas fa-filter me-2"></i> Data dengan Filter Aktif
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-users text-primary fs-4"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Pendaftar</div>
                                <div class="h3 fw-bold mb-0">{{ number_format($stats['total'] ?? 0) }}</div>
                                <small class="text-muted">
                                    <span class="text-success">+{{ $todayStats['total'] ?? 0 }} hari ini</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Menunggu</div>
                                <div class="h3 fw-bold mb-0">{{ number_format($stats['pending'] ?? 0) }}</div>
                                <small class="text-muted">{{ $persenMenunggu ?? 0 }}% dari total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Diterima</div>
                                <div class="h3 fw-bold mb-0">{{ number_format($stats['accepted'] ?? 0) }}</div>
                                <small class="text-muted">{{ $persenDiterima ?? 0 }}% dari total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-times-circle text-danger fs-4"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Ditolak</div>
                                <div class="h3 fw-bold mb-0">{{ number_format($stats['rejected'] ?? 0) }}</div>
                                <small class="text-muted">{{ $persenDitolak ?? 0 }}% dari total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Rata-rata Harian</div>
                                <div class="h4 fw-bold mb-0">{{ $rataHarian ?? 0 }}</div>
                                <small class="text-muted">pendaftar/hari</small>
                            </div>
                            <div class="bg-primary rounded bg-opacity-10 p-3">
                                <i class="fas fa-calendar-day text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Bulan Ini</div>
                                <div class="h4 fw-bold mb-0">{{ $bulanIni ?? 0 }}</div>
                                <small class="text-muted">
                                    @if ($persentasePertumbuhan > 0)
                                        <span class="text-success">↑ {{ $persentasePertumbuhan }}%</span>
                                    @elseif($persentasePertumbuhan < 0)
                                        <span class="text-danger">↓ {{ abs($persentasePertumbuhan) }}%</span>
                                    @else
                                        <span class="text-muted">→ Stabil</span>
                                    @endif
                                </small>
                            </div>
                            <div class="bg-success rounded bg-opacity-10 p-3">
                                <i class="fas fa-chart-line text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="admin-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Tingkat Penerimaan</div>
                                <div class="h4 fw-bold mb-0">{{ $tingkatPenerimaan ?? 0 }}%</div>
                                <small
                                    class="text-muted">{{ $stats['accepted'] ?? 0 }}/{{ $stats['total'] ?? 0 }}</small>
                            </div>
                            <div class="bg-info rounded bg-opacity-10 p-3">
                                <i class="fas fa-percentage text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="admin-card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-filter text-primary me-2"></i> Filter Data
                    </h5>
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>
            </div>
            <div class="show collapse" id="filterCollapse">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.registrations.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Cari Data</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control form-control-sm" placeholder="Nama, NIK, No. Pendaftaran...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select-sm form-select">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status
                                </option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima
                                </option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                                class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                                class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <a href="{{ route('admin.registrations.index') }}"
                                class="btn btn-outline-secondary btn-sm w-50">
                                <i class="fas fa-redo me-1"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm w-50">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                    </form>

                    {{-- Active Filters --}}
                    @if (request()->hasAny(['search', 'status', 'tanggal_mulai', 'tanggal_akhir']))
                        <div class="border-top mt-3 pt-3">
                            <div class="d-flex align-items-center">
                                <span class="text-muted me-2">Filter Aktif:</span>
                                <div class="d-flex flex-wrap gap-2">
                                    @if (request('search'))
                                        <span class="badge bg-primary">
                                            Pencarian: {{ request('search') }}
                                            <a href="{{ request()->fullUrlWithoutQuery('search') }}"
                                                class="ms-1 text-white">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif

                                    @if (request('status') && request('status') != 'all')
                                        <span class="badge bg-primary">
                                            Status: {{ ucfirst(request('status')) }}
                                            <a href="{{ request()->fullUrlWithoutQuery('status') }}"
                                                class="ms-1 text-white">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif

                                    @if (request('tanggal_mulai'))
                                        <span class="badge bg-primary">
                                            Dari: {{ request('tanggal_mulai') }}
                                            <a href="{{ request()->fullUrlWithoutQuery('tanggal_mulai') }}"
                                                class="ms-1 text-white">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif

                                    @if (request('tanggal_akhir'))
                                        <span class="badge bg-primary">
                                            Sampai: {{ request('tanggal_akhir') }}
                                            <a href="{{ request()->fullUrlWithoutQuery('tanggal_akhir') }}"
                                                class="ms-1 text-white">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="admin-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">
                            <i class="fas fa-list text-primary me-2"></i> Daftar Pendaftar
                            <span class="badge bg-primary ms-2">{{ $registrations->total() }}</span>
                        </h5>
                        <small class="text-muted">
                            Menampilkan {{ $registrations->firstItem() ?? 0 }} - {{ $registrations->lastItem() ?? 0 }}
                            dari {{ $registrations->total() }} data
                        </small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog me-1"></i> Aksi Massal
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="bulkApprove()">
                                        <i class="fas fa-check text-success me-2"></i> Terima Semua
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="bulkReject()">
                                        <i class="fas fa-times text-danger me-2"></i> Tolak Semua
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="bulkDelete()">
                                        <i class="fas fa-trash text-danger me-2"></i> Hapus Semua
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="exportSelected()">
                                        <i class="fas fa-file-export me-2"></i> Export Terpilih
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            <label class="form-check-label text-muted" for="selectAll">
                                Pilih Semua
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table table">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">
                                <input type="checkbox" class="form-check-input" id="selectAllRows">
                            </th>
                            <th width="60" class="text-center">#</th>
                            <th>No Pendaftaran</th>
                            <th>Nama Calon Siswa</th>
                            <th>Asal Sekolah</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($registrations as $index => $item)
                            <tr class="animate-fade-in">
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input row-checkbox"
                                        value="{{ $item->id }}" data-status="{{ $item->status }}">
                                </td>
                                <td class="fw-semibold text-muted text-center">
                                    {{ $registrations->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">{{ $item->no_pendaftaran }}</div>
                                    <small class="text-muted">{{ $item->nik }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->nama }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-user-friends me-1"></i>
                                        {{ $item->nama_ayah }} & {{ $item->nama_ibu }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $item->asal_sekolah }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @if ($item->status === 'diterima')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i> Diterima
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock me-1"></i> Menunggu
                                        </span>
                                    @endif

                                    @if ($item->sudah_dihubungi)
                                        <div class="mt-1">
                                            <small class="text-success">
                                                <i class="fas fa-phone-alt me-1"></i> Sudah dihubungi
                                            </small>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.registrations.show', $item->id) }}"
                                            class="btn btn-sm btn-primary" title="Detail" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if ($item->status === 'menunggu')
                                            <button type="button" class="btn btn-sm btn-success" title="Terima"
                                                data-bs-toggle="tooltip"
                                                onclick="approveRegistration({{ $item->id }})">
                                                <i class="fas fa-check"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger" title="Tolak"
                                                data-bs-toggle="tooltip"
                                                onclick="rejectRegistration({{ $item->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif

                                        {{-- Tombol Hapus dengan route yang benar --}}
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                            data-bs-toggle="tooltip"
                                            onclick="deleteRegistration({{ $item->id }}, '{{ addslashes($item->nama) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-5 text-center">
                                    <div class="text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                        <h5>Belum ada data pendaftar</h5>
                                        <p class="mb-0">Data akan muncul di sini setelah ada yang mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($registrations->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $registrations->firstItem() ?? 0 }} - {{ $registrations->lastItem() ?? 0 }}
                            dari {{ $registrations->total() }} data
                        </div>
                        <div>
                            {{ $registrations->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Export Progress Modal --}}
        <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-file-export me-2"></i>Export Data
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4 text-center">
                            <i class="fas fa-file-excel text-success fa-3x mb-3"></i>
                            <h5>Menyiapkan File Excel</h5>
                            <p class="text-muted">Mohon tunggu sebentar...</p>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 100%"></div>
                        </div>
                        <div class="text-center">
                            <small class="text-muted">Mengekspor {{ $registrations->total() }} data...</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Terakhir update: {{ now()->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.08);
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .tooltip-inner {
            font-size: 0.75rem;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            border: none;
            color: var(--gray-600);
            padding: 0.5rem 0.75rem;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 6px;
            color: white;
        }

        .page-link:hover {
            background-color: var(--gray-100);
        }

        .admin-card .card-header {
            background: linear-gradient(90deg, #f8f9fa, #ffffff);
        }

        .badge.badge-success {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            border: none;
        }

        .badge.badge-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
            border: none;
        }

        .badge.badge-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .dropdown-menu {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--gray-200);
        }

        .progress-bar-animated {
            animation: progress-bar-stripes 1s linear infinite;
        }

        @keyframes progress-bar-stripes {
            0% {
                background-position: 1rem 0;
            }

            100% {
                background-position: 0 0;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Select all checkboxes
            const selectAllCheckbox = document.getElementById('selectAllRows');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const selectAllLabel = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectAllLabel();
                });
                selectAllLabel?.addEventListener('click', function() {
                    selectAllCheckbox.checked = !selectAllCheckbox.checked;
                    selectAllCheckbox.dispatchEvent(new Event('change'));
                });
            }

            // Update select all label
            function updateSelectAllLabel() {
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
                if (selectAllLabel) {
                    selectAllLabel.textContent = checkedCount > 0 ?
                        `Terpilih ${checkedCount} data` :
                        'Pilih Semua';
                }
            }

            // Row checkbox change event
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
                    if (selectAllCheckbox) {
                        selectAllCheckbox.checked = allChecked;
                        selectAllCheckbox.indeterminate = someChecked && !allChecked;
                    }
                    updateSelectAllLabel();
                });
            });
        });

        // Fungsi Approve
        function approveRegistration(id) {
            Swal.fire({
                title: 'Konfirmasi Penerimaan',
                text: "Apakah Anda yakin ingin menerima pendaftaran ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Terima',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`/admin/ppdb/${id}/approve`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value?.success) {
                    // 🔥 BUKA WHATSAPP JIKA ADA URL
                    if (result.value.wa_url) {
                        window.open(result.value.wa_url, '_blank');
                    }
                    Swal.fire({
                        title: 'Berhasil!',
                        text: result.value.message || 'Pendaftaran berhasil diterima',
                        icon: 'success',
                        confirmButtonColor: '#28a745'
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }

        // Fungsi Reject
        function rejectRegistration(id) {
            Swal.fire({
                title: 'Konfirmasi Penolakan',
                text: "Apakah Anda yakin ingin menolak pendaftaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                input: 'textarea',
                inputLabel: 'Alasan Penolakan',
                inputPlaceholder: 'Masukkan alasan penolakan...',
                inputAttributes: {
                    'aria-label': 'Masukkan alasan penolakan'
                },
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Harap isi alasan penolakan!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('catatan_admin', result.value);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    fetch(`/admin/ppdb/${id}/reject`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // 🔥 BUKA WHATSAPP SEGERA SETELAH DAPAT RESPON
                                if (data.wa_url) {
                                    window.open(data.wa_url, '_blank');
                                }
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonColor: '#28a745'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                throw new Error(data.message);
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: error.message,
                                icon: 'error',
                                confirmButtonColor: '#dc3545'
                            });
                        });
                }
            });
        }

        // FUNGSI HAPUS YANG SUDAH DIPERBAIKI
        function deleteRegistration(id, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus data pendaftar:<br><strong>${name}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/ppdb/${id}`;
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        }

        // Fungsi Hapus Massal
        function bulkDelete() {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih data terlebih dahulu',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
                return;
            }
            Swal.fire({
                title: 'Hapus Massal',
                html: `Apakah Anda yakin ingin menghapus <strong>${selectedIds.length}</strong> data pendaftaran?<br><small class="text-danger">Aksi ini tidak dapat dibatalkan!</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/ppdb/bulk-delete';
                    form.style.display = 'none';
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                    const idsField = document.createElement('input');
                    idsField.type = 'hidden';
                    idsField.name = 'ids';
                    idsField.value = JSON.stringify(selectedIds);
                    form.appendChild(csrfToken);
                    form.appendChild(idsField);
                    document.body.appendChild(form);
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        }

        // Fungsi Terima Massal
        function bulkApprove() {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih data terlebih dahulu',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
                return;
            }
            Swal.fire({
                title: 'Terima Massal',
                html: `Apakah Anda yakin ingin menerima <strong>${selectedIds.length}</strong> pendaftaran?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Terima',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/ppdb/bulk-approve';
                    form.style.display = 'none';
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                    const idsField = document.createElement('input');
                    idsField.type = 'hidden';
                    idsField.name = 'ids';
                    idsField.value = JSON.stringify(selectedIds);
                    form.appendChild(csrfToken);
                    form.appendChild(idsField);
                    document.body.appendChild(form);
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        }

        // Fungsi Tolak Massal
        function bulkReject() {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih data terlebih dahulu',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
                return;
            }
            Swal.fire({
                title: 'Tolak Massal',
                html: `Apakah Anda yakin ingin menolak <strong>${selectedIds.length}</strong> pendaftaran?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                input: 'textarea',
                inputLabel: 'Alasan Penolakan',
                inputPlaceholder: 'Masukkan alasan penolakan...',
                inputAttributes: {
                    'aria-label': 'Masukkan alasan penolakan'
                },
                inputValidator: (value) => {
                    if (!value) {
                        return 'Harap isi alasan penolakan!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/ppdb/bulk-reject';
                    form.style.display = 'none';
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
                    const idsField = document.createElement('input');
                    idsField.type = 'hidden';
                    idsField.name = 'ids';
                    idsField.value = JSON.stringify(selectedIds);
                    const catatanField = document.createElement('input');
                    catatanField.type = 'hidden';
                    catatanField.name = 'catatan_admin';
                    catatanField.value = result.value;
                    form.appendChild(csrfToken);
                    form.appendChild(idsField);
                    form.appendChild(catatanField);
                    document.body.appendChild(form);
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        }

        // Fungsi Export Terpilih
        function exportSelected() {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih data terlebih dahulu',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
                return;
            }
            const exportModal = new bootstrap.Modal(document.getElementById('exportModal'));
            exportModal.show();
            setTimeout(() => {
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                formData.append('ids', JSON.stringify(selectedIds));
                fetch('/admin/ppdb/export-selected', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.blob();
                        }
                        throw new Error('Export gagal');
                    })
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = `ppdb-terpilih-${new Date().toISOString().slice(0,10)}.csv`;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        exportModal.hide();
                    })
                    .catch(error => {
                        exportModal.hide();
                        Swal.fire({
                            title: 'Error!',
                            text: error.message,
                            icon: 'error'
                        });
                    });
            }, 1000);
        }

        // Helper function untuk mendapatkan ID yang dipilih
        function getSelectedIds() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            return Array.from(checkboxes).map(cb => parseInt(cb.value));
        }

        // Export trigger for dropdown
        document.querySelectorAll('.dropdown-item[href*="export"]').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!this.getAttribute('href').includes('export')) return;
                e.preventDefault();
                const exportModal = new bootstrap.Modal(document.getElementById('exportModal'));
                exportModal.show();
                setTimeout(() => {
                    window.location.href = this.getAttribute('href');
                    setTimeout(() => exportModal.hide(), 2000);
                }, 500);
            });
        });
    </script>
@endpush
