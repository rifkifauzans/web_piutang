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
                                    @if($contract->partner->no_wa)
                                        <a href="https://wa.me/{{ $contract->partner->no_wa }}" target="_blank" class="btn btn-success btn-sm" style="margin-left: 10px;">
                                            <i class="fab fa-whatsapp"></i> {{ $contract->partner->no_wa }}
                                        </a>
                                    @else
                                        Tidak tersedia
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PIC (Penanggung Jawab Opset)</strong></td>
                                <td>{{ $contract->partner->pic_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>PIC AA (Penanggung Jawab Kerja Sama)</strong></td>
                                <td>{{ $contract->employee->employees_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $contract->partner->address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>{{ $contract->region->lokasi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kab/Kota</strong></td>
                                <td>{{ $contract->region->kab_kota }}</td>
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
                                <th>Tahun</th>
                                <th>Jatuh Tempo</th>
                                <th>Nilai Tagihan</th>
                                <th>Sisa Tagihan</th>
                                <th>Jumlah Denda</th>
                                <th>Surat Peringatan (SP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract->invoices->where('status', 'kirim') as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->compensation ? $invoice->compensation->tahun : 'Tahun tidak ditemukan' }}</td>
                                <td>{{ $invoice->compensation ? \Carbon\Carbon::parse($invoice->compensation->jatuh_tempo)->format('d-m-Y') : 'Jatuh Tempo tidak ditemukan' }}</td>
                                <td>{{ $invoice->total_tagihan }}</td>
                                <td>{{ $invoice->sisa_tagihan }}</td>
                                <td>{{ $invoice->jml_denda }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-{{ 
                                        $invoice->status_sp == 'none' ? 'success' : 
                                        ($invoice->status_sp == 'SP1' ? 'warning' : 
                                        ($invoice->status_sp == 'SP2' ? 'orange' : 
                                        ($invoice->status_sp == 'SP3' ? 'danger' : 'secondary')))
                                    }} btn-sm">
                                        <i class="fas fa-{{ 
                                            $invoice->status_sp == 'none' ? 'file' : 
                                            ($invoice->status_sp == 'SP1' ? 'exclamation-triangle' : 
                                            ($invoice->status_sp == 'SP2' ? 'clock' : 
                                            ($invoice->status_sp == 'SP3' ? 'times-circle' : 'file')))
                                        }}"></i>
                                        {{ $invoice->status_sp }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <h4>Info Pembayaran</h4>
                    <div class="card mt-2"> 
                        <div class="card-header text-left">
                            <a href="" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Tambah Pembayaran</a>
                            <a href="" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Tempat Sampah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="data-payment-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Tahun</th>
                                            <th>Status</th>
                                            <th>Aksi Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="" action="" method="POST" style="display: none;">
                                                
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">Total Pembayaran</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
