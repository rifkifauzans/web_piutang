@extends('admin.master')

@section('content') <br> <br> <br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <p>Total Bidang</p>
                    <h1>{{ $fields }}</h1>
                </div>
                <div class="icon">
                    <i class="fas fa-building" style="color: white"></i>
                </div>
                <a href="{{ route('listFields') }}" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <p>Total Karyawan</p>
                <h1>{{ $employees }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color: white"></i>
              </div>
              <a href="{{ route('listEmployees') }}" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <p>Total Mitra</p>
                <h1>{{ $partners }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-handshake" style="color: white"></i>
              </div>
              <a href="{{ route('listPartners') }}" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <p>Total Kontrak</p>
                <h1>{{ $contracts }}</h1>
              </div>
              <div class="icon">
                <i class="fas fa-file-contract" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <p>Total Faktur</p>
                <h1>1</h1>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <p>Total Pembayaran</p>
                <h1>1</h1>
              </div>
              <div class="icon">
                <i class="fas fa-credit-card" style="color: white"></i>
              </div>
              <a href="" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>

        <!-- About Start -->
        <div class="container-fluid py-5">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-12">
                      <div class="card mb-4 p-5">
                          <div class="row no-gutters">
                              <div class="col-lg-4">
                                  <img class="img-fluid" src="assets/img/piutang.png" alt="" style="max-width: 100%; height: auto;">
                              </div>
                              <div class="col-lg-8">
                                  <div class="card-body">
                                      <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Tentang Kami</h6>
                                      <h1 class="mb-4">Monitor Piutang Anda Dengan Manajemen Mitra</h1>
                                      <h5 class="font-weight-medium font-italic mb-4">Pengelolaan piutang yang efisien dengan mitra terpercaya kami</h5>
                                      <p class="mb-2">Kami menyediakan solusi manajemen piutang berbasis web yang memudahkan Anda untuk mengelola hubungan dengan mitra secara efisien. Layanan ini memungkinkan Anda untuk memantau status piutang secara real-time, mengelola pembayaran, dan menerima pemberitahuan terkait perkembangan transaksi, semua melalui platform web yang transparan dan mudah digunakan.</p>
                                      <div class="row">
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Faktur Tepat Waktu</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Manajemen Mitra</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Pelaporan Komprehensif</p>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 pt-3">
                                              <div class="d-flex align-items-center">
                                                  <i class="fa fa-check text-primary mr-2"></i>
                                                  <p class="text-secondary font-weight-medium m-0">Transaksi Aman</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
        <!-- About End -->
       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection