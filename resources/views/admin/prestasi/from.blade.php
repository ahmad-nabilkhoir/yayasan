@extends('layouts.admin')

@section('title', isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi')
@section('page-title', isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi Baru')

@section('content')
    <div class="container-fluid px-0">

        {{-- Header Section --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">{{ isset($prestasi) ? 'Edit Data Prestasi' : 'Tambah Prestasi Baru' }}
                </h3>
                <p class="text-muted small">Kelola informasi pencapaian dan dokumentasi prestasi Yayasan</p>
            </div>
            <a href="{{ route('admin.prestasi.index') }}"
                class="btn btn-light rounded-pill small fw-medium border px-4 shadow-sm">
                Kembali ke Daftar
            </a>
        </div>

        <div class="row">
            <div class="col-12 col-lg-9 mx-auto">
                <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                    <div class="card-body p-md-5 p-4">

                        <form
                            action="{{ isset($prestasi) ? route('admin.prestasi.update', $prestasi->id) : route('admin.prestasi.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($prestasi))
                                @method('PUT')
                            @endif

                            <div class="row g-4">
                                {{-- Judul --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Judul Prestasi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="judul" value="{{ old('judul', $prestasi->judul ?? '') }}"
                                        required
                                        class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror"
                                        placeholder="Contoh: Juara 1 Lomba Matematika Tingkat Kota">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sekolah --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Unit Sekolah <span
                                            class="text-danger">*</span></label>
                                    <select name="sekolah" required
                                        class="rounded-3 @error('sekolah') is-invalid @enderror form-select">
                                        <option value="">Pilih Sekolah</option>
                                        <option value="TK"
                                            {{ old('sekolah', $prestasi->sekolah ?? '') == 'TK' ? 'selected' : '' }}>TK IT
                                            Baitul Insan</option>
                                        <option value="SD"
                                            {{ old('sekolah', $prestasi->sekolah ?? '') == 'SD' ? 'selected' : '' }}>SD IT
                                            Baitul Insan</option>
                                    </select>
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Tahun <span
                                            class="text-danger">*</span></label>
                                    <select name="tahun" required
                                        class="rounded-3 @error('tahun') is-invalid @enderror form-select">
                                        <option value="">Pilih Tahun</option>
                                        @for ($year = date('Y'); $year >= 2010; $year--)
                                            <option value="{{ $year }}"
                                                {{ old('tahun', $prestasi->tahun ?? date('Y')) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                {{-- SUB JUDUL (BARU DITAMBAHKAN) --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Sub Judul / Keterangan Singkat</label>
                                    <input type="text" name="sub_judul"
                                        value="{{ old('sub_judul', $prestasi->sub_judul ?? '') }}"
                                        class="form-control rounded-3 @error('sub_judul') is-invalid @enderror"
                                        placeholder="Contoh: Kategori Seni & Kaligrafi (Akan muncul di atas deskripsi)">
                                    @error('sub_judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="5" required
                                        class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                                        placeholder="Ceritakan detail tentang prestasi ini...">{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
                                </div>

                                {{-- Upload & Preview Foto --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Foto Dokumentasi <span
                                            class="text-danger">*</span></label>
                                    <div
                                        class="upload-area rounded-4 bg-light border-2 border-dashed p-4 text-center transition-all">
                                        <div id="preview-wrapper" class="{{ isset($prestasi) ? '' : 'd-none' }} mb-3">
                                            <img id="image-preview"
                                                src="{{ isset($prestasi) ? asset('storage/' . $prestasi->foto) : '#' }}"
                                                class="img-fluid rounded-3 border shadow-sm"
                                                style="max-height: 300px; object-fit: cover;">
                                        </div>
                                        <div id="upload-placeholder" class="{{ isset($prestasi) ? 'd-none' : '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted mx-auto mb-3 opacity-50">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="fw-medium text-dark mb-1">Klik untuk unggah foto prestasi</p>
                                            <p class="text-muted small">Format: JPG, PNG (Maks. 5MB)</p>
                                        </div>
                                        <input type="file" name="foto" id="foto" accept="image/*" class="d-none"
                                            {{ isset($prestasi) ? '' : 'required' }} onchange="previewImage(this)">
                                        <label for="foto"
                                            class="btn btn-outline-primary btn-sm rounded-pill mt-2 px-4">Pilih File</label>
                                    </div>
                                    @error('foto')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Form Buttons --}}
                                <div class="col-12 border-top mt-5 pt-4">
                                    <div class="d-flex gap-3">
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill fw-bold flex-grow-1 flex-md-grow-0 px-5 py-2 shadow-sm">
                                            {{ isset($prestasi) ? 'Perbarui Data' : 'Simpan Prestasi' }}
                                        </button>
                                        <a href="{{ route('admin.prestasi.index') }}"
                                            class="btn btn-light rounded-pill fw-medium flex-grow-1 flex-md-grow-0 border px-5 py-2">
                                            Batal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
