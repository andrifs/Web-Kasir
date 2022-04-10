@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Barang</h1>
    <p class="mb-4">Berikut merupakan data Master Barang</p>
    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalCreate">Tambah Data Barang</button>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Master Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th class="text-center" style="width: 30%">Nama Barang</th>
                            <th class="text-center" style="width: 15%">Harga Sastuan</th>
                            <th class="text-center" style="width: 10%">Stok</th>
                            <th class="text-center" style="width: 15%">Tanggal Dibuat</th>
                            <th class="text-center" style="width: 25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($masterBarang as $key => $data )
                        <tr>
                            <td class="text-center">{{ $masterBarang->firstItem() + $key }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td class="text-right">Rp. {{number_format($data->harga_satuan,0,',','.')  }}</td>
                            <td class="text-center">{{ $data->jumlah }} pcs</td>
                            <td>{{ Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                            <td class="text-center">
                                <div class="form-inline justify-content-center">
                                    <button class="btn btn-primary btn-sm mr-1" data-toggle="modal"
                                        data-target="#modalEdit-{{ $data->id }}">Edit</button>
                                    <form action="{{ route('master-barang.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <a href="{{ route('master-barang.show', $data->id) }}" class="btn btn-info
                                        btn-sm">Detail</a> --}}
                                        <input type="submit" class="btn btn-danger my-1 btn-sm show_confirm"
                                            value="Delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">Data Kosong !</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pull-left">
                    Showing
                    {{ $masterBarang->firstItem() }}
                    To
                    {{ $masterBarang->lastItem() }}
                    of
                    {{ $masterBarang->total() }}
                    {{-- TOTAL tidak bisa digunakan ketika pake simplePaginate--}}
                    entries
                </div>
                <div class="col float-right">
                    <div class="pagination-block float-right">
                        {{-- hapus class pagination-block, jika menggunakan simplePaginate --}}
                        {{-- hapus isi didalam kurung links, jika menggunakan simplePaginate --}}

                        {{ $masterBarang->links('layouts.paginate.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal create-->
<div class="modal fade" id="modalCreate" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <input type="text" name="nama_barang"
                                class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                value="{{ old('nama_barang') }}">
                            @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="number" name="harga_satuan"
                                class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan"
                                value="{{ old('harga_satuan') }}">
                            @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Stok</label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                value="{{ old('jumlah') }}">
                            @error('jumlah')
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
@foreach ($masterBarang as $dta )
<div class="modal fade" id="modalEdit-{{ $dta->id }}" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <input type="text" name="nama_barang"
                                class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                value="{{ old('nama_barang', $dta->nama_barang) }}">
                            @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="number" name="harga_satuan"
                                class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan"
                                value="{{ old('harga_satuan', $dta->harga_satuan) }}">
                            @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Stok</label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                value="{{ old('jumlah', $dta->jumlah) }}">
                            @error('jumlah')
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
@endforeach

@endsection
