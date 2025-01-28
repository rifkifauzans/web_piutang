@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Invoice/Faktur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Kontrak</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listInvoices', ['contractId' => $contract->id]) }}">List Invoice/Faktur</a></li>
                            <li class="breadcrumb-item active">Tambah Invoice/Faktur</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeInvoice', ['contractId' => $contract->id]) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="">Pilih Tahun</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_terbit">Tanggal Terbit</label>
                                <input type="date" name="tgl_terbit" id="tgl_terbit" class="form-control" required>
                                @error('tgl_terbit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_tagihan">Total Tagihan</label>
                                <input type="number" name="total_tagihan" id="total_tagihan" class="form-control" readonly>
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
        // Data kompensasi yang diterima dari backend
        const kompensasiData = @json($kompensasi);

        // Fungsi untuk mencari kompensasi berdasarkan tahun yang dipilih
        function getKompensasiByYear(year) {
            return kompensasiData.find(k => k.tahun == year);
        }

        // Event listener ketika memilih tahun
        document.getElementById('tahun').addEventListener('change', function() {
            const selectedYear = this.value;
            const kompensasi = getKompensasiByYear(selectedYear);

            if (kompensasi) {
                // Hitung total tagihan berdasarkan kompensasi
                const totalTagihan = kompensasi.total; // Asumsi total tagihan dari kompensasi
                document.getElementById('total_tagihan').value = totalTagihan.toFixed(2);
            } else {
                document.getElementById('total_tagihan').value = '';
            }
        });
    </script>
@endsection
