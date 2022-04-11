<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaksiPembelianBarang()
    {
        # code...
        return $this->hasMany('transaksi_pembelian_barangs');
    }
}