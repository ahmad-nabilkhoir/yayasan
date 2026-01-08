@extends('layouts.admin')

@section('title', 'Tambah Staff Baru')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Page Header --}}
                <div class="mb-4">
                    <h3 class="fw-bold text-dark mb-1">Tambah Staff / Pengurus</h3>
                    <p class="text-muted small">Input data pengurus yayasan atau staff pendidik baru</p>
                </div>

                <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                    <div class="card-header border-bottom bg-white px-4 py-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-soft text-primary rounded-3 me-3 p-2">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Formulir Data Staff</h6>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                {{-- Kolom Kiri: Input Data --}}
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        {{-- Nama Lengkap --}}
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-dark small">Nama Lengkap & Gelar <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama" value="{{ old('nama') }}"
                                                class="form-control form-control-lg rounded-3 @error('nama') is-invalid @enderror"
                                                placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Pd" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Jabatan --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Jabatan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                                                class="form-control rounded-3 @error('jabatan') is-invalid @enderror"
                                                placeholder="Contoh: Kepala Sekolah" required>
                                            @error('jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Kategori --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Kategori Staff <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori"
                                                class="rounded-3 @error('kategori') is-invalid @enderror form-select"
                                                required>
                                                <option value="" selected disabled>Pilih Kategori...</option>
                                                <option value="pimpinan"
                                                    {{ old('kategori') == 'pimpinan' ? 'selected' : '' }}>Pimpinan Yayasan
                                                </option>
                                                <option value="kepsek" {{ old('kategori') == 'kepsek' ? 'selected' : '' }}>
                                                    Kepala Sekolah</option>
                                                <option value="guru" {{ old('kategori') == 'guru' ? 'selected' : '' }}>
                                                    Guru / Staff</option>
                                            </select>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Urutan --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Urutan Tampil <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="urutan" value="{{ old('urutan', 1) }}"
                                                class="form-control rounded-3 @error('urutan') is-invalid @enderror"
                                                required>
                                            <div class="form-text x-small text-muted italic">Angka terkecil akan tampil
                                                paling pertama.</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan: Foto Profil --}}
                                <div class="col-md-4 text-center">
                                    <label class="form-label fw-bold text-dark small d-block mb-3 text-start">Foto Profil
                                        <span class="text-danger">*</span></label>

                                    <div class="position-relative d-inline-block group-upload">
                                        {{-- Preview Container --}}
                                        <div class="preview-container rounded-4 position-relative overflow-hidden border border-2 border-dashed p-1"
                                            style="cursor: pointer;" onclick="document.getElementById('foto').click()">

                                            <img id="preview-avatar"
                                                src="https://ui-avatars.com/api/?name=Staff+Baru&background=f8f9fa&color=dee2e6&size=200"
                                                class="rounded-4 object-fit-cover shadow-sm transition"
                                                style="width: 180px; height: 180px;">

                                            {{-- Overlay saat Hover --}}
                                            <div
                                                class="upload-overlay rounded-4 d-flex flex-column align-items-center justify-content-center">
                                                <i class="fas fa-cloud-upload-alt fs-4 mb-2 text-white"></i>
                                                <span class="small fw-bold text-white">Pilih Foto</span>
                                            </div>
                                        </div>

                                        {{-- Floating Button Icon --}}
                                        <label for="foto"
                                            class="btn btn-primary rounded-circle position-absolute border-3 border border-white shadow-lg"
                                            style="width: 50px; height: 50px; bottom: -10px; right: -10px; display: flex; align-items: center; justify-content: center; z-index: 5; cursor: pointer;">
                                            <div class="position-relative">
                                                <i class="fas fa-image fs-5"></i>
                                                <i class="fas fa-camera position-absolute"
                                                    style="font-size: 0.7rem; bottom: -5px; right: -8px; background: #0d6efd; padding: 2px; border-radius: 50%;"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <input type="file" name="foto" id="foto"
                                        accept="image/png, image/jpeg, image/jpg"
                                        class="d-none @error('foto') is-invalid @enderror" required
                                        onchange="previewAvatar(this)">

                                    <div class="mt-3">
                                        <div id="file-info-badge"
                                            class="badge bg-light text-muted rounded-pill border px-3 py-2">
                                            <i class="fas fa-info-circle text-primary me-1"></i> Rasio 1:1 | Maks 2MB
                                        </div>
                                    </div>

                                    {{-- Error Client-side --}}
                                    <div id="error-foto-client" class="text-danger x-small fw-bold d-none mt-2"></div>

                                    @error('foto')
                                        <div class="text-danger x-small fw-bold mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="border-top d-flex justify-content-between align-items-center mt-5 pt-4">
                                <a href="{{ route('admin.staff.index') }}"
                                    class="btn btn-light rounded-pill small fw-bold border px-4">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary rounded-pill fw-bold px-5 shadow">
                                    <i class="fas fa-save me-2"></i>Simpan Data Staff
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-primary-soft {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .x-small {
            font-size: 0.75rem;
        }

        .italic {
            font-style: italic;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        .border-dashed {
            border-style: dashed !important;
            border-color: #dee2e6 !important;
            transition: all 0.3s ease;
        }

        .preview-container:hover {
            border-color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.02);
        }

        .upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
        }

        .preview-container:hover .upload-overlay {
            opacity: 1;
        }

        .group-upload:hover #preview-avatar {
            transform: scale(1.02);
        }

        .transition {
            transition: all 0.3s ease;
        }

        label[for="foto"]:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }
    </style>
@endsection

@push('scripts')
    <script>
        function previewAvatar(input) {
            const preview = document.getElementById('preview-avatar');
            const errorDiv = document.getElementById('error-foto-client');
            const badge = document.getElementById('file-info-badge');
            const maxSize = 2 * 1024 * 1024; // 2MB

            // Reset state
            errorDiv.classList.add('d-none');
            badge.className = 'badge bg-light text-muted rounded-pill border px-3 py-2';

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validasi Ukuran
                if (file.size > maxSize) {
                    errorDiv.innerHTML =
                        '<i class="fas fa-exclamation-triangle"></i> Ukuran file terlalu besar! Maksimal 2MB.';
                    errorDiv.classList.remove('d-none');
                    badge.className = 'badge bg-danger text-white rounded-pill border px-3 py-2';
                    input.value = "";
                    preview.src = "https://ui-avatars.com/api/?name=Staff+Baru&background=f8f9fa&color=dee2e6&size=200";
                    return;
                }

                // Preview Gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
