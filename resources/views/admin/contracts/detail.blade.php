@extends('admin.master')

@section('content') <br> <br> <br>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Kontrak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listContracts') }}">List Daftar Kontrak</a></li>
                            <li class="breadcrumb-item active">Detail Kontrak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('listContracts') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <h3 class="ml-auto mb-0"><small>No Kontrak :</small> {{ $contract->contract_code }}</h3>
                </div>

                <div class="card-body">
                    <h4>Informasi Mitra</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $contract->partner->partner_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>NPWP</strong></td>
                                <td>{{ $contract->partner->npwp }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon</strong></td>
                                <td>
                                    @if($contract->no_wa)
                                        <a href="https://wa.me/{{ $contract->no_wa }}" target="_blank" class="btn btn-success btn-sm" style="margin-left: 10px;">
                                            <i class="fab fa-whatsapp"></i> {{ $contract->no_wa }}
                                        </a>
                                    @else
                                        Tidak tersedia
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PIC Opset</strong></td>
                                <td>{{ $contract->partner->pic_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>PIC AA</strong></td>
                                <td>{{ $contract->pic_aa }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $contract->partner->address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>{{ $contract->lokasi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bagian</strong></td>
                                <td>{{ $contract->field->field_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>{{ $contract->ket }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h4>Detail Kontrak</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Luas (m<sup>2</sup>)</th>
                                <th>Nilai Kompensansi</th>
                                <th>Awal Perjanjian</th>
                                <th>Akhir Perjanjian</th>
                                <th>Jangka Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $contract->luas }} m<sup>2</sup></td>
                                <td>Rp {{ number_format($contract->nilai, 0, ',', '.') }}</td>
                                <td>{{ $contract->awal_janji }}</td>
                                <td>{{ $contract->akhir_janji }}</td>
                                <td>{{ $contract->jangka_waktu }} Tahun</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
