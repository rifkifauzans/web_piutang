@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Invoice/Faktur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Kontrak</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listInvoices', ['contractId' => $contract->id]) }}">List Invoice/Faktur</a></li>
                            <li class="breadcrumb-item active">Edit Invoice/Faktur</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('updateInvoice', ['contractId' => $contract->id, 'id' => $invoice->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_terbit">Tanggal Terbit</label>
                                <input type="date" name="tgl_terbit" class="form-control" value="{{ old('tgl_terbit', $invoice->tgl_terbit) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" class="form-control" required>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ $invoice->compensation->tahun == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="draft" {{ $invoice->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="kirim" {{ $invoice->status == 'kirim' ? 'selected' : '' }}>Kirim</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_sp">Status SP</label>
                                <select name="status_sp" class="form-control">
                                    <option value="None" {{ $invoice->status_sp == 'None' ? 'selected' : '' }}>None</option>
                                    <option value="SP1" {{ $invoice->status_sp == 'SP1' ? 'selected' : '' }}>SP1</option>
                                    <option value="SP2" {{ $invoice->status_sp == 'SP2' ? 'selected' : '' }}>SP2</option>
                                    <option value="SP3" {{ $invoice->status_sp == 'SP3' ? 'selected' : '' }}>SP3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jml_denda">Jumlah Denda</label>
                                <input type="number" name="jml_denda" class="form-control" value="{{ old('jml_denda', $invoice->jml_denda) }}" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="jml_bayar">Jumlah Bayar</label>
                                <input type="number" name="jml_bayar" class="form-control" value="{{ old('jml_bayar', $invoice->jml_bayar) }}" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="sisa_tagihan">Sisa Tagihan</label>
                                <input type="number" name="sisa_tagihan" class="form-control" value="{{ old('sisa_tagihan', $invoice->sisa_tagihan) }}" readonly>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('listInvoices', ['contractId' => $contract->id]) }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Update sisa bayar every time jumlah bayar is changed
        document.getElementById('jml_bayar').addEventListener('input', function() {
            const totalTagihan = parseFloat(document.getElementById('total_tagihan').value) || 0;
            const jmlBayar = parseFloat(this.value) || 0;
            const sisaBayar = totalTagihan - jmlBayar;
            document.getElementById('sisa_bayar').value = sisaBayar.toFixed(2);  // Update sisa bayar value
        });
    </script>
@endsection
