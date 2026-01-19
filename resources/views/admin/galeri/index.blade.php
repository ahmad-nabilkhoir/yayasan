@extends('layouts.admin')

@section('page-title', 'Manajemen Galeri')

@section('content')
    <div class="card rounded-4 border-0 p-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">Daftar Foto Kegiatan</h4>
                <p class="text-muted mb-0">Kelola konten galeri yang tampil di website publik</p>
            </div>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Tambah Foto
            </a>
        </div>

        {{-- Stats Cards --}}
        @if (isset($stats) && count($stats) > 0)
            <div class="row mb-4">
                @foreach ($stats as $kategori => $count)
                    <div class="col-md-3 col-6 mb-3">
                        <div class="card rounded-4 h-100 border-0 shadow-sm"
                            style="border-left: 4px solid {{ $colorMap[$kategori] ?? '#0d6efd' }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase text-muted small mb-1">{{ $kategori }}</h6>
                                        <h3 class="fw-bold mb-0">{{ $count }}</h3>
                                    </div>
                                    <div class="icon-container rounded-3 d-flex align-items-center justify-content-center"
                                        style="background: {{ $colorMap[$kategori] ?? '#0d6efd' }}20; width: 48px; height: 48px;">
                                        <i class="bi bi-images" style="color: {{ $colorMap[$kategori] ?? '#0d6efd' }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Filter --}}
        <div class="mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.galeri.index', ['kategori' => 'all']) }}"
                    class="btn btn-sm btn-outline-primary {{ $kategoriFilter == 'all' ? 'active' : '' }}">
                    Semua
                </a>
                @if (isset($allKategoris) && $allKategoris->count() > 0)
                    @foreach ($allKategoris as $kategori)
                        <a href="{{ route('admin.galeri.index', ['kategori' => $kategori]) }}"
                            class="btn btn-sm btn-outline-primary {{ $kategoriFilter == $kategori ? 'active' : '' }}">
                            {{ strtoupper($kategori) }}
                        </a>
                    @endforeach
                @else
                    <a href="{{ route('admin.galeri.index', ['kategori' => 'TK']) }}"
                        class="btn btn-sm btn-outline-primary {{ $kategoriFilter == 'TK' ? 'active' : '' }}">
                        TK
                    </a>
                    <a href="{{ route('admin.galeri.index', ['kategori' => 'SD']) }}"
                        class="btn btn-sm btn-outline-primary {{ $kategoriFilter == 'SD' ? 'active' : '' }}">
                        SD
                    </a>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @forelse ($galeri as $item)
                <div class="col-md-3 admin-galeri-item" data-kategori="{{ $item->kategori }}"
                    style="{{ $kategoriFilter != 'all' && $kategoriFilter != $item->kategori ? 'display: none;' : '' }}">
                    <div class="card h-100 rounded-3 overflow-hidden border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" loading="lazy"
                                style="height: 180px; object-fit: cover;"
                                onerror="this.src='https://via.placeholder.com/300x180/6c757d/ffffff?text=Galeri'">
                            <span class="position-absolute badge rounded-pill start-0 top-0 m-2 px-3 py-1"
                                style="background: {{ $colorMap[$item->kategori] ?? '#0d6efd' }}; color: white;">
                                {{ strtoupper($item->kategori) }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="fw-bold text-truncate mb-2">{{ $item->judul }}</h6>
                            <p class="small text-muted flex-grow-1" style="font-size: 0.85rem;">
                                {{ $item->deskripsi ? \Illuminate\Support\Str::limit($item->deskripsi, 60) : 'Tidak ada deskripsi' }}
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm rounded-pill px-3 text-white">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                        onclick="confirmDelete(this.form, '{{ addslashes($item->judul) }}')">
                                        <i class="bi bi-trash"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center">
                    <i class="bi bi-images text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mb-4 mt-3">Belum ada data galeri.</p>
                    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Foto Pertama
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination dengan Parameter Filter --}}
        @if ($galeri->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($galeri->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $galeri->appends(['kategori' => $kategoriFilter])->previousPageUrl() }}"
                                    rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($galeri->getUrlRange(1, $galeri->lastPage()) as $page => $url)
                            @if ($page == $galeri->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $url }}?kategori={{ $kategoriFilter }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($galeri->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $galeri->appends(['kategori' => $kategoriFilter])->nextPageUrl() }}"
                                    rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .admin-galeri-item {
            transition: all 0.3s ease;
        }

        .admin-galeri-item .card {
            transition: transform 0.3s;
        }

        .admin-galeri-item .card:hover {
            transform: translateY(-5px);
        }

        .icon-container {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-outline-primary.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(form, title) {
            Swal.fire({
                title: 'Hapus Foto?',
                html: `<div class="text-center">
                          <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                          <p class="mt-3"><strong>"${title}"</strong></p>
                          <p class="text-muted">Foto ini akan dihapus permanen.</p>
                       </div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        }

        // Filter functionality untuk animasi di halaman yang sama
        document.addEventListener('DOMContentLoaded', function() {
            // Update active state pada filter links
            const filterButtons = document.querySelectorAll('.btn-outline-primary[href*="kategori="]');
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Tidak perlu event.preventDefault() karena menggunakan link
                });
            });
        });

        function previewImage(input) {
            const file = input.files[0];
            if (!file) return;

            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if (!allowedTypes.includes(file.type)) {
                alert('Format tidak didukung!');
                input.value = '';
                return;
            }

            if (file.size > maxSize) {
                alert('Ukuran maksimal 5MB');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('preview') ||
                    document.getElementById('image-preview');

                if (preview) preview.src = e.target.result;

                document.getElementById('preview-container')?.classList.remove('hidden');
                document.getElementById('preview-container')?.classList.remove('d-none');

                const old = document.getElementById('preview-old') ||
                    document.getElementById('preview-current');

                if (old) old.style.display = 'none';
            };

            reader.readAsDataURL(file);
        }
    </script>
@endpush
