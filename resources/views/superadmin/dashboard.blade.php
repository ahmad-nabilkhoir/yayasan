@extends('superadmin.layout')

@section('title', 'Dashboard Superadmin')

@push('styles')
    <style>
        .border-left-purple {
            border-left: 0.25rem solid #9b59b6 !important;
        }

        .text-purple {
            color: #9b59b6 !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Dashboard Superadmin</h1>
                <p class="text-muted">Halo, {{ auth()->user()->name }}! Kelola seluruh konten beranda dari sini.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <!-- Total Admin -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">Total Admin</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['admins'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Superadmin -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-danger text-uppercase mb-1 text-xs">Superadmin</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['superadmins'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-crown fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artikel -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-success text-uppercase mb-1 text-xs">Artikel</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['artikel'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galeri -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-info text-uppercase mb-1 text-xs">Galeri</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['galeri'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-images fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prestasi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-warning text-uppercase mb-1 text-xs">Prestasi</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['prestasi'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-trophy fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kegiatan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-secondary text-uppercase mb-1 text-xs">Kegiatan</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['kegiatan'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff (Pimpinan) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-dark text-uppercase mb-1 text-xs">Staff (Pimpinan)</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['staff'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PPDB -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-purple h-100 py-2 shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-purple text-uppercase mb-1 text-xs">PPDB</div>
                                <div class="h5 font-weight-bold mb-0 text-gray-800">{{ $stats['ppdb'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions for Homepage Content -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Kelola Konten Beranda</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-user-tie me-1"></i> Pimpinan Yayasan
                            </a>
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-outline-info">
                                <i class="fas fa-calendar-check me-1"></i> Kegiatan
                            </a>
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-success">
                                <i class="fas fa-file-alt me-1"></i> Artikel
                            </a>
                            <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-warning">
                                <i class="fas fa-trophy me-1"></i> Prestasi
                            </a>
                            <a href="{{ route('admin.tentang.index') }}" class="btn btn-outline-dark">
                                <i class="fas fa-building me-1"></i> Tentang Yayasan
                            </a>
                            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-clipboard-list me-1"></i> PPDB
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Lihat Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
