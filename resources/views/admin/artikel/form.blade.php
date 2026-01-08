@extends('layouts.admin')

@section('title', isset($artikel) ? 'Edit ' . $artikel->jenis_label : 'Tulis ' . ($jenis_options[$request->jenis ??
    'artikel'] ?? 'Artikel Baru'))

@section('content')
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    {{ isset($artikel) ? 'Edit ' . $artikel->jenis_label : 'Tulis ' . ($jenis_options[$request->jenis ?? 'artikel'] ?? 'Artikel Baru') }}
                </h3>
                <p class="text-muted mb-0">Kelola informasi publikasi Yayasan Baitul Insan</p>
            </div>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light rounded-pill border px-4">Kembali</a>
        </div>

        <form action="{{ isset($artikel) ? route('admin.artikel.update', $artikel->id) : route('admin.artikel.store') }}"
            method="POST" enctype="multipart/form-data" id="artikelForm">
            @csrf
            @if (isset($artikel))
                @method('PUT')
                <input type="hidden" name="jenis" value="{{ $artikel->jenis }}">
            @else
                <input type="hidden" name="jenis" value="{{ $request->jenis ?? 'artikel' }}">
            @endif

            <div class="row">
                <div class="col-lg-9">
                    <div class="card rounded-4 mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Judul
                                    {{ isset($artikel) ? $artikel->jenis_label : $jenis_options[$request->jenis ?? 'artikel'] ?? 'Artikel' }}</label>
                                <input type="text" name="judul"
                                    class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $artikel->judul ?? '') }}" placeholder="Masukkan judul..."
                                    required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Jenis Konten</label>
                                <select name="jenis" class="@error('jenis') is-invalid @enderror form-select"
                                    id="jenisSelect" {{ isset($artikel) ? 'disabled' : '' }}>
                                    @foreach ($jenis_options as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('jenis', $artikel->jenis ?? ($request->jenis ?? 'artikel')) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (isset($artikel))
                                    <small class="text-muted">Jenis konten tidak dapat diubah setelah dibuat.</small>
                                @endif
                            </div>

                            {{-- Tambahan untuk Jurnal --}}
                            <div id="jurnalFields"
                                style="{{ old('jenis', $artikel->jenis ?? 'artikel') == 'jurnal' ? '' : 'display: none;' }}">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Penulis</label>
                                        <input type="text" name="penulis"
                                            class="form-control @error('penulis') is-invalid @enderror"
                                            value="{{ old('penulis', $artikel->penulis ?? '') }}"
                                            placeholder="Nama penulis jurnal">
                                        @error('penulis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit"
                                            class="form-control @error('tahun_terbit') is-invalid @enderror"
                                            value="{{ old('tahun_terbit', $artikel->tahun_terbit ?? date('Y')) }}"
                                            min="1900" max="{{ date('Y') + 1 }}">
                                        @error('tahun_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Upload File PDF</label>
                                    <input type="file" name="file_pdf"
                                        class="form-control @error('file_pdf') is-invalid @enderror" accept=".pdf">
                                    @error('file_pdf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (isset($artikel) && $artikel->hasPdf())
                                        <div class="mt-2">
                                            <small class="text-muted">File PDF saat ini: </small>
                                            <a href="{{ route('admin.artikel.download.pdf', $artikel->id) }}"
                                                target="_blank" class="text-primary">
                                                <i class="bi bi-file-earmark-pdf"></i> {{ basename($artikel->file_pdf) }}
                                            </a>
                                            <small class="text-muted ms-2">(Biarkan kosong jika tidak ingin
                                                mengubah)</small>
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Referensi</label>
                                    <textarea name="referensi" class="form-control @error('referensi') is-invalid @enderror" rows="3"
                                        placeholder="Daftar referensi...">{{ old('referensi', $artikel->referensi ?? '') }}</textarea>
                                    @error('referensi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Ringkasan (Muncul di Halaman Depan)</label>
                                <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="3"
                                    placeholder="Tulis ringkasan singkat...">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
                                <small class="text-muted">Teks ini akan muncul di bawah judul pada daftar artikel
                                    public.</small>
                                @error('ringkasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Kata Kunci (Keywords)</label>
                                <input type="text" name="keywords"
                                    class="form-control @error('keywords') is-invalid @enderror"
                                    value="{{ old('keywords', isset($artikel) && $artikel->keywords ? implode(', ', $artikel->keywords) : '') }}"
                                    placeholder="Pisahkan dengan koma (contoh: pendidikan, islam, sekolah)">
                                <small class="text-muted">Digunakan untuk SEO dan artikel terkait</small>
                                @error('keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Isi Konten</label>
                                <div class="editor-container">
                                    <textarea name="isi" id="editor">{{ old('isi', $artikel->isi ?? '') }}</textarea>
                                </div>
                                @error('isi')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card rounded-4 mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3">Pengaturan</h6>
                            <div class="mb-3">
                                <label class="form-label small text-muted">Status</label>
                                <select name="status" class="rounded-3 form-select">
                                    <option value="published"
                                        {{ old('status', $artikel->status ?? '') == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="draft"
                                        {{ old('status', $artikel->status ?? '') == 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Simpan</button>
                        </div>
                    </div>

                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3">Thumbnail Utama</h6>
                            @if (isset($artikel) && $artikel->thumbnail)
                                <img src="{{ asset('storage/' . $artikel->thumbnail) }}"
                                    class="img-fluid rounded-3 w-100 mb-3 border shadow-sm">
                            @endif
                            <input type="file" name="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror"
                                {{ !isset($artikel) ? 'required' : '' }}>
                            @error('thumbnail')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 400px;
        }

        .ck-content {
            font-size: 16px;
        }

        #jurnalFields .form-control,
        #jurnalFields .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        #jurnalFields .form-label {
            font-weight: 500;
            color: #495057;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('jenisSelect');
            const jurnalFields = document.getElementById('jurnalFields');

            // Toggle jurnal fields
            function toggleJurnalFields() {
                if (jenisSelect.value === 'jurnal') {
                    jurnalFields.style.display = 'block';

                    // Make PDF required for jurnal
                    const pdfInput = document.querySelector('input[name="file_pdf"]');
                    if (!{{ isset($artikel) && $artikel->hasPdf() ? 'true' : 'false' }}) {
                        pdfInput.required = true;
                    }
                } else {
                    jurnalFields.style.display = 'none';

                    // Remove required from PDF for artikel
                    const pdfInput = document.querySelector('input[name="file_pdf"]');
                    pdfInput.required = false;
                }
            }

            // Initial toggle
            toggleJurnalFields();

            // Add event listener
            jenisSelect.addEventListener('change', toggleJurnalFields);

            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote',
                        'insertTable', 'imageUpload', 'undo', 'redo'
                    ],
                    ckfinder: {
                        uploadUrl: "{{ route('admin.artikel.upload') . '?_token=' . csrf_token() }}"
                    }
                })
                .catch(error => {
                    console.error(error);
                });

            // Form validation
            document.getElementById('artikelForm').addEventListener('submit', function(e) {
                const jenis = jenisSelect.value;
                const pdfInput = document.querySelector('input[name="file_pdf"]');
                const hasExistingPdf = {{ isset($artikel) && $artikel->hasPdf() ? 'true' : 'false' }};

                if (jenis === 'jurnal' && !pdfInput.files.length && !hasExistingPdf) {
                    e.preventDefault();
                    alert('File PDF wajib diupload untuk jurnal.');
                    pdfInput.focus();
                }
            });
        });
    </script>
@endpush
