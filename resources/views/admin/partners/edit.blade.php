@extends('admin.master')

@section('content') 
<br> <br> <br>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Mitra</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('listPartners') }}">List Daftar Mitra</a></li>
                        <li class="breadcrumb-item active">Edit Mitra</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('updatePartners', ['id' => $partners->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="font-weight-bold">Foto Profil</label>
                            <input type="file" class="form-control" name="profile_partner">
                            @if ($partners->profile_partner)
                                <div class="mt-2">
                                    <img src="{{ Storage::url('partners/'.$partners->profile_partner) }}" alt="Profile Partner" width="150">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="partner_name">Nama Mitra</label>
                            <input type="text" name="partner_name" id="partner_name" class="form-control" required value="{{ $partners->partner_name }}" placeholder="Masukkan Nama Mitra">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required value="{{ $partners->user->email }}" placeholder="Masukkan Email Mitra">
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" name="npwp" id="npwp" class="form-control" required value="{{ $partners->npwp }}" placeholder="Masukkan NPWP Mitra">
                        </div>
                        <div class="form-group">
                            <label for="pic_name">Nama PIC</label>
                            <input type="text" name="pic_name" id="pic_name" class="form-control" required value="{{ $partners->pic_name }}" placeholder="Masukkan Nama PIC">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" name="address" id="address" class="form-control" required value="{{ $partners->address }}" placeholder="Masukkan Alamat Mitra">
                        </div>
                        <div class="text-right">
                            <a href="{{ route('listPartners') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
