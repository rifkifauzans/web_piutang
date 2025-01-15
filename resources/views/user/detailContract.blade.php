@extends('user.contracts')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-responsive img {
            width: 50px;
            height: auto;
        }
        .table-responsive .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .table-responsive .btn {
            margin: 2px;
        }
        .table-responsive .btn i {
            font-size: 1.2em;
        }
        .card {
            width: 100%;
        }
        .container-fluid {
            max-width: 100%;
        }
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.5em 1em;
            font-size: 1rem;
            border-radius: 0.25em;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-custom i {
            margin-right: 0.5em;
            font-size: 1.2em;
        }

        .btn-custom-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-custom-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-table").DataTable();
        });

        function confirmDelete(id) {
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                dangerMode: true,
                buttons: true
            }).then(function(value) {
                if (value) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

@section('content')
<!-- Page Header Start -->
<div class="page-header container-fluid bg-primary pt-2 pt-lg-5 pb-2 mb-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-white">Detail Kontrak</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <button class="btn btn-secondary btn-lg px-4 py-2 rounded-pill shadow" onclick="window.location.href='{{ url('/user') }}'">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="content-wrapper">
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="ml-auto mb-0"><small>No Kontrak :</small> {{ $contract->contract_code }}</h3>
                </div>

                <div class="card-body">
                    <h4>Informasi Mitra</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $contract->partner->partner_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>NPWP</strong></td>
                                <td>{{ $contract->partner->npwp }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon</strong></td>
                                <td>
                                    @if($contract->no_wa)
                                        <a href="https://wa.me/{{ $contract->no_wa }}" target="_blank" class="btn btn-success btn-sm" style="margin-left: 10px;">
                                            <i class="fab fa-whatsapp"></i> {{ $contract->no_wa }}
                                        </a>
                                    @else
                                        Tidak tersedia
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PIC Opset</strong></td>
                                <td>{{ $contract->partner->pic_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>PIC AA</strong></td>
                                <td>{{ $contract->pic_aa }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $contract->partner->address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>{{ $contract->lokasi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bagian</strong></td>
                                <td>{{ $contract->field->field_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>{{ $contract->ket }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h4>Detail Kontrak</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Luas (m<sup>2</sup>)</th>
                                <th>Nilai Kompensansi</th>
                                <th>Awal Perjanjian</th>
                                <th>Akhir Perjanjian</th>
                                <th>Jangka Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $contract->luas }} m<sup>2</sup></td>
                                <td>Rp {{ number_format($contract->nilai, 0, ',', '.') }}</td>
                                <td>{{ $contract->awal_janji }}</td>
                                <td>{{ $contract->akhir_janji }}</td>
                                <td>{{ $contract->jangka_waktu }} Tahun</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h4>Info Invoice Kontrak</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jatuh Tempo</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1 Februari 2025 </td>
                                <td>2025</td>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <i class="fas fa-file-pdf" style="font-size: 32px; color: #dc3545;"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h4>Info Pembayaran</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jatuh Tempo</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Aksi Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1 Februari 2025 </td>
                                <td>2025</td>
                                <td>Belum Dibayar</td>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%; position: relative;">
                                    <!-- Input File (Disembunyikan) -->
                                    <input type="file" id="uploadFile" style="display: none;" onchange="handleFileUpload(this)">

                                    <!-- Ikon PDF -->
                                    <label for="uploadFile" style="cursor: pointer;">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 32px; color: #28a745;"></i>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
