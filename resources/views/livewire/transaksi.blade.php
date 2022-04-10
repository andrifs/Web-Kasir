<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">Data Barang</h2>
                <div class="row">
                    @foreach ($barang as $data )
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-weight-bold">{{ $data->nama_barang }}</h6>
                                    <p class="text-center">Rp {{ $data->harga_satuan }}</p>
                                    <button wire:click="addItem({{ $data->id }})" class="btn btn-primary btn-sm btn-block">Tambah Transaksi</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">Transaksi</h2>
                <table class="table table-sm table-bordered table-striped table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($carts) --}}
                        @forelse ($carts as $index => $data )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['nama_barang'] }} || {{ $data['jumlah'] }}</td>
                                <td>{{ $data['harga_satuan'] }}</td>
                            </tr>
                        @empty
                            <td colspan="3"><h6 class="text-center">Transaksi Kosong</h6></td>
                        @endforelse
                        <tr>
                            <td colspan="2" class="text-center font-weight-bold">Total</td>
                            <td class="font-weight-bold">{{ $summary['sub_total'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>
                    <button class="btn btn-warning btn-block">Cetak Transaksi</button>
                    <button class="btn btn-success btn-block">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</div>
