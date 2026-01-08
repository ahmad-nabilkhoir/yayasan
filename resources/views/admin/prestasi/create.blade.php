@extends('layouts.admin')

@section('title', 'Tambah Prestasi')
@section('page-title', 'Tambah Prestasi Baru')

@section('content')
    <div class="container-fluid px-0">

        {{-- Header Section --}}
        <div class="mb-4">
            <a href="{{ route('admin.prestasi.index') }}"
                class="text-decoration-none d-inline-flex align-items-center text-primary fw-medium mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Prestasi
            </a>
            <h3 class="fw-bold text-dark mb-1">Tambah Prestasi Baru</h3>
            <p class="text-muted">Catat pencapaian membanggakan siswa dan sekolah</p>
        </div>

        <div class="row">
            <div class="col-12 col-lg-9">
                <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">

                            <div class="row g-4">
                                {{-- Judul Prestasi --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Judul Prestasi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="judul" value="{{ old('judul') }}" required
                                        class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror"
                                        placeholder="Contoh: Juara 1 Lomba Tahfidz Tingkat Provinsi">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sekolah/Unit --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Unit Sekolah <span
                                            class="text-danger">*</span></label>
                                    <select name="sekolah" required
                                        class="rounded-3 @error('sekolah') is-invalid @enderror form-select">
                                        <option value="">Pilih Unit</option>
                                        <option value="TK" {{ old('sekolah') == 'TK' ? 'selected' : '' }}>TK IT Baitul
                                            Insan</option>
                                        <option value="SD" {{ old('sekolah') == 'SD' ? 'selected' : '' }}>SD IT Baitul
                                            Insan</option>
                                    </select>
                                    @error('sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Tahun Prestasi <span
                                            class="text-danger">*</span></label>
                                    <select name="tahun" required
                                        class="rounded-3 @error('tahun') is-invalid @enderror form-select">
                                        @for ($y = date('Y'); $y >= 2015; $y--)
                                            <option value="{{ $y }}" {{ old('tahun') == $y ? 'selected' : '' }}>
                                                {{ $y }}</option>
                                        @endfor
                                    </select>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sub Judul --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Sub Judul / Keterangan Singkat</label>
                                    <input type="text" name="sub_judul" value="{{ old('sub_judul') }}"
                                        class="form-control rounded-3 @error('sub_judul') is-invalid @enderror"
                                        placeholder="Contoh: Tingkat Nasional - Diselenggarakan oleh Kemendikbud">
                                    @error('sub_judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Deskripsi Lengkap <span
                                            class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="5" required
                                        class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                                        placeholder="Tuliskan detail prestasi, nama siswa, dan penyelenggara...">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Upload Foto --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Foto Dokumentasi <span
                                            class="text-danger">*</span></label>
                                    <div class="upload-zone rounded-4 border-2 border-dashed p-4 text-center transition">
                                        <div id="preview-container" class="d-none mb-3">
                                            <img id="preview-img" src="#"
                                                class="img-fluid rounded-3 mx-auto shadow-sm" style="max-height: 250px;">
                                        </div>

                                        <div id="upload-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted mx-auto mb-3 opacity-50">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-muted small mb-3">Klik tombol di bawah untuk memilih foto
                                                dokumentasi</p>
                                        </div>

                                        <label for="foto"
                                            class="btn btn-outline-primary rounded-pill btn-sm fw-medium px-4">
                                            Pilih File Foto
                                        </label>
                                        <input id="foto" name="foto" type="file" class="d-none" accept="image/*"
                                            required onchange="previewImage(this)">
                                        <p class="text-muted small mb-0 mt-3">PNG, JPG atau JPEG (Maks. 5MB)</p>
                                    </div>
                                    @error('foto')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-light border-0 p-4 text-end">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold px-5 py-2 shadow-sm">
                                Simpan Prestasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card rounded-4 bg-primary mb-4 border-0 text-white shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Info Penting
                        </h6>
                        <ul class="small mb-0 ps-3 opacity-75">
                            <li class="mb-2">Pastikan judul mencantumkan tingkatan lomba.</li>
                            <li class="mb-2">Sub judul bisa diisi keterangan tambahan singkat.</li>
                            <li class="mb-2">Pilih unit sekolah yang sesuai (TK/SD).</li>
                            <li>Sertakan nama lengkap siswa di kolom deskripsi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .upload-zone {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            cursor: pointer;
        }

        .upload-zone:hover {
            border-color: #0d6efd;
            background-color: #f0f7ff;
        }

        .transition {
            transition: all 0.3s ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('d-none');
                    document.getElementById('upload-placeholder').classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
