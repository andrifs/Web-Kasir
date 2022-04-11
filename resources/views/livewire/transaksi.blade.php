<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row pb-2">
                    <div class="col-md-6">
                        <h2 class="font-weight-bold">Data Barang</h2>
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="search" class="form-control" placeholder="Cari barang . . .">
                    </div>
                </div>
                <div class="row">
                    @forelse ($barang as $data )
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-weight-bold">{{ $data->nama_barang }}</h6>
                                    <p class="text-center">Rp {{ number_format($data->harga_satuan,0,',','.') }}</p>
                                    <button wire:click="addItem({{ $data->id }})" class="btn btn-primary btn-sm btn-block">Tambah Transaksi</button>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="col-sm-12 mt-4">
                        <h4 class="text-center font-weight-bold text-danger">Barang tidak ditemukan!</h4>
                    </div>
                    @endforelse
                </div>
                <div class="pull-left pt-4">
                    Showing
                    {{ $barang->firstItem() }}
                    To
                    {{ $barang->lastItem() }}
                    of
                    {{ $barang->total() }}
                    {{-- TOTAL tidak bisa digunakan ketika pake simplePaginate--}}
                    entries
                </div>
                <div class="col float-right">
                    <div class="pagination-block float-right">
                        {{-- hapus class pagination-block, jika menggunakan simplePaginate --}}
                        {{-- hapus isi didalam kurung links, jika menggunakan simplePaginate --}}

                        {{ $barang->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">Transaksi</h2>
                <p class="text-danger font-weight-bold">
                    @if (session()->has('error'))
                        {{ session('error') }}
                    @endif
                </p>
                <p class="text-danger font-weight-bold">
                    @if (session()->has('success'))
                        {{ session('success') }}
                    @endif
                </p>
                <table class="table table-sm table-bordered table-hovered">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Barang</th>
                            <th class="text-center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($carts) --}}
                        @forelse ($carts as $index => $data )
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" class="font-weight-bold text-dark">{{ $data['nama_barang'] }}</a>
                                    <br>
                                    Qty : {{ $data['jumlah'] }}
                                    <a href="#" wire:click="increment('{{$data['rowId']}}')" class="font-weight-bold text-dark" style="font-size: 18px">+</a>
                                    <a href="#" wire:click="decrement('{{$data['rowId']}}')" class="font-weight-bold text-dark" style="font-size: 18px">-</a>
                                    <a href="#" wire:click="removeItem('{{$data['rowId']}}')" class="font-weight-bold text-danger" style="font-size: 13px">X</a>
                                </td>
                                <td class="text-right">Rp {{ number_format($data['harga_satuan'],0,',','.') }}</td>
                            </tr>
                        @empty
                            <td colspan="3"><h6 class="text-center">Transaksi Kosong</h6></td>
                        @endforelse
                        <tr>
                            <td colspan="2" class="text-center font-weight-bold">Total</td>
                            <td class="font-weight-bold text-right">Rp {{ number_format($summary['sub_total'],0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-warning btn-block">Cetak Transaksi</button>
                <form wire:submit.prevent="handleSubmit">
                    <div>
                        <button wire:ignore type="submit" id="saveButton" class="btn btn-success btn-block mt-2">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


