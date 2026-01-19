@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold text-primary m-0"><i class="fas fa-edit me-2"></i>Edit Isi Konten Yayasan</h6>
            </div>
            <div class="card-body p-md-5 p-4">
                <form action="{{ route('admin.tentang.update', $tentang->id) }}" method="POST" id="tentang-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">Judul Halaman</label>
                        <input type="text" name="judul" value="{{ old('judul', $tentang->judul) }}"
                            class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Isi Konten</label>
                        <div class="editor-container">
                            <textarea name="isi" id="editor">{{ old('isi', $tentang->isi) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tentang.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-5">Update Konten</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 450px;
        }

        .ck-content {
            font-size: 16px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editorElement = document.querySelector('#editor');
            if (!editorElement) return;

            ClassicEditor
                .create(editorElement, {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', 'imageUpload', '|',
                        'undo', 'redo'
                    ],
                    ckfinder: {
                        uploadUrl: "{{ route('admin.tentang.upload', ['_token' => csrf_token()]) }}"
                    }
                })
                .then(editor => {
                    // 🔥 INI WAJIB: Sinkronisasi data CKEditor ke <textarea> saat submit
                    document.getElementById('tentang-form').addEventListener('submit', function() {
                        editor.updateSourceElement();
                    });
                })
                .catch(error => {
                    console.error('CKEditor error:', error);
                    editorElement.style.display = 'block';
                });
        });
    </script>
@endpush
