@extends('user.detailContract')
@section('addCss')
    <style>
        .btn-custom {
            display: inline-flex;
            align-items: center;
            padding: 0.5em 1em;
            font-size: 1rem;
            border-radius: 0.25em;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-custom i {
            margin-right: 0.5em;
            font-size: 1.2em;
        }

        .btn-custom-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-custom-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
@section('content')
    <!-- Page Header Start -->
    <br> <Br> </Br>
    <div class="page-header container-fluid bg-secondary pt-2 pt-lg-5 pb-2 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="mb-4 mb-md-0 text-white">Pembayaran</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn text-white" href="{{ url('/') }}">Home</a>
                        <i class="fas fa-angle-right text-white"></i>
                        <a class="btn text-white disabled" href="#">Tambah Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="main-content">
        <div class="container">
            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="{{ route('detail', $contract->id) }}" class="btn btn-custom btn-custom-secondary btn-sm"> <!-- Menggunakan gaya tombol custom dan secondary -->
                                <i class="fas fa-arrow-left"></i> Back 
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('storePayment', ['contractId' => $contract->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control" required>
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($invoice as $inv)
                                            <option value="{{ $inv->compensation->tahun }}">{{ $inv->compensation->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_bayar">Upload Bukti Bayar</label>
                                    <input type="file" class="form-control-file @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar">
                                    @error('bukti_bayar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_bayar">Tanggal Bayar</label>
                                    <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea name="ket" id="ket" class="form-control" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="status" value="Belum Lunas">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('detail', $contract->id) }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection