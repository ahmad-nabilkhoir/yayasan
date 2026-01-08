@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Foto' : 'Upload Foto')
@section('page-title', isset($galeri) ? 'Edit Foto Galeri' : 'Upload Foto Baru')

@section('content')

    <form action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($galeri))
            @method('PUT')
        @endif

        <div class="mx-auto max-w-3xl">
            <div class="space-y-6 rounded-xl bg-white p-8 shadow-md">

                <!-- Kategori -->
                <div>
                    <label class="text-primary mb-2 block text-sm font-semibold">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-4">
                        <label class="flex cursor-pointer items-center">
                            <input type="radio" name="kategori" value="TK"
                                {{ old('kategori', $galeri->kategori ?? '') == 'TK' ? 'checked' : '' }} required
                                class="mr-2">
                            <span class="bg-accent/10 text-accent rounded-lg px-4 py-2 font-semibold">TK</span>
                        </label>
                        <label class="flex cursor-pointer items-center">
                            <input type="radio" name="kategori" value="SD"
                                {{ old('kategori', $galeri->kategori ?? '') == 'SD' ? 'checked' : '' }} required
                                class="mr-2">
                            <span class="bg-secondary/10 text-secondary rounded-lg px-4 py-2 font-semibold">SD</span>
                        </label>
                    </div>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label class="text-primary mb-2 block text-sm font-semibold">
                        Judul Foto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
                        class="border-border focus:ring-primary focus:border-primary @error('judul') border-red-500 @enderror w-full rounded-lg border px-4 py-3 outline-none focus:ring-2"
                        placeholder="Contoh: Kegiatan Outing Class TK">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="text-primary mb-2 block text-sm font-semibold">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="3"
                        class="border-border focus:ring-primary focus:border-primary w-full rounded-lg border px-4 py-3 outline-none focus:ring-2"
                        placeholder="Deskripsi singkat tentang foto ini...">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                </div>

                <!-- Upload Foto -->
                <div>
                    <label class="text-primary mb-2 block text-sm font-semibold">
                        Foto <span class="text-red-500">*</span>
                    </label>

                    @if (isset($galeri) && $galeri->foto)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Current"
                                class="h-64 w-full rounded-lg object-cover" id="preview-current">
                        </div>
                    @endif

                    <div
                        class="border-border hover:border-primary rounded-lg border-2 border-dashed p-8 text-center transition">
                        <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                            {{ isset($galeri) ? '' : 'required' }} onchange="previewImage(this)">
                        <label for="foto" class="cursor-pointer">
                            <div id="preview-container" class="mb-4 hidden">
                                <img id="preview" class="h-64 w-full rounded-lg object-cover">
                            </div>
                            <svg class="text-text-secondary mx-auto mb-3 h-16 w-16" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-text-primary mb-1 font-semibold">Klik untuk upload foto</p>
                            <p class="text-text-secondary text-sm">JPG, PNG, JPEG (Max 5MB)</p>
                        </label>
                    </div>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="bg-primary hover:bg-primary-dark flex-1 rounded-lg px-6 py-3 font-semibold text-white transition">
                        {{ isset($galeri) ? 'Update Foto' : 'Upload Foto' }}
                    </button>
                    <a href="{{ route('admin.galeri.index') }}"
                        class="flex-1 rounded-lg bg-gray-200 px-6 py-3 text-center font-semibold text-gray-700 transition hover:bg-gray-300">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    if (document.getElementById('preview-current')) {
                        document.getElementById('preview-current').classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
