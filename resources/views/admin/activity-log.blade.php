@extends('layouts.admin')

@section('title', 'Activity Log')
@section('page-title', 'Log Aktivitas Sistem')

@section('content')
    <div class="container-fluid px-0">
        {{-- Header --}}
        <div class="card rounded-4 mb-4 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">
                            <i class="bi bi-clock-history text-primary fs-5 me-2"></i>Log Aktivitas Sistem
                        </h5>
                        <p class="text-muted small mb-0">Riwayat semua aktivitas dalam sistem</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                {{-- Filter Section --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="searchActivity"
                                placeholder="Cari aktivitas...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterType">
                            <option value="all">Semua Tipe</option>
                            <option value="artikel">Artikel</option>
                            <option value="prestasi">Prestasi</option>
                            <option value="staff">Staff & Guru</option>
                            <option value="galeri">Galeri</option>
                            <option value="kegiatan">Kegiatan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterDate">
                            <option value="all">Semua Waktu</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity List --}}
        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 50px;">#</th>
                                <th style="width: 200px;">Aktivitas</th>
                                <th>Detail</th>
                                <th style="width: 150px;">Tipe</th>
                                <th style="width: 180px;">Waktu</th>
                                <th style="width: 100px;" class="pe-4 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $index => $activity)
                                <tr class="activity-row" data-type="{{ $activity['type'] }}"
                                    data-date="{{ $activity['date']->format('Y-m-d') }}">
                                    <td class="ps-4">
                                        {{ $index + 1 + ($activities->currentPage() - 1) * $activities->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-2 me-3 p-2"
                                                style="background-color: {{ $activity['color'] }}15;">
                                                <i class="bi {{ $activity['icon'] }}"
                                                    style="color: {{ $activity['color'] }}"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">
                                                    {{ $activity['action'] }}
                                                </div>
                                                <div class="small text-muted">{{ $activity['user'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark mb-1">
                                            {{ Str::limit($activity['title'], 60) }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ Str::limit($activity['description'], 80) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-1"
                                            style="background-color: {{ $activity['color'] }}15; color: {{ $activity['color'] }};">
                                            <i class="bi {{ $activity['icon'] }} me-1"></i>
                                            {{ ucfirst($activity['type']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small text-muted">
                                            <div>{{ $activity['date']->format('d M Y') }}</div>
                                            <div>{{ $activity['date']->format('H:i:s') }}</div>
                                        </div>
                                    </td>
                                    <td class="pe-4 text-end">
                                        @if (isset($activity['id']) && isset($activity['type']))
                                            <a href="{{ route('admin.' . $activity['type'] . '.edit', $activity['id']) }}"
                                                class="btn btn-sm btn-light rounded-3 px-3">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-5 text-center">
                                        <div class="mb-3 opacity-25">
                                            <i class="bi bi-inbox display-4 text-muted"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">Belum ada aktivitas</h6>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($activities->hasPages())
                    <div class="card-footer border-top-0 bg-white px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                Menampilkan {{ $activities->firstItem() ?? 0 }} - {{ $activities->lastItem() ?? 0 }} dari
                                {{ $activities->total() }} aktivitas
                            </div>
                            <nav>
                                {{ $activities->links() }}
                            </nav>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .activity-row {
            transition: all 0.3s ease;
        }

        .activity-row:hover {
            background-color: rgba(0, 0, 0, 0.02) !important;
            transform: translateX(3px);
        }

        .table th {
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Search functionality
                const searchInput = document.getElementById('searchActivity');
                const filterType = document.getElementById('filterType');
                const filterDate = document.getElementById('filterDate');
                const activityRows = document.querySelectorAll('.activity-row');

                function filterActivities() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const typeFilter = filterType.value;
                    const dateFilter = filterDate.value;

                    activityRows.forEach(row => {
                        const type = row.getAttribute('data-type');
                        const date = row.getAttribute('data-date');
                        const text = row.textContent.toLowerCase();

                        // Check type filter
                        const typeMatch = typeFilter === 'all' || type === typeFilter;

                        // Check date filter
                        let dateMatch = true;
                        if (dateFilter !== 'all') {
                            const today = new Date().toISOString().split('T')[0];
                            const rowDate = new Date(date);

                            switch (dateFilter) {
                                case 'today':
                                    dateMatch = date === today;
                                    break;
                                case 'week':
                                    const oneWeekAgo = new Date();
                                    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
                                    dateMatch = rowDate >= oneWeekAgo;
                                    break;
                                case 'month':
                                    const oneMonthAgo = new Date();
                                    oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
                                    dateMatch = rowDate >= oneMonthAgo;
                                    break;
                            }
                        }

                        // Check search term
                        const searchMatch = text.includes(searchTerm);

                        // Show/hide row
                        row.style.display = (typeMatch && dateMatch && searchMatch) ? '' : 'none';
                    });
                }

                // Add event listeners
                searchInput.addEventListener('input', filterActivities);
                filterType.addEventListener('change', filterActivities);
                filterDate.addEventListener('change', filterActivities);
            });
        </script>
    @endpush
@endsection
