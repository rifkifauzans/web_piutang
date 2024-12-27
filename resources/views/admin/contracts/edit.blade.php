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
                        <h1 class="m-0">Edit Kontrak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Daftar Kontrak</a></li>
                            <li class="breadcrumb-item active">Edit Kontrak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header text-left">
                        <a class="btn btn-dark" role="button" href="{{ route('listContracts') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateContracts', $contracts->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="partner_id">Partner</label>
                                <select class="form-control" id="partner_id" name="partner_id" required>
                                    <option value="">Pilih Partner</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->user_id }}" {{ $contracts->partner_id == $partner->user_id ? 'selected' : '' }}>{{ $partner->partner_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="field_id">Field</label>
                                <select class="form-control" id="field_id" name="field_id" required>
                                    <option value="">Pilih Field</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}" {{ $contracts->field_id == $field->id ? 'selected' : '' }}>{{ $field->field_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="badan_hukum">Badan Hukum</label>
                                <input type="text" class="form-control" id="badan_hukum" name="badan_hukum" value="{{ $contracts->badan_hukum }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="pic_aa">PIC AA</label>
                                <input type="text" class="form-control" id="pic_aa" name="pic_aa" value="{{ $contracts->pic_aa }}" required>
                            </div>

                            <div class="form-group">
                                <label for="awal_janji">Awal Janji</label>
                                <input type="date" class="form-control" id="awal_janji" name="awal_janji" value="{{ $contracts->awal_janji }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="akhir_janji">Akhir Janji</label>
                                <input type="date" class="form-control" id="akhir_janji" name="akhir_janji" value="{{ $contracts->akhir_janji }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="nilai">Nilai</label>
                                <input type="number" class="form-control" id="nilai" name="nilai" value="{{ $contracts->nilai }}" required min="0">
                            </div>
                            
                            <div class="form-group">
                                <label for="no_pks">No PKS</label>
                                <input type="url" class="form-control" id="no_pks" name="no_pks" value="{{ $contracts->no_pks }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $contracts->lokasi }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="kab_kota">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="kab_kota" name="kab_kota" value="{{ $contracts->kab_kota }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="luas">Luas (m²)</label>
                                <input type="number" class="form-control" id="luas" name="luas" value="{{ $contracts->luas }}" required min="1">
                            </div>
                            
                            <div class="form-group">
                                <label for="no_wa">Nomor WA (Opsional)</label>
                                <input type="text" class="form-control" id="no_wa" name="no_wa" value="{{ $contracts->no_wa }}">
                            </div>

                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control" id="ket" name="ket" rows="3">{{ $contracts->ket }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Baru" {{ $contracts->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="Progress (Surat Izin)" {{ $contracts->status == 'Progress (Surat Izin)' ? 'selected' : '' }}>Progress (Surat Izin)</option>
                                    <option value="Berakhir" {{ $contracts->status == 'Berakhir' ? 'selected' : '' }}>Berakhir</option>
                                </select>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('listContracts') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
