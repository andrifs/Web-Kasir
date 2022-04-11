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
                                        <button class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modalEdit-{{ $data->id }}">Edit</button>
                                        <form action="{{ route('master-barang.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <a href="{{ route('master-barang.show', $data->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                            <input type="submit" class="btn btn-danger my-1 btn-sm show_confirm" value="Delete">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <!-- Modal create-->
    <div class="modal fade" id="modalCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('master-barang.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga_satuan">Harga Satuan</label>
                                <input type="number" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" value="{{ old('harga_satuan') }}">
                                @error('harga_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Modal Edit-->
    @foreach ($daftarTransaksi as $dta )
        <div class="modal fade" id="modalEdit-{{ $dta->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('master-barang.update', $dta->id) }}" method="post">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" value="{{ old('nama_barang', $dta->nama_barang) }}">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" value="{{ old('harga_satuan', $dta->harga_satuan) }}">
                                    @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}
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
