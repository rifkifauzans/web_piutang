@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Kompensasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listCompensations', ['contractId' => $contract->id]) }}">List Kompensasi {{ $contract->contract_code }}</a></li>
                            <li class="breadcrumb-item active">Tambah Kompensasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('storeCompensations', ['contractId' => $contract->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tahun_awal">Tahun Awal</label>
                                <input type="number" name="tahun_awal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tahun_akhir">Tahun Akhir</label>
                                <input type="number" name="tahun_akhir" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nilai_kompensasi">Nilai Kompensasi (Tahun Pertama)</label>
                                <input type="number" name="nilai_kompensasi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pbb">PBB (Tahun Pertama)</label>
                                <input type="number" name="pbb" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lainnya">Biaya Lainnya (Opsional)</label>
                                <input type="number" name="lainnya" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control" required>
                            </div>
                            <a href="{{ route('listCompensations', ['contractId' => $contract->id]) }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
