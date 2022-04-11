<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TransaksiPembelian;

class DaftarTransaksi extends Component
{
    public $daftarTransaksi;
    public $date;
    public $ulala = "Data";

    public function dateFilter()
    {
        # code...
        $this->ulala = "Ganti";
    }

    public function mount()
    {
        # code...
        $this->daftarTransaksi = TransaksiPembelian::latest()->get();
        $this->ulala = "Data";
    }
    public function render()
    {
        
        return view('livewire.daftar-transaksi', [
            'dataTransaksi' => $this->daftarTransaksi
        ]);
    }
}
