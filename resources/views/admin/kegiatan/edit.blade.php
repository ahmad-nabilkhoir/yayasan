@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')

@section('content')
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.kegiatan.update', $kegiatan) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="judul" class="form-label fw-bold">Judul Kegiatan *</label>
                                <input type="text" class="form-control rounded-3 @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul', $kegiatan->judul) }}"
                                    placeholder="Contoh: Field Trip ke Museum Nasional" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi Lengkap *</label>
                                <textarea class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="6" placeholder="Deskripsikan kegiatan secara detail..." required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="form-label fw-bold">Gambar Utama</label>

                                @if ($kegiatan->gambar)
                                    <div class="mb-3">
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                                                alt="{{ $kegiatan->judul }}" class="rounded-3 mb-2"
                                                style="max-height: 200px; object-fit: cover;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger rounded-circle position-absolute end-0 top-0 m-1"
                                                onclick="document.getElementById('remove_image_check').checked = true; this.previousElementSibling.style.opacity = '0.5';">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remove_image_check"
                                                name="remove_image" value="1">
                                            <label class="form-check-label text-danger" for="remove_image_check">
                                                Centang untuk menghapus gambar saat disimpan
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <input type="file" class="form-control rounded-3 @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*">
                                <div class="form-text">
                                    Biarkan kosong jika tidak ingin mengganti gambar. Ukuran maksimal 2MB.
                                </div>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div id="imagePreview" class="d-none mt-3">
                                    <img src="" alt="Preview" class="rounded-3"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            {{-- Di dalam form, tambahkan: --}}
                            <div class="mb-3">
                                <label for="video" class="form-label">URL Video (YouTube) atau Path Video</label>
                                <input type="text" class="form-control" id="video" name="video"
                                    value="{{ old('video', $kegiatan->video ?? '') }}"
                                    placeholder="Contoh: https://youtube.com/watch?v=... atau upload file video">
                                <small class="text-muted">
                                    Masukkan URL YouTube atau kosongkan jika tidak ada video.
                                    Atau upload file video MP4 di field di bawah.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="video_file" class="form-label">Upload File Video (MP4)</label>
                                <input type="file" class="form-control" id="video_file" name="video_file"
                                    accept="video/mp4,video/webm,video/ogg">
                                <small class="text-muted">
                                    Maksimal 50MB. Format: MP4, WebM, OGG.
                                    @if (isset($kegiatan) && $kegiatan->video && !$kegiatan->is_youtube)
                                        <br>Video saat ini:
                                        <a href="{{ asset('storage/' . $kegiatan->video) }}" target="_blank">
                                            {{ basename($kegiatan->video) }}
                                        </a>
                                    @endif
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="kategori" class="form-label fw-bold">Kategori *</label>
                                    <select class="rounded-3 @error('kategori') is-invalid @enderror form-select"
                                        id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="academic"
                                            {{ old('kategori', $kegiatan->kategori) == 'academic' ? 'selected' : '' }}>
                                            Akademik</option>
                                        <option value="extracurricular"
                                            {{ old('kategori', $kegiatan->kategori) == 'extracurricular' ? 'selected' : '' }}>
                                            Ekstrakurikuler</option>
                                        <option value="competition"
                                            {{ old('kategori', $kegiatan->kategori) == 'competition' ? 'selected' : '' }}>
                                            Kompetisi</option>
                                        <option value="ceremony"
                                            {{ old('kategori', $kegiatan->kategori) == 'ceremony' ? 'selected' : '' }}>
                                            Upacara</option>
                                        <option value="field_trip"
                                            {{ old('kategori', $kegiatan->kategori) == 'field_trip' ? 'selected' : '' }}>
                                            Field Trip</option>
                                        <option value="social"
                                            {{ old('kategori', $kegiatan->kategori) == 'social' ? 'selected' : '' }}>Sosial
                                        </option>
                                        <option value="art"
                                            {{ old('kategori', $kegiatan->kategori) == 'art' ? 'selected' : '' }}>Seni &
                                            Budaya</option>
                                        <option value="sport"
                                            {{ old('kategori', $kegiatan->kategori) == 'sport' ? 'selected' : '' }}>
                                            Olahraga</option>
                                        <option value="religious"
                                            {{ old('kategori', $kegiatan->kategori) == 'religious' ? 'selected' : '' }}>
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
                                                    {{ old('warna', $kegiatan->warna) == $key ? 'checked' : '' }}>
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
                                            id="ikon" name="ikon" value="{{ old('ikon', $kegiatan->ikon) }}"
                                            placeholder="book, trophy, palette, etc">
                                        <span class="input-group-text bg-light">bi-<span
                                                id="iconPreview">{{ $kegiatan->ikon ?? 'book' }}</span></span>
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
                                        id="urutan" name="urutan" value="{{ old('urutan', $kegiatan->urutan) }}"
                                        min="0" step="1">
                                    <div class="form-text">Angka lebih kecil akan ditampilkan lebih dulu</div>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="tags" class="form-label fw-bold">Tags (opsional)</label>
                                <input type="text" class="form-control rounded-3 @error('tags') is-invalid @enderror"
                                    id="tags" name="tags"
                                    value="{{ old('tags', $kegiatan->tags ? implode(', ', $kegiatan->tags) : '') }}"
                                    placeholder="Pisahkan dengan koma, contoh: pendidikan, outing, siswa">
                                <div class="form-text">Maksimal 5 tags, pisahkan dengan koma</div>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status" value="1"
                                        {{ old('status', $kegiatan->status) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status">
                                        <span class="text-success">
                                            <i class="bi bi-check-circle"></i> Publikasikan
                                        </span>
                                        <span class="text-muted small d-block mt-1">
                                            Centang untuk menampilkan di halaman publik, kosongkan untuk menyimpan sebagai
                                            draft
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-light rounded-3 px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary rounded-3 px-5">
                                    <i class="bi bi-save me-2"></i>Update Kegiatan
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
                            <i class="bi bi-info-circle text-primary me-2"></i>Preview
                        </h6>
                        <div class="rounded-3 bg-light border p-3">
                            <div class="d-flex align-items-center mb-3">
                                @php
                                    $warnaClass =
                                        $kegiatan->warna == 'primary'
                                            ? 'primary'
                                            : ($kegiatan->warna == 'success'
                                                ? 'success'
                                                : ($kegiatan->warna == 'warning'
                                                    ? 'warning'
                                                    : ($kegiatan->warna == 'info'
                                                        ? 'info'
                                                        : ($kegiatan->warna == 'purple'
                                                            ? 'purple'
                                                            : 'danger'))));
                                @endphp
                                <div
                                    class="bg-{{ $warnaClass }} text-{{ $warnaClass }} rounded-circle me-3 bg-opacity-10 p-2">
                                    <i class="bi {{ $kegiatan->ikon ?? 'bi-calendar-event' }} fs-4"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-0">{{ $kegiatan->judul }}</h6>
                            </div>
                            <p class="text-muted small mb-3">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                            <div class="d-flex flex-wrap gap-2">
                                <span
                                    class="badge rounded-pill bg-{{ $warnaClass }} text-{{ $warnaClass }} bg-opacity-10">
                                    @php
                                        $kategoriLabels = [
                                            'academic' => 'Akademik',
                                            'extracurricular' => 'Ekstrakurikuler',
                                            'competition' => 'Kompetisi',
                                            'ceremony' => 'Upacara',
                                            'field_trip' => 'Field Trip',
                                            'social' => 'Sosial',
                                            'art' => 'Seni & Budaya',
                                            'sport' => 'Olahraga',
                                            'religious' => 'Keagamaan',
                                        ];
                                    @endphp
                                    {{ $kategoriLabels[$kegiatan->kategori] ?? 'Umum' }}
                                </span>
                                @if ($kegiatan->tags)
                                    @foreach (array_slice($kegiatan->tags, 0, 2) as $tag)
                                        <span
                                            class="badge rounded-pill bg-light text-dark border">{{ $tag }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="border-top mt-3 pt-3">
                                <small class="text-muted">
                                    Status:
                                    @if ($kegiatan->status)
                                        <span class="text-success"><i class="bi bi-check-circle"></i> Aktif (Tampil di
                                            Publik)</span>
                                    @else
                                        <span class="text-danger"><i class="bi bi-eye-slash"></i> Draft (Tidak
                                            Tampil)</span>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-clock-history text-primary me-2"></i>Informasi
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-calendar text-muted me-2"></i>
                                <strong>Dibuat:</strong> {{ $kegiatan->created_at->translatedFormat('d F Y H:i') }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-pencil text-muted me-2"></i>
                                <strong>Diperbarui:</strong> {{ $kegiatan->updated_at->translatedFormat('d F Y H:i') }}
                            </li>
                            <li>
                                <i class="bi bi-hash text-muted me-2"></i>
                                <strong>ID:</strong> {{ $kegiatan->id }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
