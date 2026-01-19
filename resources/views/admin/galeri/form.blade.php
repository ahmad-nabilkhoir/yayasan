    @extends('layouts.admin')

    @section('title', isset($galeri) ? 'Edit Foto' : 'Tambah Foto')
    @section('page-title', isset($galeri) ? 'Edit Foto Galeri' : 'Tambah Foto Baru')

    @section('content')
        <div class="container-fluid">
            <div class="mb-4">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-link text-decoration-none text-primary p-0">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Galeri
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">
                            <form
                                action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($galeri))
                                    @method('PUT')
                                @endif

                                {{-- Kategori --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Unit Sekolah <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="flex-grow-1">
                                            <input type="radio" class="btn-check" name="kategori" id="tk"
                                                value="TK"
                                                {{ old('kategori', $galeri->kategori ?? '') == 'TK' ? 'checked' : '' }}
                                                required>
                                            <label class="btn btn-outline-warning w-100 rounded-3 py-2" for="tk">Taman
                                                Kanak-Kanak (TK)</label>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="radio" class="btn-check" name="kategori" id="sd"
                                                value="SD"
                                                {{ old('kategori', $galeri->kategori ?? '') == 'SD' ? 'checked' : '' }}
                                                required>
                                            <label class="btn btn-outline-primary w-100 rounded-3 py-2"
                                                for="sd">Sekolah
                                                Dasar (SD)</label>
                                        </div>
                                    </div>
                                    @error('kategori')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Judul --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Judul Foto / Nama Kegiatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="judul"
                                        class="form-control rounded-3 @error('judul') is-invalid @enderror"
                                        value="{{ old('judul', $galeri->judul ?? '') }}"
                                        placeholder="Contoh: Lomba Mewarnai Tingkat Kabupaten" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Deskripsi Singkat (Opsional)</label>
                                    <textarea name="deskripsi" rows="3" class="form-control rounded-3"
                                        placeholder="Tuliskan sedikit penjelasan tentang kegiatan ini...">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                                </div>

                                {{-- Upload Foto --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Unggah Foto <span class="text-danger">*</span></label>

                                    @if (isset($galeri) && $galeri->foto)
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-2">Foto Saat Ini:</small>
                                            <img src="{{ asset('storage/' . $galeri->foto) }}"
                                                class="rounded-3 border shadow-sm" id="preview-old"
                                                style="max-height: 200px; width: auto;">
                                        </div>
                                    @endif

                                    <div
                                        class="upload-zone rounded-3 bg-light position-relative border-2 border-dashed p-4 text-center">
                                        <input type="file" name="foto" id="fotoInput"
                                            class="position-absolute w-100 h-100 start-0 top-0 cursor-pointer opacity-0"
                                            accept="image/*" onchange="previewImage(this)"
                                            {{ isset($galeri) ? '' : 'required' }}>
                                        @if (isset($galeri))
                                            <small class="text-muted d-block mt-2">
                                                Kosongkan jika tidak ingin mengganti foto
                                            </small>
                                        @endif


                                        <div id="upload-placeholder">
                                            <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 2.5rem;"></i>
                                            <p class="text-muted small mb-0">Klik atau seret foto ke sini</p>
                                            <p class="text-muted small italic">(JPG, PNG, JPEG - Max 5MB)</p>
                                        </div>
                                        <div id="preview-container" class="d-none">
                                            <img id="image-preview" class="img-fluid rounded-3 shadow-sm"
                                                style="max-height: 250px;">
                                            <p class="text-primary small fw-bold mb-0 mt-2">Foto baru siap diunggah</p>
                                        </div>
                                    </div>
                                    @error('foto')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex gap-2 pt-3">
                                    <button type="submit" class="btn btn-primary rounded-pill fw-bold px-5">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ isset($galeri) ? 'Update Perubahan' : 'Simpan Foto' }}
                                    </button>
                                    <a href="{{ route('admin.galeri.index') }}"
                                        class="btn btn-light rounded-pill fw-bold text-muted border px-4">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('styles')
        <style>
            .border-dashed {
                border-style: dashed !important;
                border-color: #dee2e6 !important;
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .upload-zone:hover {
                border-color: #0d6efd !important;
                background-color: #f1f7ff !important;
                transition: 0.3s;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function previewImage(input) {
                const placeholder = document.getElementById('upload-placeholder');
                const container = document.getElementById('preview-container');
                const preview = document.getElementById('image-preview');
                const oldPreview = document.getElementById('preview-old');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        container.classList.remove('d-none');
                        placeholder.classList.add('d-none');
                        if (oldPreview) oldPreview.style.opacity = "0.4";
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

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
