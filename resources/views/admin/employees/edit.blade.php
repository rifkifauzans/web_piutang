@extends('admin.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('content')
    <br> <br> <br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('listEmployees')}}">List Daftar Karyawan</a></li>
                            <li class="breadcrumb-item active">Edit Karyawan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header text-left">
                        <a class="btn btn-dark" role="button" href="{{ route('listEmployees') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateEmployees', $employees->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ $employees->nik }}" required>
                            </div>
                            <div class="form-group">
                                <label for="employees_name">Nama Karyawan</label>
                                <input type="text" class="form-control" id="employees_name" name="employees_name" value="{{ $employees->employees_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Posisi Jabatan</label>
                                <input type="text" class="form-control" id="position" name="position" value="{{ $employees->position }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $employees->phone_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required>{{ $employees->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Foto Profil</label>
                                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                                @if ($employees->profile_picture)
                                    <img src="{{ Storage::url('employees/' . $employees->profile_picture) }}" alt="Profile Picture" class="mt-2" width="100">
                                @else
                                    No Picture
                                @endif
                            </div>
                            <div class="text-right">
                                <a href="{{ route('listEmployees') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
