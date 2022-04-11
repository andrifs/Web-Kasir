<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaksi_pembelian()
    {
        # code...
        return $this->belongsTo('transaksi_pembelians', 'transaksi_pembelian_id');
    }

    public function master_barang()
    {
        # code...
        return $this->belongsTo(MasterBarang::class, 'master_barang_id');
    }
}