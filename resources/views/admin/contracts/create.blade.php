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
                                <label for="employee_id">PIC AA (Penanggung Jawab Kerja Sama)</label>
                                <select name="employee_id" id="employee_id" class="form-control" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->employees_name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
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
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <!-- Input untuk menampilkan nilai terformat -->
        <input type="text" id="formatted_nilai" class="form-control" required placeholder="Masukkan nilai kontrak" oninput="formatRupiah(this)">
        <!-- Input hidden untuk menyimpan nilai asli -->
        <input type="hidden" name="nilai" id="nilai" required>
    </div>
    @error('nilai')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, ''); // Hanya angka
        let formattedValue = new Intl.NumberFormat('id-ID').format(value); // Format sebagai Rupiah

        // Tampilkan nilai terformat di input teks
        input.value = formattedValue; 

        // Simpan angka asli di input hidden
        document.getElementById('nilai').value = value; 
    }
</script>




                            <div class="form-group">
                                <label for="no_pks">Perjanjian Kerja Sama (URL)</label>
                                <input type="url" name="no_pks" id="no_pks" class="form-control" required placeholder="Masukkan URL nomor PKS">
                                @error('no_pks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="region_id">Lokasi</label>
                                <select name="region_id" id="region_id" class="form-control" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($region as $region)
                                        <option value="{{ $region->id }}" data-kab="{{ $region->kab_kota }}">
                                            {{ $region->lokasi }} - {{ $region->kab_kota }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region_id')
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
