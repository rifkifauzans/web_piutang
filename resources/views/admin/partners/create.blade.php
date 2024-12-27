@extends('admin.master')
@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Mitra</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listPartners') }}">List Daftar Mitra</a></li>
                            <li class="breadcrumb-item active">Tambah Mitra</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storePartners') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="profile_partner">Foto Profil</label>
                                <input type="file" class="form-control-file @error('profile_partner') is-invalid @enderror" id="profile_partner" name="profile_partner">
                                @error('profile_partner')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="partner_name">Nama Mitra</label>
                                <input type="text" name="partner_name" id="partner_name" class="form-control @error('partner_name') is-invalid @enderror" required placeholder="Enter partner name">
                                @error('partner_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="name" id="name" value="Partner">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Enter email" autocomplete="email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Enter password" autocomplete="current-password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="userType" id="userType" value="partner">
                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input type="text" name="npwp" id="npwp" class="form-control @error('npwp') is-invalid @enderror" required placeholder="Enter npwp">
                                @error('npwp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pic_name">Nama PIC</label>
                                <input type="text" name="pic_name" id="pic_name" class="form-control @error('pic_name') is-invalid @enderror" required placeholder="Enter pic name">
                                @error('pic_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" required placeholder="Enter address">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-right">
                                <a href="{{ route('listPartners') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
