@extends('admin.master')

@section('addCss')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Tambahkan style untuk tampilan */
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
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();

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
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete this data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

@section('content')
    <br> <br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">LIST DAFTAR INVOICE (FAKTUR)</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header text-left">
                    <a href="{{ route('createInvoices', ['contractId' => $contract->id]) }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Faktur</a>
                        <a class="btn btn-dark" role="button" href="{{ route('listContracts') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{ route('trashInvoices', ['contractId' => $contract->id]) }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Tempat Sampah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Tanggal Terbit</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Nilai Tagihan</th>
                                        <th>Sisa Tagihan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->compensation ? $invoice->compensation->tahun : 'Tahun tidak ditemukan' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($invoice->tgl_terbit)->format('d-m-Y') }}</td>
                                        <td>{{ $invoice->compensation ? \Carbon\Carbon::parse($invoice->compensation->jatuh_tempo)->format('d-m-Y') : 'Jatuh Tempo tidak ditemukan' }}</td>
                                        <td>{{ $invoice->total_tagihan }}</td>
                                        <td>{{ $invoice->sisa_tagihan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-{{ $invoice->status == 'draft' ? 'secondary' : ($invoice->status == 'kirim' ? 'success' : 'primary') }} btn-sm">
                                                <i class="fas fa-{{ $invoice->status == 'draft' ? 'file-alt' : ($invoice->status == 'kirim' ? 'truck' : 'paper-plane') }}"></i>
                                                {{ $invoice->status }}
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('editInvoice', ['contractId' => $contract->id, 'id' => $invoice->id ]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $contract->id }}, {{ $invoice->id }})" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $invoice->id }}" action="{{ route('destroyInvoice', ['contractId' => $contract->id, 'id' => $invoice->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
