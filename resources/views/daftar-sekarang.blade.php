<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PPDB - SD IT Baitul Insan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1a44cc;
            --primary-dark: #1635BD;
            --navy-dark: #002366;
            --success-color: #28a745;
            --light-bg: #f8f9fa;
            --whatsapp-green: #25D366;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }

        .header-section {
            background: linear-gradient(135deg, var(--navy-dark), var(--primary-color));
            color: white;
            padding: 2.5rem 0;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 12px rgba(0, 35, 102, 0.15);
            border-radius: 0 0 20px 20px;
        }

        .header-section h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .header-section .lead {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .step-indicator-container {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
        }

        .step-indicator {
            position: relative;
            margin-bottom: 0.5rem;
        }

        .steps-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step:hover .step-circle {
            transform: scale(1.05);
            box-shadow: 0 0 0 8px rgba(26, 68, 204, 0.1);
        }

        .step-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            color: #6c757d;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .step.active .step-circle {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(26, 68, 204, 0.3);
        }

        .step.completed .step-circle {
            background-color: var(--success-color);
            color: white;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .step-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            transition: color 0.3s ease;
        }

        .step.active .step-label {
            color: var(--primary-color);
            font-weight: 700;
        }

        .step.completed .step-label {
            color: var(--success-color);
        }

        .step-connector {
            position: absolute;
            top: 28px;
            left: 50%;
            width: 100%;
            height: 3px;
            background-color: #e9ecef;
            z-index: 1;
            transform: translateY(-50%);
        }

        .step:last-child .step-connector {
            display: none;
        }

        .step.active~.step .step-connector {
            background-color: #e9ecef;
        }

        .step.active .step-connector,
        .step.completed .step-connector {
            background-color: var(--primary-color);
        }

        .step-progress {
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            margin-top: 1.5rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            width: 25%;
            transition: width 0.5s ease;
            border-radius: 3px;
        }

        .form-container {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .form-container.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-counter {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--navy-dark));
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(26, 68, 204, 0.3);
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--navy-dark));
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.25rem;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(26, 68, 204, 0.2);
        }

        .section-title h3 {
            font-weight: 700;
            color: var(--navy-dark);
            margin: 0;
        }

        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-label.required:after {
            content: " *";
            color: #dc3545;
        }

        .form-control,
        .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid #e1e5eb;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(26, 68, 204, 0.15);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e1e5eb;
            font-weight: 500;
        }

        .file-upload-area {
            border: 3px dashed #d1d9e6;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f9fafc;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: rgba(26, 68, 204, 0.03);
            transform: translateY(-2px);
        }

        .file-upload-area i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .file-upload-area p {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #444;
        }

        .file-upload-area small {
            color: #6c757d;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .nav-btn {
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn.prev {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e1e5eb;
        }

        .nav-btn.prev:hover {
            background-color: #e9ecef;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .nav-btn.next {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(26, 68, 204, 0.3);
        }

        .nav-btn.next:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(26, 68, 204, 0.4);
        }

        .submit-btn {
            background: linear-gradient(to right, var(--success-color), #20c997);
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            transform: none;
            box-shadow: none;
        }

        .submit-btn i {
            margin-right: 0.75rem;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.2em;
            margin-right: 0.75rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(26, 68, 204, 0.25);
        }

        .form-check-label {
            line-height: 1.6;
        }

        .contact-info {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
        }

        .contact-info h5 {
            color: var(--navy-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .contact-info h5 i {
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .contact-info p {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }

        .contact-info i {
            color: var(--primary-color);
            width: 20px;
            margin-right: 0.75rem;
        }

        .alert-container {
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #dc3545;
        }

        .success-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .success-modal-overlay.show {
            display: flex;
            opacity: 1;
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .success-modal {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: modalSlideUp 0.5s ease forwards;
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        }

        .registration-number {
            background: linear-gradient(135deg, var(--navy-dark), var(--primary-color));
            color: white;
            font-size: 1.8rem;
            font-weight: 800;
            padding: 1rem 2rem;
            border-radius: 12px;
            margin: 1.5rem 0;
            letter-spacing: 1px;
            box-shadow: 0 6px 15px rgba(26, 68, 204, 0.2);
            font-family: 'Courier New', monospace;
        }

        .copy-btn {
            background-color: #f8f9fa;
            border: 2px solid #e1e5eb;
            color: #6c757d;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .copy-btn:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .copy-btn.copied {
            background-color: var(--success-color);
            color: white;
            border-color: var(--success-color);
        }

        .copy-btn i {
            margin-right: 0.5rem;
        }

        .whatsapp-btn {
            background: linear-gradient(to right, var(--whatsapp-green), #128C7E);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.3);
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-btn i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 68, 204, 0.2);
        }

        .btn-outline-primary i {
            margin-right: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-section {
                padding: 2rem 1rem;
                border-radius: 0 0 15px 15px;
            }

            .header-section h1 {
                font-size: 1.8rem;
            }

            .step-circle {
                width: 48px;
                height: 48px;
                font-size: 1.1rem;
            }

            .step-label {
                font-size: 0.8rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .section-title {
                flex-direction: column;
                text-align: center;
            }

            .section-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .navigation-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-btn {
                width: 100%;
                justify-content: center;
            }

            .contact-info .row {
                flex-direction: column;
            }
        }

        /* Animasi untuk input valid */
        .form-control:valid,
        .form-select:valid {
            border-color: #28a745;
            background-color: rgba(40, 167, 69, 0.05);
        }

        /* Animasi untuk input invalid */
        .form-control:invalid:focus,
        .form-select:invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <h1><i class="fas fa-graduation-cap"></i> FORMULIR PENDAFTARAN PPDB</h1>
            <p class="lead">SD IT Baitul Insan Tahun Ajaran 2025/2026</p>
            <p class="mb-0">Isi data dengan lengkap dan benar sesuai dokumen</p>
        </div>
    </div>

    <div class="container">
        <!-- Modern Step Indicator -->
        <div class="step-indicator-container">
            <div class="step-indicator">
                <div class="steps-wrapper">
                    <div class="step active" data-step="1">
                        <div class="step-circle">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="step-label">Data Siswa</span>
                        <div class="step-connector"></div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-circle">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="step-label">Orang Tua</span>
                        <div class="step-connector"></div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-circle">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <span class="step-label">Dokumen</span>
                        <div class="step-connector"></div>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span class="step-label">Persetujuan</span>
                    </div>
                </div>
                <div class="step-progress">
                    <div class="progress-bar" id="progressBar"></div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="success-modal-overlay" id="successModal">
            <div class="success-modal">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="mb-3 text-center">🎉 Pendaftaran Berhasil!</h2>

                <p class="text-muted mb-4 text-center">
                    Data pendaftaran Anda telah berhasil dikirim. Silakan hubungi admin melalui WhatsApp untuk
                    konfirmasi lebih lanjut.
                </p>

                <div class="registration-number" id="registrationNumber">
                    Loading...
                </div>

                <div class="mb-3 text-center">
                    <button class="copy-btn" onclick="copyRegistrationNumber()">
                        <i class="fas fa-copy"></i> Salin Nomor
                    </button>
                </div>

                <p class="text-muted mb-4 text-center">
                    <small><i class="fas fa-info-circle"></i> Simpan nomor pendaftaran ini untuk pengecekan
                        status</small>
                </p>

                <div class="d-grid gap-2">
                    <button class="whatsapp-btn" onclick="openWhatsApp()" id="whatsappBtn">
                        <i class="fab fa-whatsapp"></i> Hubungi Admin via WhatsApp
                    </button>

                    <button class="btn btn-outline-primary" onclick="closeSuccessModal()">
                        <i class="fas fa-home"></i> Kembali ke Form
                    </button>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-container">
                <h5><i class="fas fa-exclamation-triangle"></i> Terdapat Kesalahan:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Form -->
        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" id="ppdbForm">
            @csrf

            <!-- Section 1: Data Calon Siswa -->
            <div class="form-container active" id="section1" data-step="1">
                <div class="step-counter">1</div>
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Data Calon Siswa</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama"
                            value="{{ old('nama', $prefillData['nama'] ?? '') }}" placeholder="Nama lengkap sesuai akta"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">NIK (16 digit)</label>
                        <input type="text" class="form-control" name="nik"
                            value="{{ old('nik', $prefillData['nik'] ?? '') }}" maxlength="16"
                            placeholder="16 digit angka" required>
                        <small class="text-muted">Nomor Induk Kependudukan sesuai KK</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $prefillData['tempat_lahir'] ?? '') }}"
                            placeholder="Kota/kabupaten tempat lahir" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $prefillData['tanggal_lahir'] ?? '') }}"
                            max="{{ date('Y-m-d') }}" required onchange="calculateAge()">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required">Umur</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="umur" id="umur"
                                value="{{ old('umur', $prefillData['umur'] ?? '') }}" min="5" max="12"
                                placeholder="5-12" required readonly>
                            <span class="input-group-text">tahun</span>
                        </div>
                        <small class="text-muted" id="age-message"></small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required">Asal Sekolah</label>
                        <input type="text" class="form-control" name="asal_sekolah"
                            value="{{ old('asal_sekolah', $prefillData['asal_sekolah'] ?? '') }}"
                            placeholder="TK/PAUD sebelumnya" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label required">Anak Ke</label>
                        <input type="number" class="form-control" name="anak_ke"
                            value="{{ old('anak_ke', $prefillData['anak_ke'] ?? '') }}" min="1"
                            max="10" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label required">Dari Bersaudara</label>
                        <input type="number" class="form-control" name="dari_bersaudara"
                            value="{{ old('dari_bersaudara', $prefillData['dari_bersaudara'] ?? '') }}"
                            min="1" max="10" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label required">Alamat Lengkap Calon Siswa</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat lengkap tempat tinggal" required>{{ old('alamat', $prefillData['alamat'] ?? '') }}</textarea>
                    </div>
                </div>
                <div class="navigation-buttons">
                    <div></div>
                    <button type="button" class="nav-btn next" onclick="nextStep(1)">
                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Section 2: Data Orang Tua -->
            <div class="form-container" id="section2" data-step="2">
                <div class="step-counter">2</div>
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Data Orang Tua/Wali</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Nama Ayah</label>
                        <input type="text" class="form-control" name="nama_ayah"
                            value="{{ old('nama_ayah', $prefillData['nama_ayah'] ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu"
                            value="{{ old('nama_ibu', $prefillData['nama_ibu'] ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">No. HP Ayah</label>
                        <input type="tel" class="form-control" name="no_hp_ayah" id="no_hp_ayah"
                            value="{{ old('no_hp_ayah', $prefillData['no_hp_ayah'] ?? '') }}"
                            placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">No. HP Ibu</label>
                        <input type="tel" class="form-control" name="no_hp_ibu" id="no_hp_ibu"
                            value="{{ old('no_hp_ibu', $prefillData['no_hp_ibu'] ?? '') }}"
                            placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Penghasilan Orang Tua</label>
                        <select class="form-select" name="pendapatan" required>
                            <option value="">Pilih Range Penghasilan</option>
                            <option value="< 1 juta" {{ old('pendapatan') == '< 1 juta' ? 'selected' : '' }}>Kurang
                                dari 1 juta</option>
                            <option value="1 - 3 juta" {{ old('pendapatan') == '1 - 3 juta' ? 'selected' : '' }}>1 - 3
                                juta</option>
                            <option value="3 - 5 juta" {{ old('pendapatan') == '3 - 5 juta' ? 'selected' : '' }}>3 - 5
                                juta</option>
                            <option value="5 - 10 juta" {{ old('pendapatan') == '5 - 10 juta' ? 'selected' : '' }}>5 -
                                10 juta</option>
                            <option value="> 10 juta" {{ old('pendapatan') == '> 10 juta' ? 'selected' : '' }}>Lebih
                                dari 10 juta</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label required">Alamat Orang Tua</label>
                        <textarea class="form-control" name="alamat_orang_tua" rows="3" placeholder="Alamat lengkap orang tua"
                            required>{{ old('alamat_orang_tua', $prefillData['alamat_orang_tua'] ?? '') }}</textarea>
                    </div>
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="nav-btn prev" onclick="prevStep(2)">
                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                    </button>
                    <button type="button" class="nav-btn next" onclick="nextStep(2)">
                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Section 3: Upload Dokumen -->
            <div class="form-container" id="section3" data-step="3">
                <div class="step-counter">3</div>
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <h3>Upload Dokumen</h3>
                </div>
                <p class="text-muted mb-4">Upload file dengan format JPG, PNG, atau PDF (maksimal 2MB per file)</p>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Pas Foto Anak (3x4)</label>
                        <div class="file-upload-area" onclick="document.getElementById('foto_anak').click()">
                            <i class="fas fa-camera"></i>
                            <p class="mb-2">Klik untuk upload pas foto</p>
                            <small class="text-muted">Format: JPG/PNG, Background merah</small>
                            <input type="file" class="form-control d-none" id="foto_anak" name="foto_anak"
                                accept=".jpg,.jpeg,.png" required onchange="previewFile(this, 'foto_anak_preview')">
                        </div>
                        <div id="foto_anak_preview" class="mt-2"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Foto Kartu Keluarga (KK)</label>
                        <div class="file-upload-area" onclick="document.getElementById('foto_kk').click()">
                            <i class="fas fa-file-contract"></i>
                            <p class="mb-2">Klik untuk upload KK</p>
                            <small class="text-muted">Format: JPG/PNG/PDF</small>
                            <input type="file" class="form-control d-none" id="foto_kk" name="foto_kk"
                                accept=".jpg,.jpeg,.png,.pdf" required
                                onchange="previewFile(this, 'foto_kk_preview')">
                        </div>
                        <div id="foto_kk_preview" class="mt-2"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Foto Akte Kelahiran</label>
                        <div class="file-upload-area" onclick="document.getElementById('foto_akte').click()">
                            <i class="fas fa-birthday-cake"></i>
                            <p class="mb-2">Klik untuk upload akte</p>
                            <small class="text-muted">Format: JPG/PNG/PDF</small>
                            <input type="file" class="form-control d-none" id="foto_akte" name="foto_akte"
                                accept=".jpg,.jpeg,.png,.pdf" required
                                onchange="previewFile(this, 'foto_akte_preview')">
                        </div>
                        <div id="foto_akte_preview" class="mt-2"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Foto KTP Ayah</label>
                        <div class="file-upload-area" onclick="document.getElementById('foto_ktp_ayah').click()">
                            <i class="fas fa-id-card"></i>
                            <p class="mb-2">Klik untuk upload KTP Ayah</p>
                            <small class="text-muted">Format: JPG/PNG/PDF</small>
                            <input type="file" class="form-control d-none" id="foto_ktp_ayah"
                                name="foto_ktp_ayah" accept=".jpg,.jpeg,.png,.pdf" required
                                onchange="previewFile(this, 'foto_ktp_ayah_preview')">
                        </div>
                        <div id="foto_ktp_ayah_preview" class="mt-2"></div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label required">Foto KTP Ibu</label>
                        <div class="file-upload-area" onclick="document.getElementById('foto_ktp_ibu').click()">
                            <i class="fas fa-id-card"></i>
                            <p class="mb-2">Klik untuk upload KTP Ibu</p>
                            <small class="text-muted">Format: JPG/PNG/PDF</small>
                            <input type="file" class="form-control d-none" id="foto_ktp_ibu" name="foto_ktp_ibu"
                                accept=".jpg,.jpeg,.png,.pdf" required
                                onchange="previewFile(this, 'foto_ktp_ibu_preview')">
                        </div>
                        <div id="foto_ktp_ibu_preview" class="mt-2"></div>
                    </div>
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="nav-btn prev" onclick="prevStep(3)">
                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                    </button>
                    <button type="button" class="nav-btn next" onclick="nextStep(3)">
                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Section 4: Persetujuan -->
            <div class="form-container" id="section4" data-step="4">
                <div class="step-counter">4</div>
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Persetujuan</h3>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="agree" required>
                    <label class="form-check-label" for="agree">
                        <strong>Saya menyatakan bahwa data yang saya isi adalah benar dan dapat
                            dipertanggungjawabkan.</strong><br>
                        Jika data yang saya berikan tidak benar, saya bersedia menerima konsekuensi sesuai peraturan
                        yang berlaku.
                    </label>
                </div>

                <div class="d-grid col-md-8 mx-auto gap-2">
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <i class="fas fa-paper-plane"></i>
                        <span id="submitText">KIRIM PENDAFTARAN</span>
                        <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <p class="text-muted mt-3 text-center">
                        <i class="fas fa-info-circle"></i> Setelah mengirim, Anda akan mendapatkan nomor
                        pendaftaran dan diarahkan untuk menghubungi admin via WhatsApp.
                    </p>
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="nav-btn prev" onclick="prevStep(4)">
                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                    </button>
                    <div></div>
                </div>
            </div>
        </form>

        <!-- Contact Information -->
        <div class="contact-info">
            <h5><i class="fas fa-headset"></i> Butuh Bantuan?</h5>
            <div class="row">
                <div class="col-md-4">
                    <p><i class="fas fa-phone me-2"></i> <strong>Telp:</strong> 0822-2583-2575</p>
                </div>
                <div class="col-md-4">
                    <p><i class="fas fa-envelope me-2"></i> <strong>Email:</strong> sekolahbaitulinsan@gmail.com</p>
                </div>
                <div class="col-md-4">
                    <p><i class="fas fa-map-marker-alt me-2"></i> <strong>Alamat:</strong> Jl. Raya Kurungan, Nyawa,
                        Pesawaran</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ==================== VARIABLES ====================
        let currentStep = 1;
        const totalSteps = 4;
        let registrationNumber = '';
        let userName = '';
        let waUrl = '';
        let registrationData = {};

        // ==================== SUCCESS MODAL ====================
        function showSuccessModal(data) {
            registrationData = data;
            registrationNumber = data.no_pendaftaran;
            userName = data.nama;
            waUrl = data.wa_url;

            // Update modal content
            document.getElementById('registrationNumber').textContent = registrationNumber;

            // Show modal
            document.getElementById('successModal').classList.add('show');

            // Scroll to modal
            document.getElementById('successModal').scrollIntoView({
                behavior: 'smooth'
            });

            // Reset form (tapi tidak langsung)
            setTimeout(resetForm, 500);
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('show');
        }

        function copyRegistrationNumber() {
            navigator.clipboard.writeText(registrationNumber).then(() => {
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                btn.classList.add('copied');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('copied');
                }, 2000);
            });
        }

        function openWhatsApp() {
            if (waUrl && waUrl !== 'null') {
                window.open(waUrl, '_blank');
            } else {
                // Fallback jika waUrl tidak ada
                const message =
                    `Assalamu'alaikum Warahmatullahi Wabarakatuh\n\nHalo Admin PPDB SD IT Baitul Ihsan,\n\nSaya *${registrationData.nama_ayah || 'Orang Tua'}* (ayah dari calon siswa *${userName}*) ingin mengonfirmasi pendaftaran PPDB.\n\n📋 *DATA PENDAFTARAN*\n• No. Pendaftaran: ${registrationNumber}\n• Nama: ${userName}\n• Asal Sekolah: ${registrationData.asal_sekolah || ''}\n\nMohon konfirmasi penerimaan data ini.\n\nWassalamu'alaikum Warahmatullahi Wabarakatuh,\n${registrationData.nama_ayah || 'Orang Tua'}`;
                const encodedMessage = encodeURIComponent(message);
                const adminPhone = '6282225832575';
                window.open(`https://wa.me/${adminPhone}?text=${encodedMessage}`, '_blank');
            }
        }

        // ==================== FORM RESET ====================
        function resetForm() {
            // Reset form elements
            document.getElementById('ppdbForm').reset();

            // Reset file previews
            document.querySelectorAll('[id$="_preview"]').forEach(preview => {
                preview.innerHTML = '';
            });

            // Reset step indicator
            currentStep = 1;
            updateStepIndicator(currentStep);

            // Show only first section
            document.querySelectorAll('.form-container').forEach(container => {
                container.classList.remove('active');
            });
            document.getElementById('section1').classList.add('active');

            // Reset progress bar
            document.getElementById('progressBar').style.width = '25%';

            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // ==================== STEP NAVIGATION ====================
        function nextStep(stepNumber) {
            if (!validateStep(stepNumber)) {
                return;
            }

            if (stepNumber < totalSteps) {
                document.getElementById(`section${stepNumber}`).classList.remove('active');
                currentStep = stepNumber + 1;
                document.getElementById(`section${currentStep}`).classList.add('active');
                updateStepIndicator(currentStep);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        function prevStep(stepNumber) {
            if (stepNumber > 1) {
                document.getElementById(`section${stepNumber}`).classList.remove('active');
                currentStep = stepNumber - 1;
                document.getElementById(`section${currentStep}`).classList.add('active');
                updateStepIndicator(currentStep);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        // ==================== STEP VALIDATION ====================
        function validateStep(stepNumber) {
            const section = document.getElementById(`section${stepNumber}`);
            const inputs = section.querySelectorAll('input[required], select[required], textarea[required]');

            for (let input of inputs) {
                if (input.type === 'file') continue;

                if (!input.value.trim()) {
                    const label = input.previousElementSibling?.textContent?.replace(' *', '') || input
                        .previousElementSibling?.textContent || 'Field';
                    alert(`Harap isi ${label}`);
                    input.focus();
                    return false;
                }
            }

            if (stepNumber === 1) {
                const nikInput = document.querySelector('input[name="nik"]');
                if (nikInput.value.length !== 16) {
                    alert('NIK harus 16 digit angka');
                    nikInput.focus();
                    return false;
                }

                const ageInput = document.getElementById('umur');
                if (ageInput.value < 5 || ageInput.value > 12) {
                    alert('Umur harus antara 5 - 12 tahun untuk pendaftaran SD');
                    ageInput.focus();
                    return false;
                }
            }

            if (stepNumber === 2) {
                const phoneInputs = section.querySelectorAll('input[type="tel"]');
                for (let input of phoneInputs) {
                    if (input.value.length < 10 || input.value.length > 13) {
                        const label = input.previousElementSibling.textContent.replace(' *', '');
                        alert(`${label} harus 10-13 digit`);
                        input.focus();
                        return false;
                    }
                }
            }

            return true;
        }

        // ==================== STEP INDICATOR ====================
        function updateStepIndicator(activeStep) {
            const progressBar = document.getElementById('progressBar');
            const progressWidth = ((activeStep - 1) / (totalSteps - 1)) * 100;
            progressBar.style.width = `${progressWidth}%`;

            const steps = document.querySelectorAll('.step');
            steps.forEach((step, index) => {
                const stepNumber = index + 1;
                const stepCircle = step.querySelector('.step-circle');

                step.classList.remove('active', 'completed');

                if (stepNumber === activeStep) {
                    step.classList.add('active');
                    stepCircle.innerHTML = `<i class="${getStepIcon(stepNumber)}"></i>`;
                } else if (stepNumber < activeStep) {
                    step.classList.add('completed');
                    stepCircle.innerHTML = `<i class="fas fa-check"></i>`;
                } else {
                    stepCircle.innerHTML = `<i class="${getStepIcon(stepNumber)}"></i>`;
                }
            });
        }

        function getStepIcon(stepNumber) {
            const icons = {
                1: 'fas fa-user-graduate',
                2: 'fas fa-users',
                3: 'fas fa-file-upload',
                4: 'fas fa-check-circle'
            };
            return icons[stepNumber] || 'fas fa-circle';
        }

        // ==================== UTILITY FUNCTIONS ====================
        function calculateAge() {
            const birthDate = new Date(document.getElementById('tanggal_lahir').value);
            const today = new Date();

            if (!birthDate || isNaN(birthDate)) return;

            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            const ageInput = document.getElementById('umur');
            const ageMessage = document.getElementById('age-message');

            ageInput.value = age;

            if (age >= 5 && age <= 12) {
                ageMessage.textContent = `✓ Umur sesuai untuk pendaftaran SD`;
                ageMessage.className = 'text-success';
            } else if (age < 5) {
                ageMessage.textContent = `✗ Umur terlalu muda (minimal 5 tahun)`;
                ageMessage.className = 'text-danger';
            } else if (age > 12) {
                ageMessage.textContent = `✗ Umur terlalu tua (maksimal 12 tahun)`;
                ageMessage.className = 'text-danger';
            }
        }

        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert(`File ${file.name} melebihi ukuran maksimal 2MB`);
                    input.value = '';
                    preview.innerHTML = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        preview.innerHTML = `
                            <div class="d-flex align-items-center">
                                <img src="${e.target.result}" class="img-thumbnail me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <small class="d-block">${file.name}</small>
                                    <small class="text-success">✓ Berhasil diupload (${(file.size/1024).toFixed(1)} KB)</small>
                                </div>
                            </div>
                        `;
                    } else {
                        preview.innerHTML = `
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger fa-2x me-2"></i>
                                <div>
                                    <small class="d-block">${file.name}</small>
                                    <small class="text-success">✓ Berhasil diupload (${(file.size/1024).toFixed(1)} KB)</small>
                                </div>
                            </div>
                        `;
                    }
                };

                reader.readAsDataURL(file);
            }
        }

        // ==================== FORM SUBMISSION ====================
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal maksimal
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_lahir').max = today;

            if (document.getElementById('tanggal_lahir').value) {
                calculateAge();
            }

            // Format NIK input
            document.querySelector('input[name="nik"]').addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);
                }
            });

            // Format phone inputs
            document.querySelectorAll('input[type="tel"]').forEach(input => {
                input.addEventListener('input', function(e) {
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value.length > 13) {
                        this.value = this.value.slice(0, 13);
                    }
                });
            });

            // Handle form submission
            document.getElementById('ppdbForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                // Validate all steps
                for (let i = 1; i <= totalSteps; i++) {
                    if (!validateStep(i)) {
                        document.querySelectorAll('.form-container').forEach(container => {
                            container.classList.remove('active');
                        });
                        document.getElementById(`section${i}`).classList.add('active');
                        updateStepIndicator(i);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        return;
                    }
                }

                // Validate file uploads
                const maxSize = 2 * 1024 * 1024;
                const fileInputs = document.querySelectorAll('input[type="file"]');

                for (let input of fileInputs) {
                    if (input.files.length > 0 && input.files[0].size > maxSize) {
                        alert(`File ${input.name} melebihi ukuran maksimal 2MB`);
                        document.querySelectorAll('.form-container').forEach(container => {
                            container.classList.remove('active');
                        });
                        document.getElementById('section3').classList.add('active');
                        updateStepIndicator(3);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        input.focus();
                        return;
                    }
                }

                // Validate agreement
                if (!document.getElementById('agree').checked) {
                    alert('Anda harus menyetujui pernyataan sebelum mengirim formulir');
                    document.getElementById('agree').focus();
                    return;
                }

                // Show loading state
                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const submitSpinner = document.getElementById('submitSpinner');

                submitBtn.disabled = true;
                submitText.textContent = 'MENGIRIM DATA...';
                submitSpinner.classList.remove('d-none');

                try {
                    // Create FormData object
                    const formData = new FormData(this);

                    // Send AJAX request
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        // Show success modal with data from response
                        showSuccessModal(result.data);
                    } else {
                        // Show validation errors
                        if (result.errors) {
                            let errorMessages = [];
                            for (let field in result.errors) {
                                errorMessages.push(result.errors[field][0]);
                            }
                            alert('Validasi gagal:\n' + errorMessages.join('\n'));
                        } else {
                            alert(result.message || 'Terjadi kesalahan. Silakan coba lagi.');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
                } finally {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitText.textContent = 'KIRIM PENDAFTARAN';
                    submitSpinner.classList.add('d-none');
                }
            });

            // Step indicator click event
            document.querySelectorAll('.step').forEach(step => {
                step.addEventListener('click', function() {
                    const stepNumber = parseInt(this.getAttribute('data-step'));

                    if (stepNumber > currentStep) {
                        if (!validateStep(currentStep)) {
                            return;
                        }
                    }

                    document.querySelectorAll('.form-container').forEach(container => {
                        container.classList.remove('active');
                    });

                    currentStep = stepNumber;
                    document.getElementById(`section${stepNumber}`).classList.add('active');
                    updateStepIndicator(stepNumber);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });

            // Check for success data in session (fallback for non-AJAX submission)
            @if (session('success') && session('registration_data'))
                showSuccessModal(@json(session('registration_data')));
            @endif
        });
    </script>
</body>

</html>
