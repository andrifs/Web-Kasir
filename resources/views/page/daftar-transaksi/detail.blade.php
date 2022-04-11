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
                            <th class="text-center">No</th>
                            <th class="text-center">Waktu Pembelian</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarTransaksi as $key => $data )
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
        </div>
    </div>

    {{-- @foreach ($daftarTransaksi as $dta )
        <div class="modal fade" id="modalEdit-{{ $dta->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{ $dta->transaksiPembelianBarang->harga_satuan }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                </div>
            </div>
        </div>
    @endforeach  --}}
@endsection

@push('scripts')
    {{-- DataTable --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}


    <script src=" {{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }} "></script>

    <script>
        $(document).ready(function() {
            // DataTables initialisation
            // var table = $('#example').DataTable();
        });
    </script>
@endpush
