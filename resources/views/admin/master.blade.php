<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Admin</title>

  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  @yield('addCss')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark-primary elevation-4 fixed-top" style="background-color: #003366;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #ffffff;"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin" class="nav-link" style="color: #ffffff;">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="/" class="nav-link" style="color: #ffffff;">Landing Pages</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="color: #ffffff;"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #003366;">
  <!-- Brand Logo -->
  <a href="" class="brand-link" style="background-color: #336699; color: #ffffff;">
    <img src="{{ asset('assets/img/logo_ptpn.png') }}" alt="" class="brand-image img-circle" style="opacity: 1.0;">
    <span class="brand-text font-weight-light">{{ $title ?? "Piutang" }}</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active" style="background-color: #336699; color: #ffffff;">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              Menu
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">   
            <li class="nav-item">
            <a href="{{ route('listUsers') }}" class="nav-link {{ Request::routeIs('listUsers') ? 'active' : '' }}" style="{{ Request::routeIs('listUsers') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Hak Akses</p>
              </a>
            </li>           
            <li class="nav-item">
              <a href="{{ route('listEmployees') }}" class="nav-link {{ Request::routeIs('listEmployees') ? 'active' : '' }}" style="{{ Request::routeIs('listEmployees') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listPartners') }}" class="nav-link {{ Request::routeIs('listPartners') ? 'active' : '' }}" style="{{ Request::routeIs('listPartners') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>Mitra</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listFields') }}" class="nav-link {{ Request::routeIs('listFields') ? 'active' : '' }}" style="{{ Request::routeIs('listFields') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-building"></i>
                <p>Bidang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listContracts') }}" class="nav-link {{ Request::routeIs('listContracts') ? 'active' : '' }}" style="{{ Request::routeIs('listContracts') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-file-contract"></i>
                <p>Kontrak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" style="">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>Faktur</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" style="">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link" style="background-color: #336699; color: #ffffff;">
            <i class="fas fa-sign-out-alt"></i> 
            <p>              
              Keluar
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
@yield('content')

<!-- REQUIRED SCRIPTS -->
@include('sweetalert::alert')
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
@yield('addJavascript')
</body>
</html>
