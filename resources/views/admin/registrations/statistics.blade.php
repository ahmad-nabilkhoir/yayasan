@extends('layouts.admin')

@section('title', 'Statistik PPDB')
@section('page-title', 'Statistik PPDB')
@section('page-icon', 'bi-bar-chart')

@section('content')
    <div class="container-fluid px-0">
        {{-- Header --}}
        <div class="admin-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-chart-line text-primary fa-2x"></i>
                            </div>
                            <div>
                                <h2 class="h4 fw-bold mb-1">Statistik PPDB</h2>
                                <p class="text-muted mb-0">Analisis data pendaftaran calon siswa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body text-center">
                        <div class="text-primary mb-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ number_format($total) }}</h3>
                        <p class="text-muted mb-0">Total Pendaftar</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body text-center">
                        <div class="text-success mb-3">
                            <i class="fas fa-check-circle fa-3x"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ number_format($diterima) }}</h3>
                        <p class="text-muted mb-0">Diterima ({{ $persenDiterima }}%)</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body text-center">
                        <div class="text-warning mb-3">
                            <i class="fas fa-clock fa-3x"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ number_format($menunggu) }}</h3>
                        <p class="text-muted mb-0">Menunggu ({{ $persenMenunggu }}%)</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="admin-card h-100">
                    <div class="card-body text-center">
                        <div class="text-danger mb-3">
                            <i class="fas fa-times-circle fa-3x"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ number_format($ditolak) }}</h3>
                        <p class="text-muted mb-0">Ditolak ({{ $persenDitolak }}%)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Statistics --}}
        <div class="row g-4">
            {{-- Left Column --}}
            <div class="col-xl-8">
                {{-- Comparison Card --}}
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Perbandingan Bulanan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="display-6 text-primary">{{ number_format($bulanIni) }}</div>
                                <p class="text-muted">Pendaftar Bulan Ini</p>
                            </div>
                            <div class="col-md-6">
                                <div class="display-6 text-secondary">{{ number_format($bulanLalu) }}</div>
                                <p class="text-muted">Pendaftar Bulan Lalu</p>
                            </div>
                        </div>

                        <div class="progress mt-4" style="height: 25px;">
                            <div class="progress-bar bg-primary"
                                style="width: {{ $persentasePertumbuhan > 0 ? 50 + $persentasePertumbuhan / 2 : 50 + $persentasePertumbuhan / 2 }}%">
                                @if ($persentasePertumbuhan > 0)
                                    <i class="fas fa-arrow-up me-1"></i>Naik {{ $persentasePertumbuhan }}%
                                @elseif($persentasePertumbuhan < 0)
                                    <i class="fas fa-arrow-down me-1"></i>Turun {{ abs($persentasePertumbuhan) }}%
                                @else
                                    <i class="fas fa-minus me-1"></i>Stabil
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Time Distribution --}}
                <div class="admin-card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-clock me-2"></i>Distribusi Jam Pendaftaran
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="rounded border p-3">
                                    <div class="display-6 text-primary">{{ $persenPagi }}%</div>
                                    <p class="mb-0">Pagi</p>
                                    <small class="text-muted">06:00 - 12:00</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="rounded border p-3">
                                    <div class="display-6 text-success">{{ $persenSiang }}%</div>
                                    <p class="mb-0">Siang</p>
                                    <small class="text-muted">12:00 - 18:00</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="rounded border p-3">
                                    <div class="display-6 text-warning">{{ $persenMalam }}%</div>
                                    <p class="mb-0">Malam</p>
                                    <small class="text-muted">18:00 - 24:00</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="rounded border p-3">
                                    <div class="display-6 text-info">{{ $persenDini }}%</div>
                                    <p class="mb-0">Dini Hari</p>
                                    <small class="text-muted">00:00 - 06:00</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-xl-4">
                {{-- Acceptance Rate --}}
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-percentage me-2"></i>Tingkat Penerimaan
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="position-relative mb-4">
                            <canvas id="acceptanceChart" height="150"></canvas>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <div class="display-4 fw-bold text-primary">{{ $tingkatPenerimaan }}%</div>
                            </div>
                        </div>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: {{ $tingkatPenerimaan }}%"></div>
                        </div>
                        <p class="text-muted mb-0">
                            {{ number_format($diterima) }} dari {{ number_format($total) }} pendaftar
                        </p>
                    </div>
                </div>

                {{-- Daily Average --}}
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-calendar-day me-2"></i>Rata-rata Harian
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="display-2 fw-bold text-primary">{{ $rataHarian }}</div>
                        <p class="text-muted mb-0">Pendaftar per hari</p>
                    </div>
                </div>

                {{-- Top Schools --}}
                <div class="admin-card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-school me-2"></i>Top 5 Sekolah Asal
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach ($topSchools as $index => $school)
                                <div
                                    class="list-group-item d-flex align-items-center justify-content-between border-0 px-0">
                                    <div>
                                        <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                        <span class="text-truncate" style="max-width: 200px;">
                                            {{ $school->asal_sekolah }}
                                        </span>
                                    </div>
                                    <span class="badge bg-light text-dark">{{ $school->total }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Income Distribution --}}
        <div class="admin-card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-money-bill-wave me-2"></i>Distribusi Pendapatan Orang Tua
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($incomeStats as $income)
                        <div class="col-md-2 col-sm-4 mb-3">
                            <div class="rounded border p-3 text-center">
                                <div class="h4 fw-bold text-primary mb-2">{{ $income->total }}</div>
                                <p class="small mb-0">{{ $income->pendapatan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pie Chart for Acceptance Rate
                const ctx = document.getElementById('acceptanceChart');
                if (ctx) {
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Diterima', 'Menunggu', 'Ditolak'],
                            datasets: [{
                                data: [{{ $diterima }}, {{ $menunggu }},
                                    {{ $ditolak }}],
                                backgroundColor: [
                                    'rgba(40, 167, 69, 0.8)',
                                    'rgba(255, 193, 7, 0.8)',
                                    'rgba(220, 53, 69, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(40, 167, 69, 1)',
                                    'rgba(255, 193, 7, 1)',
                                    'rgba(220, 53, 69, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = {{ $total }};
                                            const percentage = ((value / total) * 100).toFixed(1);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            },
                            cutout: '70%'
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
