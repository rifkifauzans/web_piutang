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
        /* Custom styles to widen the card */
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
    </script>
    <script>
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
                <h1 class="mb-4 mb-md-0 text-white">Kontrak</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
    <div class="d-inline-flex align-items-center">
        <!-- Improved Home Button -->
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
        <div class="container-fluid mt-5"> <!-- Changed to container-fluid -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Kontrak</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contract as $contract)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contract->contract_code }}</td>
                                        <td>{{ $contract->ket }}</td>
                                        <td>
                                            <button type="button" class="btn btn-{{ $contract->status == 'Baru' ? 'success' : ($contract->status == 'Progress (Surat Izin)' ? 'warning' : ($contract->status == 'Berakhir' ? 'danger' : 'info')) }} btn-sm" disabled>
                                                <i class="fas fa-{{ $contract->status == 'Baru' ? 'check-circle' : ($contract->status == 'Progress (Surat Izin)' ? 'hourglass-half' : ($contract->status == 'Berakhir' ? 'times-circle' : 'flag-checkered')) }}"></i>
                                                {{ $contract->status }}
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('detail', $contract->id) }}" class="btn btn-info btn-sm px-4 py-2 rounded-pill shadow"><i class="fas fa-eye"> Detail Kontrak</i></a>
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

