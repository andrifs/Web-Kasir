<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function masterBarang(){
        return $this->belongsTo(MasterBarang::class);
    }
    public function transaksiPembelian(){
        return $this->belongsTo(TransaksiPembelian::class);
    }
}