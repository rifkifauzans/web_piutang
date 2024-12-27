@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Kontrak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Kontrak</a></li>
                            <li class="breadcrumb-item active">Tambah Kontrak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeContracts') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="partner_id">Mitra</label>
                                <select name="partner_id" id="partner_id" class="form-control" required>
                                    <option value="">Pilih Mitra</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->user_id }}">{{ $partner->partner_name }}</option>
                                    @endforeach
                                </select>
                                @error('partner_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="field_id">Bidang</label>
                                <select name="field_id" id="field_id" class="form-control" required>
                                    <option value="">Pilih Bidang</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->field_name }}</option>
                                    @endforeach
                                </select>
                                @error('field_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="badan_hukum">Badan Hukum</label>
                                <input type="text" name="badan_hukum" id="badan_hukum" class="form-control" required placeholder="Masukkan badan hukum">
                                @error('badan_hukum')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pic_aa">PIC AA</label>
                                <input type="text" name="pic_aa" id="pic_aa" class="form-control" required placeholder="Masukkan PIC AA">
                                @error('pic_aa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="awal_janji">Awal Perjanjian</label>
                                <input type="date" name="awal_janji" id="awal_janji" class="form-control" required>
                                @error('awal_janji')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="akhir_janji">Akhir Perjanjian</label>
                                <input type="date" name="akhir_janji" id="akhir_janji" class="form-control" required>
                                @error('akhir_janji')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nilai">Nilai Kontrak</label>
                                <input type="number" name="nilai" id="nilai" class="form-control" required placeholder="Masukkan nilai kontrak">
                                @error('nilai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_pks">Nomor PKS (URL)</label>
                                <input type="url" name="no_pks" id="no_pks" class="form-control" required placeholder="Masukkan URL nomor PKS">
                                @error('no_pks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" required placeholder="Masukkan Lokasi">
                                @error('lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kab_kota">Kabupaten/Kota</label>
                                <input type="text" name="kab_kota" id="kab_kota" class="form-control" required placeholder="Masukkan kabupaten/kota">
                                @error('kab_kota')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="luas">Luas</label>
                                <input type="number" name="luas" id="luas" class="form-control" required placeholder="Masukkan luas">
                                @error('luas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_wa">Nomor WhatsApp (Opsional)</label>
                                <input type="text" name="no_wa" id="no_wa" class="form-control" placeholder="Masukkan nomor WhatsApp">
                                @error('no_wa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea name="ket" id="ket" class="form-control" rows="3" placeholder="Masukkan keterangan"></textarea>
                                @error('ket')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="text-right">
                                <a href="{{ route('listContracts') }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
