@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Kompensasi Sharing</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Kontrak</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listCompensations', ['contractId' => $contract->id]) }}">List Kompensasi</a></li>
                            <li class="breadcrumb-item active">Tambah Kompensasi Sharing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeCompenshare', ['contractId' => $contract->id]) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" id="tahun" class="form-control" required placeholder="Masukkan tahun">
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pendapatan_mitra">Pendapatan Mitra</label>
                                <input type="number" name="pendapatan_mitra" id="pendapatan_mitra" class="form-control" required placeholder="Masukkan pendapatan mitra">
                                @error('pendapatan_mitra')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kompensasi_sharing">Kompensasi Sharing (30% dari Pendapatan Mitra)</label>
                                <input type="number" name="kompensasi_sharing" id="kompensasi_sharing" class="form-control" readonly>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('listCompensations', ['contractId' => $contract->id]) }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk menghitung Kompensasi Sharing secara otomatis
        document.getElementById('pendapatan_mitra').addEventListener('input', function() {
            var pendapatan = parseFloat(this.value);
            if (!isNaN(pendapatan)) {
                var kompensasi = pendapatan * 0.30;  // Kompensasi Sharing 30% dari Pendapatan Mitra
                document.getElementById('kompensasi_sharing').value = kompensasi.toFixed(2);
            } else {
                document.getElementById('kompensasi_sharing').value = '';
            }
        });
    </script>
@endsection
