<?php

namespace Database\Seeders;

use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;
use Illuminate\Database\Seeder;

class TransaksiPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TransaksiPembelian::create([
            'total_harga' => '27500'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '3000',
            'master_barang_id' => '1',
            'transaksi_pembelian_id' => '3'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '2000',
            'master_barang_id' => '2',
            'transaksi_pembelian_id' => '3'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '1000',
            'master_barang_id' => '3',
            'transaksi_pembelian_id' => '3'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '1500',
            'master_barang_id' => '4',
            'transaksi_pembelian_id' => '3'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '20000',
            'master_barang_id' => '5',
            'transaksi_pembelian_id' => '3'
        ]);
        TransaksiPembelian::create([
            'total_harga' => '27500'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '3000',
            'master_barang_id' => '1',
            'transaksi_pembelian_id' => '4'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '2000',
            'master_barang_id' => '2',
            'transaksi_pembelian_id' => '4'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '1000',
            'master_barang_id' => '3',
            'transaksi_pembelian_id' => '4'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '1500',
            'master_barang_id' => '4',
            'transaksi_pembelian_id' => '4'
        ]);
        TransaksiPembelianBarang::create([
            'jumlah' => '1',
            'harga_satuan' => '20000',
            'master_barang_id' => '5',
            'transaksi_pembelian_id' => '4'
        ]);
    }
}
