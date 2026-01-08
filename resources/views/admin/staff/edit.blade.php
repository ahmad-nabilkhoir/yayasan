@extends('layouts.admin')

@section('title', 'Edit Staff: ' . $staff->nama)

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Header --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">Edit Profil Staff</h3>
                        <p class="text-muted small">Memperbarui informasi profil <strong>{{ $staff->nama }}</strong></p>
                    </div>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                    <div class="card-body p-md-5 p-4">
                        <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                {{-- Kolom Kiri: Input Data --}}
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        {{-- Nama --}}
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-dark small">Nama Lengkap & Gelar</label>
                                            <input type="text" name="nama" value="{{ old('nama', $staff->nama) }}"
                                                class="form-control form-control-lg rounded-3 @error('nama') is-invalid @enderror"
                                                required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Jabatan --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Jabatan</label>
                                            <input type="text" name="jabatan"
                                                value="{{ old('jabatan', $staff->jabatan) }}"
                                                class="form-control rounded-3 @error('jabatan') is-invalid @enderror"
                                                required>
                                        </div>

                                        {{-- Kategori --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Kategori</label>
                                            <select name="kategori" class="rounded-3 form-select">
                                                <option value="pimpinan"
                                                    {{ $staff->kategori == 'pimpinan' ? 'selected' : '' }}>Pimpinan Yayasan
                                                </option>
                                                <option value="kepsek" {{ $staff->kategori == 'kepsek' ? 'selected' : '' }}>
                                                    Kepala Sekolah</option>
                                                <option value="guru" {{ $staff->kategori == 'guru' ? 'selected' : '' }}>
                                                    Guru / Staff</option>
                                            </select>
                                        </div>

                                        {{-- Urutan --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-dark small">Urutan Tampil</label>
                                            <input type="number" name="urutan" value="{{ old('urutan', $staff->urutan) }}"
                                                class="form-control rounded-3">
                                            <div class="form-text x-small text-muted italic">Mempengaruhi urutan foto di
                                                website utama.</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan: Foto Profil --}}
                                <div class="col-md-4 border-start-md ps-md-5">
                                    <label class="form-label fw-bold text-dark small d-block mb-3">Foto Profil</label>

                                    <div class="text-center">
                                        <div class="position-relative d-inline-block group-upload">
                                            {{-- Preview Container --}}
                                            <div class="preview-container rounded-4 position-relative overflow-hidden border border-2 border-dashed p-1"
                                                style="cursor: pointer;" onclick="document.getElementById('foto').click()">

                                                <img id="preview-avatar" src="{{ asset('storage/' . $staff->foto) }}"
                                                    class="rounded-4 object-fit-cover shadow-sm transition"
                                                    style="width: 180px; height: 180px;"
                                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($staff->nama) }}&background=f8f9fa&color=dee2e6&size=200'">

                                                <div
                                                    class="upload-overlay rounded-4 d-flex flex-column align-items-center justify-content-center">
                                                    <i class="fas fa-camera fs-4 mb-2 text-white"></i>
                                                    <span class="small fw-bold text-white">Ganti Foto</span>
                                                </div>
                                            </div>

                                            {{-- Floating Button Icon --}}
                                            <label for="foto"
                                                class="btn btn-primary rounded-circle position-absolute border-3 border border-white shadow-lg"
                                                style="width: 48px; height: 48px; bottom: -10px; right: -10px; display: flex; align-items: center; justify-content: center; z-index: 5; cursor: pointer;">
                                                <div
                                                    class="position-relative d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-image fs-5 text-white"></i>
                                                    <i class="fas fa-pencil-alt position-absolute"
                                                        style="font-size: 0.6rem; bottom: -5px; right: -8px; background: #0d6efd; border: 1.5px solid white; border-radius: 4px; padding: 2px;"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <input type="file" name="foto" id="foto"
                                            accept="image/png, image/jpeg, image/jpg" class="d-none"
                                            onchange="previewAvatar(this)">

                                        <div class="mt-4 text-center">
                                            <div id="file-info-badge"
                                                class="badge bg-light text-muted rounded-pill border px-3 py-2">
                                                <i class="fas fa-info-circle text-primary me-1"></i> Biarkan kosong jika
                                                tidak diubah
                                            </div>
                                        </div>
                                        <div id="error-foto-client" class="text-danger x-small fw-bold d-none mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Buttons --}}
                            <div class="border-top d-flex mt-5 gap-2 pt-4">
                                <button type="submit" class="btn btn-primary rounded-pill fw-bold px-5 shadow-sm">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.staff.index') }}"
                                    class="btn btn-light rounded-pill fw-medium border px-4">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .x-small {
            font-size: 0.75rem;
        }

        .italic {
            font-style: italic;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .transition {
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .border-start-md {
                border-left: 1px solid #dee2e6 !important;
            }
        }

        .border-dashed {
            border-style: dashed !important;
            border-color: #dee2e6 !important;
        }

        .preview-container:hover {
            border-color: #0d6efd !important;
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

        .form-control:focus,
        .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
        }

        label[for="foto"]:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }
    </style>
@endsection {{-- INI PERBAIKANNYA: Pakai endsection untuk menutup konten --}}

@push('scripts')
    <script>
        function previewAvatar(input) {
            const preview = document.getElementById('preview-avatar');
            const errorDiv = document.getElementById('error-foto-client');
            const maxSize = 2 * 1024 * 1024; // 2MB

            errorDiv.classList.add('d-none');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (file.size > maxSize) {
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i> File terlalu besar! Maks 2MB.';
                    errorDiv.classList.remove('d-none');
                    input.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.opacity = '0';
                    setTimeout(() => {
                        preview.style.opacity = '1';
                    }, 50);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
