@extends('admin.master')

@section('content')
    <br><br><br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Status Pembayaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Kontrak</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listPayments', ['contractId' => $contract->id]) }}">List Pembayaran</a></li>
                            <li class="breadcrumb-item active">Edit Status Pembayaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('updatePayments', ['contractId' => $contract->id, 'id' => $payment->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="status">Status Pembayaran</label>
                                <select name="status" class="form-control">
                                    <option value="Lunas" {{ $payment->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="Belum Lunas" {{ $payment->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                </select>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('listPayments', ['contractId' => $contract->id]) }}" class="btn btn-outline-secondary mr-2" role="button">Batal</a>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
