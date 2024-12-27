@extends('admin.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .content-wrapper {
            padding: 0 15px;
        }

        .content-header h1 {
            margin-bottom: 15px; /* Adjust as needed */
        }

        .table-responsive {
            margin-top: 0;
        }

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

        @media (max-width: 576px) {
            .table thead th,
            .table tbody td {
                font-size: 12px;
                padding: 5px;
            }

            .table .btn-group .btn {
                font-size: 10px;
                padding: 3px 6px;
            }
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();
        });

        function confirmPermanentDelete(id) {
            swal({
                title: 'Confirm Permanent Delete',
                text: 'Are you sure you want to delete this data permanently?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

@section('content') <br> <br> <br> 
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kontrak dalam Sampah</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Daftar Kontrak</a></li>
                            <li class="breadcrumb-item active">Sampah Kontrak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container mt-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('listContracts') }}" class="btn btn-dark" role="button">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Kontrak</th>
                                        <th>Nama Mitra</th>
                                        <th>Badan Hukum</th>
                                        <th>Jangka Waktu</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($trashedContracts as $trashedContract)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $trashedContract->contract_code }}</td>
                                        <td>{{ $trashedContract->partner->partner_name }}</td>
                                        <td>{{ $trashedContract->badan_hukum }}</td>
                                        <td>{{ $trashedContract->jangka_waktu }}</td>
                                        <td>Rp {{ number_format($trashedContract->nilai, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-{{ $trashedContract->status == 'Baru' ? 'success' : ($trashedContract->status == 'Progress (Surat Izin)' ? 'warning' : 'info') }} btn-sm" disabled>
                                                <i class="fas fa-{{ $trashedContract->status == 'Baru' ? 'check-circle' : ($trashedContract->status == 'Progress (Surat Izin)' ? 'hourglass-half' : 'flag-checkered') }}"></i>
                                                {{ $trashedContract->status }}
                                            </button>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('restoreContracts', ['id' => $trashedContract->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-trash-restore"></i> Pulihkan
                                                    </button>
                                                </form>
                                                <form id="delete-form-{{ $trashedContract->id }}" action="{{ route('forceDeleteContracts', ['id' => $trashedContract->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="confirmPermanentDelete({{ $trashedContract->id }})" class="btn btn-danger btn-sm" role="button">
                                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection