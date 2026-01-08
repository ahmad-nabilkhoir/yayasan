@extends('layouts.admin')

@section('title', 'Edit Prestasi')
@section('page-title', 'Edit Data Prestasi')

@section('content')
    <div class="container-fluid px-0">

        {{-- Header Section --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center mb-md-0 mb-3 gap-3">
                <a href="{{ route('admin.prestasi.index') }}"
                    class="btn btn-white rounded-circle d-flex align-items-center justify-content-center p-2 shadow-sm"
                    style="width: 40px; height: 40px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Edit Prestasi</h3>
                    <span class="text-muted small">ID Prestasi: #{{ $prestasi->id }}</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-9">
                <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card rounded-4 overflow-hidden border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">

                            <div class="row g-4">
                                {{-- Judul Prestasi --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Judul Prestasi</label>
                                    <input type="text" name="judul" value="{{ old('judul', $prestasi->judul) }}"
                                        required
                                        class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan judul prestasi">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sekolah/Unit --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Unit Sekolah</label>
                                    <select name="sekolah" required
                                        class="rounded-3 @error('sekolah') is-invalid @enderror form-select">
                                        <option value="TK" {{ $prestasi->sekolah == 'TK' ? 'selected' : '' }}>TK IT
                                            Baitul Insan</option>
                                        <option value="SD" {{ $prestasi->sekolah == 'SD' ? 'selected' : '' }}>SD IT
                                            Baitul Insan</option>
                                    </select>
                                    @error('sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Tahun</label>
                                    <select name="tahun" required
                                        class="rounded-3 @error('tahun') is-invalid @enderror form-select">
                                        @for ($y = date('Y'); $y >= 2015; $y--)
                                            <option value="{{ $y }}"
                                                {{ $prestasi->tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sub Judul --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Sub Judul / Keterangan Singkat</label>
                                    <input type="text" name="sub_judul"
                                        value="{{ old('sub_judul', $prestasi->sub_judul) }}"
                                        class="form-control rounded-3 @error('sub_judul') is-invalid @enderror"
                                        placeholder="Contoh: Tingkat Nasional - Diselenggarakan oleh Kemendikbud">
                                    @error('sub_judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5" required
                                        class="form-control rounded-3 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Foto Management --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark">Foto Dokumentasi</label>
                                    <div class="rounded-4 bg-light border p-3">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-4 text-center">
                                                <p class="small text-muted mb-2">Preview Foto:</p>
                                                <img id="current-img" src="{{ asset('storage/' . $prestasi->foto) }}"
                                                    class="img-fluid rounded-3 object-fit-cover border shadow-sm"
                                                    style="height: 150px; width: 100%;">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small text-muted">Ganti Foto (Kosongkan jika tidak
                                                    ingin diganti)</label>
                                                <input type="file" name="foto" accept="image/*"
                                                    class="form-control rounded-3" onchange="previewEditImage(this)">
                                                <div class="d-flex align-items-center text-primary small mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        class="me-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Format: JPG, PNG, JPEG (Maks. 5MB)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-light border-0 p-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.prestasi.index') }}"
                                    class="btn btn-light rounded-pill fw-medium border px-4">Batal</a>
                                <button type="submit" class="btn btn-warning rounded-pill fw-bold px-5 py-2 shadow-sm">
                                    Perbarui Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card rounded-4 bg-dark mb-4 border-0 text-white shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="bg-warning rounded-circle d-inline-flex text-dark mb-3 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                            </svg>
                        </div>
                        <h6 class="fw-bold">Mode Edit</h6>
                        <p class="small mb-0 opacity-75">Pastikan data yang diubah sudah tervalidasi dengan sertifikat atau
                            dokumen pendukung.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn-white {
            background-color: #fff;
            color: #6c757d;
            border: 1px solid #edf2f7;
        }

        .btn-white:hover {
            background-color: #f8fafc;
            color: #334155;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function previewEditImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('current-img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
