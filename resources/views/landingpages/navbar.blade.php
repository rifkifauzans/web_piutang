<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <h1 class="sitename">Piutang</h1>
        <img src="assets/img/logo_ptpn.png" alt="Logo PTPN" class="logo-img">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#gallery">Galeri</a></li>
          @if (Auth::check())
                        @if (Auth::user()->userType == 'admin')
                            <li><a href="{{ route('admin') }}" class="nav-item nav-link">Admin</a></li>
                        @elseif (Auth::user()->userType == 'partner')
                            <li><a href="{{ route('user') }}" class="nav-item nav-link">Partner</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="nav-item nav-link {{ Request::routeIs('login') ? 'active' : '' }}">Login</a></li>
                    @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>