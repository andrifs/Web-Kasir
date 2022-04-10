<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterBarang;

class MasterBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterBarang::create([
            'nama_barang' => 'Sabun Batang',
            'harga_satuan' => 3000,
            'jumlah' => 10
        ]);
        MasterBarang::create([
            'nama_barang' => 'Mi Instan',
            'harga_satuan' => 2000,
            'jumlah' => 12
        ]);
        MasterBarang::create([
            'nama_barang' => 'Pensil',
            'harga_satuan' => 1000,
            'jumlah' => 19
        ]);
        MasterBarang::create([
            'nama_barang' => 'Kopi Sachet',
            'harga_satuan' => 1500,
            'jumlah' => 5
        ]);
        MasterBarang::create([
            'nama_barang' => 'Air Minum Galon',
            'harga_satuan' => 20000,
            'jumlah' => 20
        ]);
    }
}
