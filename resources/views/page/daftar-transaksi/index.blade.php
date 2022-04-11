@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" >Tabel Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Pembelian</th>
                            <th>Total Harga</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarTransaksi as $key => $data )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                                <td class="text-right">Rp.  {{number_format($data->total_harga,0,',','.')  }}</td>
                                <td class="text-center">
                                    <div class="form-inline justify-content-center">
                                        <a href="{{ route('daftar-transaksi.show', $data->id) }}" class="btn btn-primary btn-sm mr-1">Detail</a>
                                        <a href="{{ route('cetak', $data->id) }}" class="btn btn-info btn-sm mr-1">Cetak</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


