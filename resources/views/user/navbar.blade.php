<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <h1 class="sitename">Piutang</h1>
        <img src="assets/img/logo_ptpn.png" alt="Logo PTPN" class="logo-img">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="#hero" class="active">Beranda</a></li>
            <li><a href="">Kontrak</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="{{ route('logout') }}" class="nav-item nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>