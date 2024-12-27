@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Bidang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listFields') }}">List Bidang</a></li>
                            <li class="breadcrumb-item active">Tambah Bidang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeFields') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="field_name">Nama Bidang</label>
                                <input type="text" name="field_name" id="field_name" class="form-control" placeholder="Masukkan nama bidang">
                                @error('field_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-right">
                                <a href="{{ route('listFields') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
