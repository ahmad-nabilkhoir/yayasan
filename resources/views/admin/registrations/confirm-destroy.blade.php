@extends('layouts.admin')

@section('title', 'Konfirmasi Hapus Data Pendaftar')
@section('page-title', 'Konfirmasi Hapus')
@section('page-icon', 'bi-trash')

@section('content')
    <div class="container-fluid px-0">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Konfirmasi Penghapusan Data
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- Warning Alert --}}
                        <div class="alert alert-danger border-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="alert-heading fw-bold">PERHATIAN!</h5>
                                    <p class="mb-0">
                                        Anda akan menghapus data pendaftar secara permanen. Tindakan ini tidak dapat
                                        dibatalkan!
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Data Preview --}}
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h6 class="border-bottom mb-3 pb-2">Data Calon Siswa</h6>
                                <div class="table-responsive">
                                    <table class="table-sm table">
                                        <tbody>
                                            <tr>
                                                <th width="120">Nama</th>
                                                <td>{{ $registration->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. Pendaftaran</th>
                                                <td>
                                                    <span
                                                        class="badge bg-primary">{{ $registration->no_pendaftaran }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>{{ $registration->nik }}</td>
                                            </tr>
                                            <tr>
                                                <th>Asal Sekolah</th>
                                                <td>{{ $registration->asal_sekolah }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if ($registration->status == 'diterima')
                                                        <span class="badge badge-success">Diterima</span>
                                                    @elseif($registration->status == 'ditolak')
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="border-bottom mb-3 pb-2">Data Orang Tua</h6>
                                <div class="table-responsive">
                                    <table class="table-sm table">
                                        <tbody>
                                            <tr>
                                                <th width="120">Nama Ayah</th>
                                                <td>{{ $registration->nama_ayah }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ibu</th>
                                                <td>{{ $registration->nama_ibu }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. HP Ayah</th>
                                                <td>{{ $registration->no_hp_ayah }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="border-bottom mb-3 mt-4 pb-2">File yang akan dihapus</h6>
                                <div class="list-group">
                                    @php
                                        $files = [
                                            'Pas Foto Anak' => $registration->foto_anak,
                                            'Kartu Keluarga (KK)' => $registration->foto_kk,
                                            'Akte Kelahiran' => $registration->foto_akte,
                                            'KTP Ayah' => $registration->foto_ktp_ayah,
                                            'KTP Ibu' => $registration->foto_ktp_ibu,
                                        ];
                                    @endphp

                                    @foreach ($files as $label => $file)
                                        @if ($file)
                                            <div class="list-group-item list-group-item-action">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fas fa-file text-primary me-2"></i>
                                                        {{ $label }}
                                                    </div>
                                                    <span class="badge bg-danger">Akan dihapus</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Additional Warning --}}
                        <div class="alert alert-warning mt-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <strong>Catatan:</strong> Semua data dan file yang terkait akan dihapus permanen dari
                                    sistem. Pastikan Anda telah membackup data penting sebelum melanjutkan.
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between align-items-center border-top mt-4 pt-3">
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>

                            <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST"
                                id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmFinalDelete()">
                                    <i class="fas fa-trash me-2"></i> Hapus Permanen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmFinalDelete() {
            Swal.fire({
                title: 'Konfirmasi Akhir',
                html: `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                        <h5>Apakah Anda YAKIN?</h5>
                        <p class="text-muted">Data ini akan dihapus selamanya dan tidak dapat dipulihkan.</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'animate__animated animate__shakeX'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus data, harap tunggu.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
@endpush
