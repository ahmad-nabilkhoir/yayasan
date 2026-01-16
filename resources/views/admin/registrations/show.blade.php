@extends('layouts.admin')

@section('title', 'Detail Pendaftaran - ' . $registration->nama)
@section('page-title', 'Detail Pendaftar')
@section('page-icon', 'bi-person-badge')

@section('content')
    <div class="container-fluid px-0">
        {{-- Header with Actions --}}
        <div class="admin-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary me-3 rounded bg-opacity-10 p-3">
                                <i class="fas fa-user-circle text-primary fa-2x"></i>
                            </div>
                            <div>
                                <h2 class="h4 fw-bold mb-1">{{ $registration->nama }}</h2>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-hashtag me-1"></i>{{ $registration->no_pendaftaran }}
                                    </span>
                                    <span class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>{{ $registration->created_at_formatted }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>

                            @if ($registration->status === 'menunggu')
                                <button type="button" onclick="showApproveModal()" class="btn btn-success">
                                    <i class="fas fa-check me-2"></i> Terima
                                </button>
                                <button type="button" onclick="showRejectModal()" class="btn btn-danger">
                                    <i class="fas fa-times me-2"></i> Tolak
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Banner --}}
        <div class="admin-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <span class="text-muted">Status Pendaftaran</span>
                                @if ($registration->status === 'diterima')
                                    <div class="mt-1">
                                        <span class="badge badge-success px-3 py-2">
                                            <i class="fas fa-check-circle me-2"></i> DITERIMA
                                        </span>
                                    </div>
                                @elseif ($registration->status === 'ditolak')
                                    <div class="mt-1">
                                        <span class="badge badge-danger px-3 py-2">
                                            <i class="fas fa-times-circle me-2"></i> DITOLAK
                                        </span>
                                    </div>
                                @else
                                    <div class="mt-1">
                                        <span class="badge badge-warning px-3 py-2">
                                            <i class="fas fa-clock me-2"></i> MENUNGGU VERIFIKASI
                                        </span>
                                    </div>
                                @endif
                            </div>

                            @if ($registration->sudah_dihubungi)
                                <div class="ms-3">
                                    <span class="badge bg-light text-success border-success border">
                                        <i class="fas fa-phone-alt me-1"></i> Sudah dihubungi
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        @if ($registration->disetujui_oleh)
                            <div class="text-muted">
                                <small>Disetujui oleh: <strong>{{ $registration->disetujui_oleh }}</strong></small><br>
                                <small>{{ $registration->disetujui_pada_formatted ?? \Carbon\Carbon::parse($registration->disetujui_pada)->format('d/m/Y H:i') }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="admin-card mb-4">
            <div class="card-header border-bottom-0 bg-white">
                <ul class="nav nav-tabs justify-content-start" id="detailTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active d-flex align-items-center rounded-top text-secondary gap-2 px-3 py-2 transition"
                            id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab">
                            <i class="fas fa-user"></i> Data Calon Siswa
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link d-flex align-items-center rounded-top text-secondary gap-2 px-3 py-2 transition"
                            id="orangtua-tab" data-bs-toggle="tab" data-bs-target="#orangtua" type="button" role="tab">
                            <i class="fas fa-users"></i> Data Orang Tua
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link d-flex align-items-center rounded-top text-secondary gap-2 px-3 py-2 transition"
                            id="dokumen-tab" data-bs-toggle="tab" data-bs-target="#dokumen" type="button" role="tab">
                            <i class="fas fa-file-alt"></i> Dokumen
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link d-flex align-items-center rounded-top text-secondary gap-2 px-3 py-2 transition"
                            id="catatan-tab" data-bs-toggle="tab" data-bs-target="#catatan" type="button" role="tab">
                            <i class="fas fa-sticky-note"></i> Catatan
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="detailTabsContent">
                    {{-- Tab 1: Data Calon Siswa --}}
                    <div class="tab-pane fade show active" id="data" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label text-muted">Nama Lengkap</label>
                                    <div class="fs-5 fw-semibold">{{ $registration->nama }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">NIK</label>
                                    <div class="font-monospace">{{ $registration->nik }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Tempat, Tanggal Lahir</label>
                                    <div>{{ $registration->tempat_lahir }}, {{ $registration->tanggal_lahir_formatted }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Umur</label>
                                    <div>{{ $registration->umur }} tahun</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label text-muted">Jenis Kelamin</label>
                                    <div>{{ $registration->jenis_kelamin }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Anak Ke</label>
                                    <div>{{ $registration->anak_ke }} dari {{ $registration->dari_bersaudara }} bersaudara
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Asal Sekolah</label>
                                    <div>{{ $registration->asal_sekolah }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Alamat</label>
                                    <div>{{ $registration->alamat }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab 2: Data Orang Tua --}}
                    <div class="tab-pane fade" id="orangtua" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="border-bottom mb-3 pb-2">
                                    <i class="fas fa-male me-2"></i>Data Ayah
                                </h6>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Nama Ayah</label>
                                    <div class="fs-5 fw-semibold">{{ $registration->nama_ayah }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">No. HP Ayah</label>
                                    <div>
                                        <a href="https://wa.me/62{{ substr($registration->no_hp_ayah, 1) }}"
                                            target="_blank" class="text-decoration-none">
                                            <i class="fab fa-whatsapp text-success me-2"></i>
                                            {{ $registration->no_hp_ayah }}
                                            <span class="badge bg-success ms-2">Chat WhatsApp</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="border-bottom mb-3 pb-2">
                                    <i class="fas fa-female me-2"></i>Data Ibu
                                </h6>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Nama Ibu</label>
                                    <div class="fs-5 fw-semibold">{{ $registration->nama_ibu }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">No. HP Ibu</label>
                                    <div>
                                        <a href="https://wa.me/62{{ substr($registration->no_hp_ibu, 1) }}"
                                            target="_blank" class="text-decoration-none">
                                            <i class="fab fa-whatsapp text-success me-2"></i>
                                            {{ $registration->no_hp_ibu }}
                                            <span class="badge bg-success ms-2">Chat WhatsApp</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label text-muted">Penghasilan</label>
                                    <div>{{ $registration->pendapatan }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted">Alamat Orang Tua</label>
                                    <div>{{ $registration->alamat_orang_tua }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab 3: Dokumen --}}
                    <div class="tab-pane fade" id="dokumen" role="tabpanel">
                        <div class="row g-4">
                            @php
                                $documents = [
                                    'Pas Foto 3x4' => $registration->foto_anak,
                                    'Kartu Keluarga (KK)' => $registration->foto_kk,
                                    'Akte Kelahiran' => $registration->foto_akte,
                                    'KTP Ayah' => $registration->foto_ktp_ayah,
                                    'KTP Ibu' => $registration->foto_ktp_ibu,
                                ];
                            @endphp

                            @foreach ($documents as $label => $file)
                                <div class="col-md-4">
                                    <div class="admin-card h-100">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <i class="fas fa-file me-2"></i>{{ $label }}
                                            </h6>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($file && Storage::disk('public')->exists($file))
                                                @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                        class="d-block mb-3">
                                                        <img src="{{ asset('storage/' . $file) }}"
                                                            alt="{{ $label }}" class="img-fluid rounded border"
                                                            style="max-height: 200px; object-fit: cover;">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                        class="d-block mb-3">
                                                        <div class="py-4">
                                                            <i class="fas fa-file-pdf text-danger fa-3x mb-3"></i>
                                                            <p class="mb-0">Klik untuk melihat PDF</p>
                                                        </div>
                                                    </a>
                                                @endif
                                            @else
                                                <div class="py-4">
                                                    <i class="fas fa-file-exclamation text-warning fa-3x mb-3"></i>
                                                    <p class="mb-0">File tidak ditemukan</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary w-100">
                                                <i class="fas fa-external-link-alt me-2"></i>Buka File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tab 4: Catatan --}}
                    <div class="tab-pane fade" id="catatan" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="mb-0">Catatan Admin</h6>
                            <button type="button" onclick="openNotesModal()" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-2"></i> Edit Catatan
                            </button>
                        </div>

                        @if ($registration->catatan_admin)
                            <div class="admin-card">
                                <div class="card-body">
                                    <div style="white-space: pre-line;">{{ $registration->catatan_admin }}</div>
                                </div>
                            </div>
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-sticky-note fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada catatan untuk pendaftaran ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Terima --}}
    <div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Konfirmasi Terima Pendaftaran
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.registrations.approve', $registration->id) }}" method="POST"
                    id="approveForm">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <i class="fas fa-info-circle me-2"></i>
                            Apakah Anda yakin ingin menerima pendaftaran ini?
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tambahkan Catatan (Opsional)</label>
                            <textarea name="catatan_admin" rows="3" class="form-control"
                                placeholder="Masukkan catatan untuk pendaftaran ini...">{{ old('catatan_admin', $registration->catatan_admin) }}</textarea>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Tindakan ini tidak dapat dibatalkan. Pastikan semua dokumen sudah diverifikasi.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-2"></i>Ya, Terima Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-times-circle me-2"></i>Konfirmasi Tolak Pendaftaran
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST"
                    id="rejectForm">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="fas fa-info-circle me-2"></i>
                            Apakah Anda yakin ingin menolak pendaftaran ini?
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="catatan_admin" rows="3" class="form-control" required
                                placeholder="Berikan alasan penolakan pendaftaran ini...">{{ old('catatan_admin', $registration->catatan_admin) }}</textarea>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Pastikan alasan penolakan jelas dan sopan. Tindakan ini tidak dapat dibatalkan.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-2"></i>Ya, Tolak Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Catatan --}}
    <div class="modal fade" id="notesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit Catatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.registrations.update-notes', $registration->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Catatan Admin</label>
                            <textarea name="catatan_admin" rows="8" class="form-control"
                                placeholder="Masukkan catatan untuk pendaftaran ini...">{{ old('catatan_admin', $registration->catatan_admin) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function showApproveModal() {
            const modal = new bootstrap.Modal(document.getElementById('approveModal'));
            modal.show();
        }

        function showRejectModal() {
            const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
            modal.show();
        }

        function openNotesModal() {
            const modal = new bootstrap.Modal(document.getElementById('notesModal'));
            modal.show();
        }

        // Handle form submissions
        document.getElementById('approveForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="loader me-2"></span>Memproses...';
            submitBtn.disabled = true;

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('approveModal')).hide();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#28a745'
                        }).then(() => {
                            // Redirect to WhatsApp if URL exists
                            if (data.wa_url) {
                                window.open(data.wa_url, '_blank');
                            }
                            // Reload page to update status
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#dc3545'
                    });
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                });
        });

        document.getElementById('rejectForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            const textarea = this.querySelector('textarea[name="catatan_admin"]');
            if (!textarea.value.trim()) {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Harap isi alasan penolakan',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
                textarea.focus();
                return;
            }

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="loader me-2"></span>Memproses...';
            submitBtn.disabled = true;

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('rejectModal')).hide();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#28a745'
                        }).then(() => {
                            // Redirect to WhatsApp if URL exists
                            if (data.wa_url) {
                                window.open(data.wa_url, '_blank');
                            }
                            // Reload page to update status
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#dc3545'
                    });
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                });
        });
    </script>
@endpush
