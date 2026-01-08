@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold text-primary m-0"><i class="fas fa-edit me-2"></i>Edit Isi Konten Yayasan</h6>
            </div>
            <div class="card-body p-md-5 p-4">
                <form action="{{ route('admin.tentang.update', $tentang->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">Judul Halaman</label>
                        <input type="text" name="judul" value="{{ old('judul', $tentang->judul) }}"
                            class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label fw-bold">Isi Konten</label>
                            <span class="badge bg-warning text-dark px-3">Ikon Kuning = Upload Gambar</span>
                        </div>
                        {{-- Textarea murni --}}
                        <textarea name="isi" id="editor" rows="15" class="form-control">{{ old('isi', $tentang->isi) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tentang.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-5">Update Konten</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT LOAD --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor', {
            height: 450,
            // Hapus tab yang tidak perlu agar hanya ada "Unggah"
            removeDialogTabs: 'image:info;image:Link;image:advanced',

            // Setup Route Upload
            filebrowserImageUploadUrl: "{{ route('admin.tentang.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',

            extraPlugins: 'image2,justify,colorbutton,font',

            on: {
                // Logika otomatis buka tab Unggah saat klik ikon gambar
                dialogShow: function(evt) {
                    var dialogName = evt.data.getName();
                    if (dialogName === 'image' || dialogName === 'image2') {
                        this.selectPage('Upload');

                        // Sembunyikan tombol OK sebelum gambar di-upload (opsional agar tidak error URL missing)
                        var okButton = this.getButton('ok');
                        // okButton.hide(); 
                    }
                }
            }
        });

        // CUSTOM CSS UNTUK MODAL (Professional Look)
        CKEDITOR.on('dialogDefinition', function(ev) {
            var dialogName = ev.data.name;
            var dialogDefinition = ev.data.definition;

            if (dialogName === 'image' || dialogName === 'image2') {
                // Ubah Judul Modal
                dialogDefinition.title = 'Upload Gambar Baru';

                // Kustomisasi elemen di dalam tab Upload
                var uploadTab = dialogDefinition.getContents('Upload');

                // Mempercantik tampilan area upload
                uploadTab.elements[0].label = 'Pilih gambar dari perangkat Anda:';
                uploadTab.elements[1].label = 'Klik untuk Memproses Gambar'; // Tombol 'Send it to server'
            }
        });
    </script>

    <style>
        /* CSS INJECTION UNTUK MEMPERCANTIK MODAL CKEDITOR */
        .cke_dialog_container {
            z-index: 99999 !important;
        }

        /* Header Modal */
        .cke_dialog_title {
            background: #4e73df !important;
            /* Biru Profesional */
            color: white !important;
            font-weight: 600 !important;
            padding: 15px !important;
            text-shadow: none !important;
        }

        /* Body Modal */
        .cke_dialog_body {
            border-radius: 12px !important;
            overflow: hidden !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
            border: none !important;
        }

        /* Tombol 'Kirim ke Server' (Upload Button) */
        a.cke_dialog_ui_button_action {
            background: #1cc88a !important;
            /* Hijau Sukses */
            color: white !important;
            border-radius: 6px !important;
            padding: 5px 15px !important;
            transition: all 0.3s ease;
        }

        /* Tombol OK (Selesai) */
        a.cke_dialog_ui_button_ok {
            background: #4e73df !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 8px 20px !important;
        }

        /* Tombol Batal */
        a.cke_dialog_ui_button_cancel {
            border-radius: 6px !important;
        }

        /* Sembunyikan elemen URL yang biasanya muncul otomatis */
        .cke_dialog_ui_labeled_label[for*="txtUrl"],
        input.cke_dialog_ui_input_text[id*="txtUrl"] {
            display: none !important;
        }
    </style>
@endsection
