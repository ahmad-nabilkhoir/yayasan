@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')
@section('page-title', 'Tambah Kegiatan Baru')

@section('content')
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="judul" class="form-label fw-bold">Judul Kegiatan *</label>
                                <input type="text" class="form-control rounded-3 @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul') }}"
                                    placeholder="Contoh: Field Trip ke Museum Nasional" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi Lengkap *</label>
                                <textarea class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="6" placeholder="Deskripsikan kegiatan secara detail..." required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="form-label fw-bold">Gambar Utama</label>
                                <input type="file" class="form-control rounded-3 @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*">
                                <div class="form-text">Ukuran maksimal 2MB. Format: JPG, PNG</div>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imagePreview" class="d-none mt-3">
                                    <img src="" alt="Preview" class="rounded-3"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            {{-- Section Video --}}
                            <div class="mb-4">
                                <label for="video" class="form-label fw-bold">URL Video YouTube</label>
                                <input type="url" class="form-control rounded-3 @error('video') is-invalid @enderror"
                                    id="video" name="video" value="{{ old('video') }}"
                                    placeholder="https://www.youtube.com/watch?v=...">
                                <div class="form-text">
                                    Masukkan URL YouTube lengkap. Kosongkan jika tidak ada video.
                                </div>
                                @error('video')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="video_file" class="form-label fw-bold">Atau Upload Video File</label>
                                <input type="file"
                                    class="form-control rounded-3 @error('video_file') is-invalid @enderror" id="video_file"
                                    name="video_file" accept="video/mp4,video/webm,video/ogg">
                                <div class="form-text">
                                    Maksimal 50MB. Format: MP4, WebM, OGG.
                                    <strong>Prioritas:</strong> Jika upload file video, URL YouTube akan diabaikan.
                                </div>
                                @error('video_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="kategori" class="form-label fw-bold">Kategori *</label>
                                    <select class="rounded-3 @error('kategori') is-invalid @enderror form-select"
                                        id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="academic" {{ old('kategori') == 'academic' ? 'selected' : '' }}>
                                            Akademik</option>
                                        <option value="extracurricular"
                                            {{ old('kategori') == 'extracurricular' ? 'selected' : '' }}>Ekstrakurikuler
                                        </option>
                                        <option value="competition"
                                            {{ old('kategori') == 'competition' ? 'selected' : '' }}>Kompetisi</option>
                                        <option value="ceremony" {{ old('kategori') == 'ceremony' ? 'selected' : '' }}>
                                            Upacara</option>
                                        <option value="field_trip" {{ old('kategori') == 'field_trip' ? 'selected' : '' }}>
                                            Field Trip</option>
                                        <option value="social" {{ old('kategori') == 'social' ? 'selected' : '' }}>Sosial
                                        </option>
                                        <option value="art" {{ old('kategori') == 'art' ? 'selected' : '' }}>Seni &
                                            Budaya</option>
                                        <option value="sport" {{ old('kategori') == 'sport' ? 'selected' : '' }}>Olahraga
                                        </option>
                                        <option value="religious" {{ old('kategori') == 'religious' ? 'selected' : '' }}>
                                            Keagamaan</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="warna" class="form-label fw-bold">Warna Tema *</label>
                                    <div class="row g-2">
                                        @php
                                            $colors = [
                                                'primary' => '#667eea',
                                                'success' => '#4CAF50',
                                                'warning' => '#FFB300',
                                                'info' => '#00BCD4',
                                                'purple' => '#9C27B0',
                                                'danger' => '#F44336',
                                            ];
                                        @endphp
                                        @foreach ($colors as $key => $color)
                                            <div class="col-4">
                                                <input type="radio" class="btn-check" name="warna"
                                                    id="warna_{{ $key }}" value="{{ $key }}"
                                                    {{ old('warna', 'primary') == $key ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-outline-secondary w-100 rounded-3 d-flex align-items-center justify-content-center"
                                                    for="warna_{{ $key }}" style="height: 45px;">
                                                    <div class="rounded-circle me-2"
                                                        style="width: 20px; height: 20px; background-color: {{ $color }}">
                                                    </div>
                                                    <span class="text-capitalize">{{ $key }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('warna')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="ikon" class="form-label fw-bold">Ikon Bootstrap</label>
                                    <div class="input-group">
                                        <span class="input-group-text rounded-start-3">bi</span>
                                        <input type="text"
                                            class="form-control rounded-end-3 @error('ikon') is-invalid @enderror"
                                            id="ikon" name="ikon" value="{{ old('ikon') }}"
                                            placeholder="book, trophy, palette, etc">
                                        <span class="input-group-text bg-light">bi-<span
                                                id="iconPreview">book</span></span>
                                    </div>
                                    <div class="form-text">
                                        <a href="https://icons.getbootstrap.com/" target="_blank"
                                            class="text-decoration-none">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>Lihat daftar ikon Bootstrap
                                        </a>
                                    </div>
                                    @error('ikon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="urutan" class="form-label fw-bold">Urutan Tampil</label>
                                    <input type="number"
                                        class="form-control rounded-3 @error('urutan') is-invalid @enderror"
                                        id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                                        step="1">
                                    <div class="form-text">Angka lebih kecil akan ditampilkan lebih dulu</div>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="tags" class="form-label fw-bold">Tags (opsional)</label>
                                <input type="text" class="form-control rounded-3 @error('tags') is-invalid @enderror"
                                    id="tags" name="tags" value="{{ old('tags') }}"
                                    placeholder="Pisahkan dengan koma, contoh: pendidikan, outing, siswa">
                                <div class="form-text">Maksimal 5 tags, pisahkan dengan koma</div>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status">
                                        Tampilkan di halaman depan
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-light rounded-3 px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary rounded-3 px-5">
                                    <i class="bi bi-save me-2"></i>Simpan Kegiatan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card rounded-4 mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-info-circle text-primary me-2"></i>Panduan
                        </h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <strong>Judul:</strong> Gunakan judul yang menarik dan deskriptif
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <strong>Deskripsi:</strong> Jelaskan kegiatan secara lengkap
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <strong>Gambar:</strong> Gunakan gambar berkualitas tinggi
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <strong>Video:</strong> URL YouTube atau upload file video
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <strong>Tags:</strong> Tambahkan kata kunci untuk pencarian
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-lightbulb text-warning me-2"></i>Tips Video
                        </h6>
                        <div class="alert alert-light border" role="alert">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-youtube text-danger"></i>
                                </div>
                                <div>
                                    <p class="small mb-0">
                                        <strong>YouTube:</strong> Gunakan URL lengkap seperti:
                                        <code>https://youtube.com/watch?v=VIDEO_ID</code>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-light border" role="alert">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-play-circle text-primary"></i>
                                </div>
                                <div>
                                    <p class="small mb-0">
                                        <strong>Video Lokal:</strong> Format MP4, maksimal 50MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn-check:checked+label {
            border-color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.1) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview
            const imageInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('imagePreview');
            const previewImg = imagePreview.querySelector('img');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });

            // Icon preview
            const iconInput = document.getElementById('ikon');
            const iconPreview = document.getElementById('iconPreview');

            iconInput.addEventListener('input', function() {
                iconPreview.textContent = this.value || 'book';
            });

            // Auto-fill icon based on category
            const categorySelect = document.getElementById('kategori');
            const iconMap = {
                'academic': 'book',
                'extracurricular': 'palette',
                'competition': 'trophy',
                'ceremony': 'flag',
                'field_trip': 'geo-alt',
                'social': 'people',
                'art': 'brush',
                'sport': 'activity',
                'religious': 'house-heart'
            };

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                if (selectedCategory && !iconInput.value) {
                    iconInput.value = iconMap[selectedCategory] || 'calendar-event';
                    iconPreview.textContent = iconInput.value;
                }
            });
        });
    </script>
@endpush
