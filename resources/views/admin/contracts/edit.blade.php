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
                                <label for="partner_id">Mitra</label>
                                <select class="form-control" id="partner_id" name="partner_id" required>
                                    <option value="">Pilih Mitra</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->user_id }}" {{ $contracts->partner_id == $partner->user_id ? 'selected' : '' }}>{{ $partner->partner_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="field_id">Bidang</label>
                                <select class="form-control" id="field_id" name="field_id" required>
                                    <option value="">Pilih Bidang</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}" {{ $contracts->field_id == $field->id ? 'selected' : '' }}>{{ $field->field_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_id">PIC AA (Penanggung Jawab Kerja Sama)</label>
                                <select class="form-control" id="employee_id" name="employee_id" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $contracts->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->employees_name }}</option>
                                    @endforeach
                                </select>
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
    <label for="nilai">Nilai Kontrak</label>
    <div class="input-group">
        <!-- Input untuk menampilkan nilai terformat -->
        <input type="text" class="form-control" id="formatted_nilai" name="formatted_nilai" value="{{ number_format($contracts->nilai, 0, ',', '.') }}" required placeholder="Masukkan nilai kontrak" oninput="formatRupiah(this)">
        <div class="input-group-append">
            <span class="input-group-text">Rp</span>
        </div>
        <!-- Input hidden untuk menyimpan nilai asli -->
        <input type="hidden" name="nilai" id="nilai" value="{{ $contracts->nilai }}" required>
    </div>
    @error('nilai')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString(); // Hanya angka dan koma
        let split = value.split(',');
        let remainder = split[0].length % 3;
        let rupiah = split[0].substr(0, remainder);
        let thousands = split[0].substr(remainder).match(/\d{3}/gi);
        
        if (thousands) {
            separator = remainder ? '.' : '';
            rupiah += separator + thousands.join('.');
        }
        
        input.value = rupiah + (split[1] ? ',' + split[1] : '');
        
        // Simpan angka asli di input hidden
        document.getElementById('nilai').value = value.replace(',', ''); // Hilangkan koma untuk nilai asli
    }
</script>

                            <div class="form-group">
                                <label for="no_pks">Perjanjian Kerja Sama (URL)</label>
                                <input type="url" class="form-control" id="no_pks" name="no_pks" value="{{ $contracts->no_pks }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="region_id">Lokasi</label>
                                <select name="region_id" id="region_id" class="form-control" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($region as $region)
                                        <option value="{{ $region->id }}" 
                                            {{ old('region_id', $contracts->region_id) == $region->id ? 'selected' : '' }} 
                                            data-kab="{{ $region->kab_kota }}">
                                            {{ $region->lokasi }} - {{ $region->kab_kota }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="luas">Luas (m²)</label>
                                <input type="number" class="form-control" id="luas" name="luas" value="{{ $contracts->luas }}" required min="1">
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
