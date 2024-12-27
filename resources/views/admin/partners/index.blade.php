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
                text: "Are you sure you want to delete this partner?",
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

@section('content')
    <br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">LIST DAFTAR MITRA</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header text-left">
                        <a href="{{ route('createPartners') }}" class="btn btn-info" role="button"><i class="fas fa-plus"></i> Tambah Mitra</a>
                        <a class="btn btn-dark" role="button" href="/admin"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{ route('trashPartners') }}" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Sampah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto Profil</th>
                                        <th>Nama Mitra</th>
                                        <th>Email</th>
                                        <th>NPWP</th>
                                        <th>Nama PIC</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partners as $partner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($partner->profile_partner)
                                                <img src="{{ Storage::url('partners/' . $partner->profile_partner) }}" alt="Profile Partner">
                                            @else
                                                No Picture
                                            @endif
                                        </td>
                                        <td>{{ $partner->partner_name }}</td>
                                        <td>{{ $partner->user ? $partner->user->email : 'No Email' }}</td>
                                        <td>{{ $partner->npwp }}</td>
                                        <td>{{ $partner->pic_name }}</td>
                                        <td>{{ $partner->address }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('editPartners', $partner->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $partner->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            <form id="delete-form-{{ $partner->id }}" action="{{ route('deletePartners', $partner->id) }}" method="POST" style="display: none;">
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
