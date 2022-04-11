<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cetak Data Transaksi</title>

    <style>
        table.table-bordered > thead > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid black;
        }
        table.table-bordered > tfoot > tr > td{
            border:1px solid black;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm" style="width:100%;">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Waktu Pembelian</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Harga Satuan</th>
                    <th class="text-center">Total</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($dataTransaksi as $key => $data )
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                        <td>{{ $data->masterBarang->nama_barang }}</td>
                        <td class="text-center">{{ $data->jumlah }}</td>
                        <td class="text-right">Rp  {{number_format($data->masterBarang->harga_satuan,0,',','.')  }}</td>
                        <td class="text-right">Rp {{ number_format($data->jumlah * $data->masterBarang->harga_satuan,0,',','.') }} </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center font-weight-bold" colspan="5"> Total Transaksi</td>
                    <td class="text-right font-weight-bold">Rp {{ number_format($totalHarga->total_harga,0,',','.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
