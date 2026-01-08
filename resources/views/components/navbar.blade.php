<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-dark gap-2" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="32" height="32">
            YAYASAN BAITUL INSAN
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="navbar-collapse collapse" id="navbarMain">
            <ul class="navbar-nav align-items-lg-center gap-lg-3 ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-primary fw-semibold' : '' }}"
                        href="{{ url('/') }}">Beranda</a>
                </li>

                <!-- Profil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/visi-misi') }}">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="{{ url('/akreditasi') }}">Akreditasi</a></li>
                        <li><a class="dropdown-item" href="{{ url('/galeri') }}">Galeri</a></li>
                    </ul>
                </li>

                <!-- Informasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Informasi</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/tata-tertib') }}">Tata Tertib</a></li>
                        <li><a class="dropdown-item" href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                        <li><a class="dropdown-item" href="{{ url('/prestasi') }}">Prestasi Siswa</a></li>
                        <li><a class="dropdown-item" href="{{ url('/ppdb') }}">PPDB</a></li>
                        <li><a class="dropdown-item" href="{{ url('/alur-pendaftaran') }}">Alur Pendaftaran</a></li>
                        <li><a class="dropdown-item" href="{{ url('/pembayaran') }}">Pembayaran</a></li>
                        <li><a class="dropdown-item" href="{{ url('/kegiatan') }}">Kegiatan</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/kurikulum') }}">Kurikulum</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/artikel') }}">Artikel</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tentang') }}">Tentang</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Spacer -->
<div style="height: 70px;"></div>
