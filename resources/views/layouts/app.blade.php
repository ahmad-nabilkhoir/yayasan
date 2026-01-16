    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Yayasan Pendidikan Al-Ihsan')</title>

        {{-- Bootstrap & Icons --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- AOS (Animate On Scroll) --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

        <style>
            /* --- 1. Base Setup & Fonts --- */
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8f9fa;
                color: #333;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            main {
                flex: 1;
            }

            .object-fit-cover {
                object-fit: cover;
            }

            /* --- 2. Brand Colors (Consistency) --- */
            :root {
                --primary-color: #1a44cc;
                --primary-dark: #1635BD;
                --navy-dark: #002366;
            }

            .text-primary {
                color: var(--navy-dark) !important;
            }

            .bg-primary {
                background-color: var(--primary-color) !important;
            }

            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background-color: var(--primary-dark);
                border-color: var(--primary-dark);
                transform: translateY(-1px);
            }

            /* --- 3. Navbar & Navigation --- */
            .fixed-navbar-spacer {
                height: 70px;
            }

            @media (min-width: 992px) {
                .navbar-nav {
                    gap: 1rem;
                }
            }

            /* Active Underline Effect */
            .nav-link.active {
                position: relative;
                font-weight: 600;
            }

            .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 60%;
                height: 2px;
                background-color: var(--navy-dark);
            }

            /* Dropdown Styling */
            .dropdown-menu {
                margin-top: 0;
                border: none;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                animation: fadeIn 0.3s ease forwards;
            }

            .dropdown-item {
                padding: 0.6rem 1.2rem;
                transition: all 0.2s;
            }

            .dropdown-item:hover {
                background-color: #f8f9fa;
                color: var(--navy-dark);
                padding-left: 1.5rem;
            }

            .nav-link.active:not(.dropdown-toggle)::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 60%;
                height: 2px;
                background-color: var(--navy-dark);
            }

            /* Memastikan panah dropdown (caret) SELALU muncul */
            .nav-link.dropdown-toggle::after {
                display: inline-block !important;
                margin-left: 0.3em;
                vertical-align: middle;
                content: "";
                border-top: 0.3em solid;
                border-right: 0.3em solid transparent;
                border-left: 0.3em solid transparent;
                border-bottom: 0;
                color: inherit;
            }

            /* --- 4. Footer Styling --- */
            footer {
                background-color: var(--primary-color) !important;
                margin-top: auto;
            }

            .footer-title {
                font-size: 1rem;
                letter-spacing: 1px;
                position: relative;
            }

            footer p {
                line-height: 1.6;
                font-size: 0.95rem;
                margin-bottom: 0.8rem;
            }

            /* --- 5. Modal Video Custom Styling --- */
            .video-modal .modal-dialog {
                max-width: 900px;
            }

            .video-modal .modal-content {
                background-color: #000;
                border: none;
            }

            .video-modal .modal-header {
                background: linear-gradient(135deg, #1a44cc 0%, #002366 100%);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .video-modal .modal-header .btn-close {
                filter: invert(1) grayscale(100%) brightness(200%);
                opacity: 0.8;
                transition: opacity 0.3s;
            }

            .video-modal .modal-header .btn-close:hover {
                opacity: 1;
            }

            .video-modal .modal-body {
                padding: 0;
            }

            .video-modal .modal-footer {
                background-color: rgba(0, 0, 0, 0.8);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* --- 6. Animations --- */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* --- 7. Custom untuk Kegiatan --- */
            .video-thumbnail {
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .video-thumbnail:hover {
                transform: scale(1.02);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            /* --- 8. Pagination Styling --- */
            .pagination .page-link {
                border-radius: 50px;
                margin: 0 3px;
                border: none;
                color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, var(--primary-color), #5a67d8);
                color: white;
                transform: scale(1.1);
            }

            .pagination .page-link:hover {
                background-color: rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }

            /* --- 9. Responsive Images --- */
            .img-fluid {
                max-width: 100%;
                height: auto;
            }

            /* --- 10. Loading Spinner --- */
            .spinner-border {
                width: 3rem;
                height: 3rem;
            }

            /* --- 11. Card Hover Effects --- */
            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            /* --- 12. KEGIATAN PAGE STYLES --- */
            .kegiatan-section {
                background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
                position: relative;
                overflow: hidden;
            }

            .bg-blur {
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle at 30% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 70% 30%, rgba(76, 175, 80, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 80%, rgba(255, 179, 0, 0.1) 0%, transparent 50%);
                filter: blur(40px);
                animation: bgFloat 20s ease-in-out infinite;
            }

            .floating-shapes .shape {
                position: absolute;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary-color), transparent);
                opacity: 0.1;
                animation: float 15s infinite ease-in-out;
            }

            .shape-1 {
                width: 100px;
                height: 100px;
                top: 10%;
                left: 5%;
                animation-delay: 0s;
            }

            .shape-2 {
                width: 150px;
                height: 150px;
                top: 60%;
                right: 10%;
                animation-delay: 5s;
            }

            .shape-3 {
                width: 80px;
                height: 80px;
                bottom: 20%;
                left: 15%;
                animation-delay: 10s;
            }

            .shape-4 {
                width: 120px;
                height: 120px;
                top: 20%;
                right: 20%;
                animation-delay: 15s;
            }

            .header-animation .floating-element {
                animation: floatUpDown 3s ease-in-out infinite;
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }

            .fade-in-up {
                animation: fadeInUp 0.8s ease-out forwards;
                opacity: 0;
            }

            .kegiatan-card {
                border-radius: 1.5rem;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .kegiatan-card:hover {
                transform: translateY(-10px) scale(1.01);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
                border-color: var(--primary-color);
            }

            .media-container {
                position: relative;
                overflow: hidden;
                cursor: pointer;
                min-height: 400px;
                border-radius: 1.5rem 1.5rem 0 0;
            }

            @media (min-width: 992px) {
                .media-container {
                    border-radius: 1.5rem 0 0 1.5rem !important;
                }

                .flex-row-reverse .media-container {
                    border-radius: 0 1.5rem 1.5rem 0 !important;
                }
            }

            .video-play-wrapper {
                transition: all 0.5s ease;
            }

            .video-play-btn {
                transition: all 0.5s ease;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }

            .pulse-animation {
                animation: pulse 2s infinite;
            }

            .media-container:hover .video-play-btn {
                transform: scale(1.15) rotate(5deg);
                background: white;
            }

            .title-gradient {
                background: linear-gradient(135deg, var(--navy-dark), #2d3748);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .description-text {
                position: relative;
                padding-left: 20px;
            }

            .description-text::before {
                content: '';
                position: absolute;
                left: 0;
                top: 5px;
                bottom: 5px;
                width: 4px;
                background: linear-gradient(to bottom, var(--primary-color), #5a67d8);
                border-radius: 2px;
            }

            .watch-video-btn:hover {
                background-color: #dc3545;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
            }

            .modal-content {
                border-radius: 1.5rem;
                overflow: hidden;
                border: none;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            }

            .bg-gradient {
                background: linear-gradient(135deg, var(--primary-color) 0%, #764ba2 100%);
            }

            .empty-icon {
                animation: bounce 2s infinite;
            }

            /* Animations Keyframes */
            @keyframes floatUpDown {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
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

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0) rotate(0deg);
                }

                50% {
                    transform: translateY(-20px) rotate(10deg);
                }
            }

            @keyframes bgFloat {

                0%,
                100% {
                    transform: translate(0, 0) rotate(0deg);
                }

                25% {
                    transform: translate(20px, 20px) rotate(5deg);
                }

                50% {
                    transform: translate(-15px, 10px) rotate(-5deg);
                }

                75% {
                    transform: translate(10px, -15px) rotate(3deg);
                }
            }

            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
                }
            }

            @keyframes bounce {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-20px);
                }
            }

            @keyframes ripple {
                0% {
                    transform: scale(0, 0);
                    opacity: 1;
                }

                20% {
                    transform: scale(25, 25);
                    opacity: 1;
                }

                100% {
                    opacity: 0;
                    transform: scale(40, 40);
                }
            }

            /* Responsive */
            @media (max-width: 991.98px) {
                .media-container {
                    min-height: 300px !important;
                    border-radius: 1.5rem 1.5rem 0 0 !important;
                }

                .kegiatan-card .row {
                    flex-direction: column !important;
                }
            }

            @media (max-width: 768px) {
                .display-4 {
                    font-size: 2.5rem !important;
                }

                .action-buttons {
                    flex-direction: column;
                    gap: 10px;
                }

                .action-buttons .btn {
                    width: 100%;
                }
            }

            @media (max-width: 576px) {
                .media-container {
                    min-height: 250px !important;
                }

                .display-4 {
                    font-size: 2rem !important;
                }

                .pagination {
                    flex-wrap: wrap;
                    justify-content: center;
                }
            }
        </style>

        @stack('styles')
    </head>

    <body>
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center fw-bold text-dark" href="{{ route('home') }}"
                    style="gap: 0.5rem">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="32" height="32">
                    YAYASAN BAITUL INSAN
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto" style="gap: 1rem">
                        {{-- Beranda --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary fw-semibold' : '' }}"
                                href="{{ route('home') }}">Beranda</a>
                        </li>

                        {{-- Jenjang Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('jenjang*') ? 'active text-primary fw-semibold' : '' }}"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Jenjang
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <li><a class="dropdown-item" href="{{ route('jenjang.tk') }}">TK IT Baitul Insan</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('jenjang.sd') }}">SD IT Baitul Insan</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Profil Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('visi-misi', 'akreditasi', 'galeri*') ? 'active text-primary fw-semibold' : '' }}"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <li><a class="dropdown-item" href="{{ route('visi-misi') }}">Visi Misi</a></li>
                                <li><a class="dropdown-item" href="{{ route('akreditasi') }}">Akreditasi</a></li>
                                <li><a class="dropdown-item" href="{{ route('galeri.index') }}">Galeri</a></li>
                            </ul>
                        </li>

                        {{-- Informasi Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('tata-tertib', 'ekstrakurikuler', 'prestasi*', 'alur-pendaftaran', 'pembayaran', 'kegiatan*', 'kurikulum') ? 'active text-primary fw-semibold' : '' }}"
                                href="#" id="navbarInformasi" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Informasi
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm"
                                aria-labelledby="navbarInformasi">
                                <li><a class="dropdown-item" href="{{ route('tata-tertib') }}">Tata Tertib</a></li>
                                <li><a class="dropdown-item" href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('prestasi.index') }}">Prestasi Siswa</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                                <li><a class="dropdown-item" href="{{ route('kurikulum') }}">Kurikulum</a></li>
                            </ul>
                        </li>

                        {{-- Artikel --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('artikel*') ? 'active text-primary fw-semibold' : '' }}"
                                href="{{ route('artikel.index') }}">Artikel</a>
                        </li>

                        {{-- Tentang --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tentang') ? 'active text-primary fw-semibold' : '' }}"
                                href="{{ route('tentang') }}">Tentang</a>
                        </li>

                        {{-- PPDB --}}
                        <li class="nav-item">
                            <a class="nav-link rounded-pill {{ request()->is('ppdb') ? 'active fw-bold' : 'bg-primary text-white fw-semibold' }} px-3 py-2"
                                href="{{ route('ppdb') }}">
                                <span class="d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-person-plus-fill"></i>
                                    PPDB {{ now()->year }}
                                    <span class="badge text-primary rounded-pill ms-1 bg-white"
                                        style="font-size: 0.7rem;">
                                        Daftar!
                                    </span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Spacer untuk fixed navbar -->
        <div class="fixed-navbar-spacer"></div>

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Chatbox Interaktif Gemini - Yayasan Baitul Insan --}}
        <div id="chatbox-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
            {{-- Tombol Buka Chat --}}
            <button id="chat-toggle" class="btn btn-primary rounded-circle shadow-lg"
                style="width: 60px; height: 60px;">
                <i class="bi bi-chat-dots-fill fs-3"></i>
            </button>

            {{-- Jendela Chat --}}
            <div id="chatbox" class="rounded-3 border bg-white shadow-lg"
                style="width: 340px; display: none; margin-top: 10px; overflow: hidden; transition: all 0.3s ease;">

                {{-- Header --}}
                <div
                    class="card-header bg-primary d-flex justify-content-between align-items-center px-3 py-2 text-white">
                    <span><strong>Asisten Baitul Insan</strong></span>
                    <button id="close-chat" class="btn btn-sm text-white"
                        style="font-size: 1.5rem; line-height: 1; border:none; background:none;">&times;</button>
                </div>

                {{-- Area Pesan --}}
                <div id="chat-messages" class="p-3"
                    style="height: 300px; overflow-y: auto; background-color: #f9fafb; display: flex; flex-direction: column;">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="bg-primary rounded-3 small p-2 text-white" style="max-width: 90%;">
                            Halo! Saya asisten AI Yayasan Baitul Insan. Ada yang bisa saya bantu terkait informasi
                            yayasan?
                        </div>
                    </div>
                </div>

                {{-- Footer & Input --}}
                <div class="card-footer bg-light p-2">
                    <div class="input-group mb-2">
                        <input id="chat-input" type="text" class="form-control form-control-sm shadow-none"
                            placeholder="Ketik pertanyaan...">
                        <button id="send-btn" class="btn btn-primary btn-sm">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    <button id="chat-admin-btn" class="btn btn-success w-100 btn-sm shadow-none">
                        <i class="bi bi-whatsapp me-1"></i> Chat Admin (WhatsApp)
                    </button>
                </div>
            </div>
        </div>

        <style>
            /* Styling Bubble Chat */
            .message-user {
                background-color: #0d6efd !important;
                color: white !important;
                align-self: flex-end;
                border-bottom-right-radius: 2px !important;
            }

            .message-bot {
                background-color: #ffffff !important;
                color: #212529;
                border: 1px solid #dee2e6;
                align-self: flex-start;
                border-bottom-left-radius: 2px !important;
            }

            #chat-messages {
                scrollbar-width: thin;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            #chat-messages::-webkit-scrollbar {
                width: 5px;
            }

            #chat-messages::-webkit-scrollbar-thumb {
                background: #cbd5e0;
                border-radius: 10px;
            }

            .typing-indicator-msg {
                font-size: 0.75rem;
                color: #718096;
                margin-bottom: 10px;
                align-self: flex-start;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleBtn = document.getElementById('chat-toggle');
                const chatbox = document.getElementById('chatbox');
                const closeBtn = document.getElementById('close-chat');
                const chatMessages = document.getElementById('chat-messages');
                const chatInput = document.getElementById('chat-input');
                const sendBtn = document.getElementById('send-btn');

                // === KONFIGURASI API (WAJIB GANTI KEY JIKA MASIH ERROR 404/403) ===
                const API_KEY = "AIzaSyAuTYKGwxJVFuRo1JqgR0LwzRw2tG4HSbM";
                const ADMIN_PHONE = '6282225832575';

                // === FUNGSI UTAMA GEMINI ===
                async function getGeminiResponse(userText) {
                    // Tampilkan indikator loading
                    const loadingId = "loading-" + Date.now();
                    const loadingDiv = document.createElement('div');
                    loadingDiv.id = loadingId;
                    loadingDiv.className = "typing-indicator-msg";
                    loadingDiv.innerText = "Asisten sedang mengetik...";
                    chatMessages.appendChild(loadingDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    try {
                        // Perbaikan URL: Pastikan menggunakan v1beta dan format generateContent
                        const url =
                            `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${API_KEY}`;

                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                contents: [{
                                    parts: [{
                                        text: `Instruksi: Kamu adalah asisten pintar Yayasan Baitul Insan. 
                                Informasi Yayasan:
                                - Visi: Mencetak generasi Qur’ani yang cerdas dan mandiri.
                                - Program: Tahfidz Al-Qur'an, STEM Education, Beasiswa Yatim.
                                - Rekening: Bank Syariah Indonesia (BSI) 123456789 a.n Baitul Insan.
                                Aturan: Jawablah dengan ramah dalam Bahasa Indonesia. Jika diluar topik yayasan, arahkan kembali ke profil yayasan.
                                
                                Pertanyaan user: ${userText}`
                                    }]
                                }]
                            })
                        });

                        const data = await response.json();

                        // Hapus loading
                        const loader = document.getElementById(loadingId);
                        if (loader) loader.remove();

                        // Validasi data respon
                        if (data.candidates && data.candidates[0].content && data.candidates[0].content.parts) {
                            const resultText = data.candidates[0].content.parts[0].text;
                            addMessage(resultText, false);
                        } else if (data.error) {
                            console.error("API Error Detail:", data.error);
                            addMessage("Maaf, ada kendala pada kunci akses API. Mohon hubungi admin.", false);
                        } else {
                            addMessage("Maaf, asisten gagal memproses jawaban. Coba lagi ya.", false);
                        }

                    } catch (error) {
                        const loader = document.getElementById(loadingId);
                        if (loader) loader.remove();
                        addMessage("Koneksi terputus. Pastikan internetmu stabil.", false);
                        console.error("Gemini Connection Error:", error);
                    }
                }

                // === FUNGSI UI ===
                function addMessage(text, isUser = false) {
                    const wrapper = document.createElement('div');
                    wrapper.className = `d-flex ${isUser ? 'justify-content-end' : 'justify-content-start'}`;

                    const msgClass = isUser ? 'message-user' : 'message-bot';

                    wrapper.innerHTML = `
                <div class="${msgClass} rounded-3 p-2 small shadow-sm" style="max-width: 85%; white-space: pre-wrap; margin-bottom: 5px;">
                    ${text}
                </div>
            `;

                    chatMessages.appendChild(wrapper);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }

                function handleSend() {
                    const message = chatInput.value.trim();
                    if (message) {
                        addMessage(message, true);
                        chatInput.value = '';
                        getGeminiResponse(message);
                    }
                }

                // === EVENT LISTENERS ===
                toggleBtn.addEventListener('click', () => {
                    chatbox.style.display = chatbox.style.display === 'none' ? 'block' : 'none';
                    if (chatbox.style.display === 'block') chatInput.focus();
                });

                closeBtn.addEventListener('click', () => {
                    chatbox.style.display = 'none';
                });

                sendBtn.addEventListener('click', handleSend);

                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') handleSend();
                });

                document.getElementById('chat-admin-btn').addEventListener('click', function() {
                    const waUrl =
                        `https://wa.me/${ADMIN_PHONE}?text=Halo%20Admin%20Baitul%20Insan%2C%20saya%20ingin%20bertanya.`;
                    window.open(waUrl, '_blank');
                });
            });
        </script>

        {{-- Footer --}}
        <footer class="bg-primary overflow-hidden text-white" style="margin-top: auto;">
            <div class="container pb-4 pt-5">
                <div class="row g-4 align-items-start">
                    {{-- Logo & Nama Sekolah --}}
                    <div class="col-lg-3 col-md-6 text-md-start text-center">
                        <div class="d-flex flex-column align-items-center align-items-md-start">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo SDIT" class="mb-2"
                                style="height: 80px; width: auto;">
                            <h4 class="fw-bold lh-sm text-uppercase mb-0">SD IT<br>BAITUL INSAN</h4>
                        </div>
                    </div>

                    {{-- Slogan --}}
                    <div class="col-lg-3 col-md-6 text-md-start text-center">
                        <h5
                            class="footer-title fw-bold text-uppercase border-bottom mb-3 border-white border-opacity-20 pb-2">
                            Slogan</h5>
                        <div class="small text-white text-opacity-85">
                            <p class="mb-1">Mendidik Tanpa Melukai Fitrah</p>
                            <p class="fw-semibold mb-0">ASAH ASIH ASUH</p>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-lg-3 col-md-6 text-md-start text-center">
                        <h5
                            class="footer-title fw-bold text-uppercase border-bottom mb-3 border-white border-opacity-20 pb-2">
                            Alamat</h5>
                        <div class="small text-white text-opacity-85">
                            <p class="mb-1">Jl. Raya Kurungan, Nyawa, Pal.12</p>
                            <p class="mb-1">Gg Sholeha, Pesawaran</p>
                            <p class="mb-0">Lampung, 35154</p>
                        </div>
                    </div>

                    {{-- Hubungi Kami --}}
                    <div class="col-lg-3 col-md-6 text-md-start text-center">
                        <h5
                            class="footer-title fw-bold text-uppercase border-bottom mb-3 border-white border-opacity-20 pb-2">
                            Kontak</h5>
                        <div class="small text-white text-opacity-85">
                            <p class="mb-2"><i class="bi bi-telephone-fill me-2"></i> 0821-8280-2679</p>
                            <p class="mb-2"><i class="bi bi-envelope-fill me-2"></i> sekolahbaitulinsan@gmail.com
                            </p>
                            <p class="mb-0"><i class="bi bi-instagram me-2"></i> @sd_itbaitulinsan</p>
                        </div>
                    </div>
                </div>

                {{-- Copyright --}}
                <div class="border-top mt-4 border-white border-opacity-10 pt-3 text-center">
                    <p class="text-uppercase mb-0 text-white text-opacity-50"
                        style="font-size: 0.65rem; letter-spacing: 0.1em;">
                        &copy; {{ date('Y') }} SD IT Baitul Insan. All Rights Reserved.
                    </p>
                </div>
            </div>
        </footer>

        {{-- Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        {{-- Global JavaScript --}}
        <script>
            // Inisialisasi AOS
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 800,
                        once: true,
                        offset: 100
                    });
                }

                // Handle video modals
                const videoModals = document.querySelectorAll('.video-modal');

                videoModals.forEach(function(modal) {
                    modal.addEventListener('shown.bs.modal', function() {
                        const videoType = this.getAttribute('data-video-type');
                        const videoId = this.getAttribute('data-video-id');
                        const kegiatanId = this.id.replace('videoModal', '');

                        if (videoType === 'youtube' && videoId) {
                            const iframe = document.getElementById(`youtubeIframe${kegiatanId}`);
                            if (iframe) {
                                const src = iframe.getAttribute('data-src');
                                iframe.src = src + '&autoplay=1&mute=1';
                            }
                        } else if (videoType === 'local') {
                            const video = document.getElementById(`localVideo${kegiatanId}`);
                            if (video) {
                                video.muted = true;
                                video.play().catch(e => {
                                    console.log('Autoplay prevented:', e);
                                });
                            }
                        }
                    });

                    modal.addEventListener('hide.bs.modal', function() {
                        const videoType = this.getAttribute('data-video-type');
                        const kegiatanId = this.id.replace('videoModal', '');

                        if (videoType === 'youtube') {
                            const iframe = document.getElementById(`youtubeIframe${kegiatanId}`);
                            if (iframe) {
                                iframe.src = iframe.src.replace('&autoplay=1', '');
                            }
                        } else if (videoType === 'local') {
                            const video = document.getElementById(`localVideo${kegiatanId}`);
                            if (video) {
                                video.pause();
                                video.currentTime = 0;
                            }
                        }
                    });
                });

                // Smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');
                        if (href !== '#') {
                            e.preventDefault();
                            const target = document.querySelector(href);
                            if (target) {
                                target.scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        }
                    });
                });

                // Active nav link based on current URL
                function setActiveNavLink() {
                    const currentPath = window.location.pathname;
                    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

                    navLinks.forEach(link => {
                        const linkPath = link.getAttribute('href');
                        if (linkPath && currentPath.startsWith(linkPath) && linkPath !== '/') {
                            link.classList.add('active', 'text-primary', 'fw-semibold');
                        } else if (linkPath === '/' && currentPath === '/') {
                            link.classList.add('active', 'text-primary', 'fw-semibold');
                        } else {
                            link.classList.remove('active', 'text-primary', 'fw-semibold');
                        }
                    });
                }

                // Run on page load
                setActiveNavLink();

                // Run on history changes (for SPA-like behavior)
                window.addEventListener('popstate', setActiveNavLink);
            });
        </script>

        @stack('scripts')
    </body>

    </html>
