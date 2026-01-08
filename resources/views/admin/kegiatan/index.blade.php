@extends('layouts.admin')

@section('title', 'Kelola Kegiatan')
@section('page-title', 'Kelola Kegiatan')

@section('content')
    <div class="container-fluid px-0">
        {{-- Header & Add Button --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">Kelola Kegiatan Sekolah</h1>
                <p class="text-muted mb-0">Atur kegiatan yang ditampilkan di halaman depan</p>
            </div>
            <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kegiatan
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card rounded-4 bg-gradient-primary border-0 text-white shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-calendar-event display-6"></i>
                            </div>
                            <div>
                                {{-- PERBAIKAN: Gunakan $stats['total'] dari controller --}}
                                <h2 class="fw-bold mb-0">{{ $stats['total'] ?? \App\Models\Kegiatan::count() }}</h2>
                                <p class="mb-0 opacity-75">Total Kegiatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 bg-gradient-success border-0 text-white shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-check-circle display-6"></i>
                            </div>
                            <div>
                                {{-- PERBAIKAN: Gunakan $stats['active'] dari controller --}}
                                <h2 class="fw-bold mb-0">
                                    {{ $stats['active'] ?? \App\Models\Kegiatan::where('status', true)->count() }}</h2>
                                <p class="mb-0 opacity-75">Aktif (Tampil)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 bg-gradient-warning border-0 text-white shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-eye-slash display-6"></i>
                            </div>
                            <div>
                                {{-- PERBAIKAN: Hitung langsung --}}
                                @php $nonaktifCount = $stats['total'] - $stats['active'] ?? \App\Models\Kegiatan::where('status', false)->count(); @endphp
                                <h2 class="fw-bold mb-0">{{ $nonaktifCount }}</h2>
                                <p class="mb-0 opacity-75">Nonaktif (Draft)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 bg-gradient-info border-0 text-white shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-sort-numeric-down display-6"></i>
                            </div>
                            <div>
                                @php $rataUrutan = \App\Models\Kegiatan::avg('urutan'); @endphp
                                <h2 class="fw-bold mb-0">{{ number_format($rataUrutan, 1) }}</h2>
                                <p class="mb-0 opacity-75">Rata-rata Urutan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table align-middle" id="kegiatanTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 80px">No</th>
                                <th>Judul & Deskripsi</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th class="pe-4 text-end" style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatans as $kegiatan)
                                @php
                                    $hexColors = [
                                        'primary' => '#667eea',
                                        'success' => '#4CAF50',
                                        'warning' => '#FFB300',
                                        'info' => '#00BCD4',
                                        'purple' => '#9C27B0',
                                        'danger' => '#F44336',
                                    ];
                                    $currentColor = $hexColors[$kegiatan->warna] ?? '#667eea';
                                @endphp
                                <tr id="row-{{ $kegiatan->id }}">
                                    <td class="fw-bold text-muted ps-4">
                                        {{ ($kegiatans->currentPage() - 1) * $kegiatans->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if ($kegiatan->gambar)
                                                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                                                        alt="{{ $kegiatan->judul }}" class="rounded-3 object-fit-cover"
                                                        style="width: 60px; height: 60px;">
                                                @else
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ Str::limit($kegiatan->judul, 50) }}</h6>
                                                <p class="text-muted small mb-0">
                                                    {{ Str::limit(strip_tags($kegiatan->deskripsi), 60) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill fw-normal"
                                            style="background-color: {{ $currentColor }}15; color: {{ $currentColor }};">
                                            <i class="bi {{ $kegiatan->ikon }} me-1"></i>
                                            {{ $kegiatan->kategori_label }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($kegiatan->status)
                                            <span
                                                class="badge bg-success-soft text-success border-success border border-opacity-25">
                                                <i class="bi bi-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-danger-soft text-danger border-danger border border-opacity-25">
                                                <i class="bi bi-x-circle me-1"></i>Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $kegiatan->urutan }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
                                                class="btn btn-warning btn-sm rounded-pill px-3 text-white" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm rounded-pill delete-btn px-3"
                                                data-id="{{ $kegiatan->id }}" data-judul="{{ $kegiatan->judul }}"
                                                data-status="{{ $kegiatan->status }}"
                                                data-kategori="{{ $kegiatan->kategori_label }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-5 text-center">
                                        <i class="bi bi-calendar-x display-4 text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada kegiatan ditemukan</p>
                                        <a href="{{ route('admin.kegiatan.create') }}"
                                            class="btn btn-primary btn-sm mt-2">
                                            <i class="bi bi-plus-circle me-1"></i>Tambah Kegiatan Pertama
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($kegiatans->hasPages())
                <div class="card-footer border-0 bg-white px-4 py-3">
                    {{ $kegiatans->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <div class="px-4 pb-4 pt-5 text-center">
                        {{-- Icon Warning --}}
                        <div class="mb-4">
                            <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center bg-opacity-10"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2.5rem;"></i>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h5 class="fw-bold mb-1" style="color: #dc3545;">Hapus Data Kegiatan?</h5>

                        {{-- Description --}}
                        <p class="text-muted small mb-4">
                            Data kegiatan dan gambar akan dihapus permanent!
                        </p>

                        {{-- Activity Details --}}
                        <div class="bg-light rounded-3 mb-4 p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center bg-opacity-25"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-calendar-event text-muted"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0" id="modalJudul">Judul Kegiatan</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <small class="text-muted" id="modalKategori">Kategori</small>
                                        <span class="badge bg-success text-success border-0 bg-opacity-10 px-2 py-1"
                                            id="modalStatus">
                                            <i class="bi bi-check-circle me-1"></i>Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Warning Note --}}
                        <div
                            class="alert alert-warning bg-warning border-warning rounded-3 mb-4 border-opacity-25 bg-opacity-10">
                            <div class="d-flex">
                                <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                                <div>
                                    <small class="fw-bold d-block mb-1">Perhatian:</small>
                                    <small class="d-block">Data yang dihapus tidak dapat dikembalikan</small>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-outline-secondary flex-fill rounded-3 py-2"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                            <form id="deleteForm" method="POST" action="" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100 rounded-3 py-2" id="confirmDelete">
                                    Ya, Hapus!
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #4CAF50 0%, #8BC34A 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #FFB300 0%, #FF9800 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #00BCD4 0%, #0097A7 100%);
        }

        .bg-success-soft {
            background-color: rgba(76, 175, 80, 0.1);
        }

        .bg-danger-soft {
            background-color: rgba(244, 67, 54, 0.1);
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.5rem;
        }

        .delete-btn:hover {
            background-color: var(--bs-danger);
            color: white !important;
        }

        /* Modal Custom Style */
        #deleteModal .modal-content {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        #deleteModal .modal-body {
            padding: 0;
        }

        #deleteModal .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        #deleteModal .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        #deleteModal .btn-outline-secondary {
            border: 2px solid #dee2e6;
            font-weight: 600;
        }

        #deleteModal .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil URL template dari data view
            const DELETE_URL_TEMPLATE = "{{ $deleteUrlTemplate ?? '' }}";

            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const modalJudul = document.getElementById('modalJudul');
            const modalKategori = document.getElementById('modalKategori');
            const modalStatus = document.getElementById('modalStatus');

            let kegiatanId, kegiatanJudul, kegiatanStatus, kegiatanKategori;

            // Delete button click
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    kegiatanId = this.getAttribute('data-id');
                    kegiatanJudul = this.getAttribute('data-judul');
                    kegiatanStatus = this.getAttribute('data-status') === '1';
                    kegiatanKategori = this.getAttribute('data-kategori');

                    // Update modal content
                    modalJudul.textContent = kegiatanJudul;
                    modalKategori.textContent = kegiatanKategori;

                    // Update status badge
                    if (kegiatanStatus) {
                        modalStatus.innerHTML = '<i class="bi bi-check-circle me-1"></i>Aktif';
                        modalStatus.className =
                            'badge bg-success bg-opacity-10 text-success border-0 px-2 py-1';
                    } else {
                        modalStatus.innerHTML = '<i class="bi bi-x-circle me-1"></i>Draft';
                        modalStatus.className =
                            'badge bg-secondary bg-opacity-10 text-secondary border-0 px-2 py-1';
                    }

                    // Set form action using the template
                    if (DELETE_URL_TEMPLATE) {
                        deleteForm.action = DELETE_URL_TEMPLATE.replace(':id', kegiatanId);
                    } else {
                        console.error('DELETE_URL_TEMPLATE tidak ditemukan');
                        // Fallback ke URL lama jika template tidak ditemukan
                        deleteForm.action = `{{ url('admin/kegiatan') }}/${kegiatanId}`;
                    }

                    // Show modal
                    deleteModal.show();
                });
            });

            // Handle form submission
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitButton = document.getElementById('confirmDelete');
                const originalText = submitButton.innerHTML;

                // Show loading state
                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...';
                submitButton.disabled = true;

                // Submit form using fetch
                fetch(this.action, {
                        method: 'POST', // Harus POST karena kita gunakan @method('DELETE') di form
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE' // Ini yang mensimulasikan DELETE
                        })
                    })
                    .then(response => {
                        // Cek status HTTP
                        if (!response.ok) {
                            // Jika status bukan 2xx, coba baca JSON error dari server
                            // Penting: Cek apakah response berupa JSON sebelum parse
                            const contentType = response.headers.get("content-type");
                            if (contentType && contentType.includes("application/json")) {
                                return response.json().then(errorData => {
                                    // Re-throw dengan data error dari server
                                    throw new Error(errorData.message ||
                                        `HTTP error! status: ${response.status}`);
                                });
                            } else {
                                // Jika bukan JSON, artinya mungkin HTML (error page)
                                // Baca teksnya untuk pesan error dasar
                                return response.text().then(text => {
                                    console.error("HTML response received instead of JSON:",
                                        text);
                                    throw new Error(
                                        'Server mengembalikan respon yang tidak valid (bukan JSON). Silakan periksa log server.'
                                        );
                                });
                            }
                        }
                        // Jika response OK, baca JSON data
                        return response.json();
                    })
                    .then(data => {
                        // Tangani response JSON dari server
                        if (data.success) {
                            // Remove row from table
                            const row = document.getElementById(`row-${kegiatanId}`);
                            if (row) {
                                row.remove();
                            }

                            // Show success toast
                            const toast = document.createElement('div');
                            toast.className = 'position-fixed top-0 end-0 p-3';
                            toast.style.zIndex = '1060';
                            toast.innerHTML = `
                            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header bg-success text-white">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <strong class="me-auto">Berhasil</strong>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                                </div>
                                <div class="toast-body">
                                    ${data.message || 'Kegiatan berhasil dihapus'}
                                </div>
                            </div>
                        `;
                            document.body.appendChild(toast);

                            // Auto remove toast after 3 seconds
                            setTimeout(() => {
                                toast.remove();
                            }, 3000);

                            // Close modal
                            deleteModal.hide();

                            // Reload page after 1 second to update stats
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            // Jika server mengembalikan success: false, tampilkan pesan error
                            throw new Error(data.message || 'Gagal menghapus kegiatan.');
                        }
                    })
                    .catch(error => {
                        // Tangani error dari response server atau error jaringan
                        console.error('Error during deletion:', error);

                        // Restore button
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;

                        // Show error alert
                        const errorAlert = document.createElement('div');
                        errorAlert.className = 'position-fixed top-0 end-0 p-3';
                        errorAlert.style.zIndex = '1060';
                        errorAlert.innerHTML = `
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger text-white">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong class="me-auto">Gagal</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                            </div>
                            <div class="toast-body">
                                ${error.message || 'Terjadi kesalahan saat menghapus data.'}
                            </div>
                        </div>
                    `;
                        document.body.appendChild(errorAlert);

                        // Auto remove error after 5 seconds
                        setTimeout(() => {
                            errorAlert.remove();
                        }, 5000);
                    });
            });

            // Handle modal hidden
            deleteModal._element.addEventListener('hidden.bs.modal', function() {
                const submitButton = document.getElementById('confirmDelete');
                submitButton.innerHTML = 'Ya, Hapus!';
                submitButton.disabled = false;
            });
        });
    </script>
@endpush
