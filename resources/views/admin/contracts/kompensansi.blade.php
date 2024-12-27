@extends('admin.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-responsive img {
            width: 100px;
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
        .table-responsive tbody td {
            vertical-align: middle;
        }
        .content-header {
            margin-bottom: 20px;
        }
        .content-wrapper {
            padding-top: 20px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();  
            $("#data-sharing-table").DataTable();  

            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: "Confirm Delete",
                text: "Are you sure you want to delete this contract?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

@section('content') <br> <br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Kompensasi {{ $contract->contract_code }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <!-- Kompensasi Section -->
                <div class="card">
                    <div class="card-header text-left">
                        <a class="btn btn-dark" role="button" href="{{ route('listContracts') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{ route('createCompensations', ['contractId' => $contract->id]) }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Tambah Kompensansi</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Nilai</th>
                                        <th>PPN</th>
                                        <th>Nilai + PPN</th>
                                        <th>PBB</th>
                                        <th>Lainnya</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kompensasi as $compensation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $compensation->tahun }}</td>
                                        <td>{{ \Carbon\Carbon::parse($compensation->jatuh_tempo)->format('d-m-Y') }}</td>
                                        <td>Rp {{ number_format($compensation->nilai_kompensansi, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensation->ppn, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensation->nilai_plus_ppn, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensation->pbb, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensation->lainnya, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensation->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: center;">Total</th>
                                        <th>{{ number_format($totals['totalNilaiKompensasi'], 2) }}</th>
                                        <th>{{ number_format($totals['totalPPN'], 2) }}</th>
                                        <th>{{ number_format($totals['totalNilaiPlusPPN'], 2) }}</th>
                                        <th>{{ number_format($totals['totalPBB'], 2) }}</th>
                                        <th>{{ number_format($totals['totalLainnya'], 2) }}</th>
                                        <th>{{ number_format($totals['totalKompensasi'], 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-5"> 
                    <div class="card-header text-left">
                        <h4>Kompensasi Sharing</h4> <br>
                        <a href="{{ route('createCompenshare', ['contractId' => $contract->id]) }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Tambah Kompensansi Sharing</a>
                        <a href="{{ route('trashCompenshare', ['contractId' => $contract->id]) }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Tempat Sampah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="data-sharing-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Pendapatan</th>
                                        <th>Kompensasi Sharing</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kompensasiSharing as $compensationshare)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $compensationshare->tahun }}</td>
                                        <td>Rp {{ number_format($compensationshare->pendapatan_mitra, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($compensationshare->kompensasi_sharing, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('editCompenshare', ['contractId' => $contract->id, 'id' => $compensationshare->id ]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $contract->id }}, {{ $compensationshare->id }})" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $compensationshare->id }}" action="{{ route('destroyCompenshare', ['contractId' => $contract->id, 'id' => $compensationshare->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: center;">Total Kompensasi Sharing</th>
                                        <th colspan="2">{{ number_format($totals['totalKompensasiSharing'], 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
