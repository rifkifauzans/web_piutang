@extends('admin.master')
@section('content')
    <br> <br> <br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listEmployees') }}">List Daftar Karyawan</a></li>
                            <li class="breadcrumb-item active">Tambah Karyawan</li>
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
                        <form action="{{ route('storeEmployees') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required>
                                @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employees_name">Nama Karyawan</label>
                                <input type="text" class="form-control @error('employees_name') is-invalid @enderror" id="employees_name" name="employees_name" required>
                                @error('employees_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="position">Posisi Jabatan</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" required>
                                @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" required>
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required></textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Foto Profil</label>
                                <input type="file" class="form-control-file @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                                @error('profile_picture')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-right">
                                <a href="{{ route('listEmployees') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
