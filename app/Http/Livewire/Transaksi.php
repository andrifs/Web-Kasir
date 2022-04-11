<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use DB;

use App\Models\MasterBarang as BarangModel;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $tax = "0%";

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $barang = BarangModel::where('nama_barang', 'like', '%'.$this->search.'%')->orderBy('created_at', 'DESC')->paginate(12);

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
            'order' => 1
        ]);

        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach($items as $item){
                $cart[] = [
                    'rowId' => $item->id,
                    'nama_barang' => $item->name,
                    'jumlah' => $item->quantity,
                    'pricesingle' => $item->price,
                    'harga_satuan' => $item->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);

        $summary = [
            'sub_total' => $sub_total,
            'pajak' => $pajak,
            'total' => $total
        ];

        return view('livewire.transaksi', [
            'barang' => $barang,
            'carts' => $cartData,
            'summary' => $summary
        ]);
    }

    public function addItem($id){
        $rowId = "Cart".$id;
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        $idBarang = substr($rowId, 4,5 ); //perlu diadjust lagi
        $barang = BarangModel::find($idBarang);

        if($cekItemId->isNotEmpty()){
            if($barang->jumlah == $cekItemId[$rowId]->quantity){
                session()->flash('error', 'Jumlah item kurang');
            }else{
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                ]);
            }
        }else{
            if($barang->jumlah == 0){
                session()->flash('error', 'Jumlah item kurang');
            }else{
                \Cart::session(Auth()->id())->add([
                    'id' => "Cart".$barang->id,
                    'name' => $barang->nama_barang,
                    'price' => $barang->harga_satuan,
                    'quantity' => 1,
                    'attributes' => [
                        'added_at' => Carbon::now()
                    ],
                ]);
            }

        }
    }

    public function increment($rowId){

        // dd(preg_replace("/[^0-9]/", "", $rowId));
        $idBarang = preg_replace("/[^0-9]/", "", $rowId);
        $barang = BarangModel::find($idBarang);

        $cart = \Cart::session(Auth()->id())->getContent();

        $checkItem = $cart->whereIn('id', $rowId);

        if($barang->jumlah == $checkItem[$rowId]->quantity){
            session()->flash('error', 'Jumlah item kurang!');
        }else{
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }
    }
    public function decrement($rowId){
        $idBarang = preg_replace("/[^0-9]/", "", $rowId);
        $barang = BarangModel::find($idBarang);

        $cart = \Cart::session(Auth()->id())->getContent();

        $checkItem = $cart->whereIn('id', $rowId);

        if($checkItem[$rowId]->quantity == 1){
            $this->removeItem($rowId);
        }else{
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
        }
    }

    public function removeItem($rowId){
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function handleSubmit() {
        $cartTotal = \Cart::session(Auth()->id())->getTotal();


            try {
                $allCart = \Cart::session(Auth()->id())->getContent();


                $filterCart = $allCart->map(function ($item) {
                    return [
                        'id' => substr($item->id, 4,5 ),
                        'quantity' => $item->quantity,
                    ];
                });


                foreach ($filterCart as $cart) {
                    $barang = BarangModel::find($cart['id']);

                    if($barang->jumlah === 0){
                        return session()->flash('error', 'Jumlah item kurang');
                    }

                    $barang->decrement('jumlah', $cart['quantity']);
                }

               $transaksiId = TransaksiPembelian::create([
                    'user_id' => Auth()->id(),
                    'total_harga' => $cartTotal
                ]);

                // dd($transaksiId->id);
                foreach ($filterCart as $cart) {
                    TransaksiPembelianBarang::create([
                        'master_barang_id' => $cart['id'],
                        'transaksi_pembelian_id' => $transaksiId->id,
                        'jumlah' => $cart['quantity']
                    ]);
                }

                session()->flash('success', 'Transaksi Berhasil');

                \Cart::session(Auth()->id())->clear();


                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return session()->flash('error', $th);
            }
    }

}