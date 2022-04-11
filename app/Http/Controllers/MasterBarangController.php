<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarang;
use RealRashid\SweetAlert\Facades\Alert;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // jika menggunakan datatable
        $masterBarang = MasterBarang::latest()->get();
        // dd($masterBarang);

        //jika menggunakan table biasa
        //$masterBarang = MasterBarang::latest()->paginate(5);

        return view('page.master-barang.index_datatable', compact('masterBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:master_barangs,nama_barang',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ],[
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'nama_barang.unique' => 'Nama barang sudah tersedia',
            'harga_satuan.required' => 'Harga satuan tidak boleh kosong',
            'harga_satuan.numeric' => 'Harga satuan harus berupa Angka',
            'jumlah.required' => 'Stok tidak boleh kosong',
            'jumlah.numeric' => 'Stok harus berupa Angka'
        ]);

        $masterBarang = new MasterBarang;
        $masterBarang->nama_barang = $request->nama_barang;
        $masterBarang->harga_satuan = $request->harga_satuan;
        $masterBarang->jumlah = $request->jumlah;
        $masterBarang->save();

        Alert::success('Berhasil!', 'Data barang berhasil ditambahkan')->autoClose(3000);
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric'
        ],[
            'harga_satuan.required' => 'Harga satuan tidak boleh kosong',
            'harga_satuan.numeric' => 'Harga satuan harus berupa Angka',
            'jumlah.required' => 'Stok tidak boleh kosong',
            'jumlah.numeric' => 'Stok harus berupa Angka'
        ]);

        $masterBarang = MasterBarang::find($id);

        if($request->nama_barang != $masterBarang->nama_barang){
            $request->validate([
                'nama_barang' => 'required|unique:master_barangs,nama_barang',
            ],[
                'nama_barang.required' => 'Nama barang tidak boleh kosong',
                'nama_barang.unique' => 'Nama barang sudah tersedia'
            ]);
        }

        $masterBarang->nama_barang = $request->nama_barang;
        $masterBarang->harga_satuan = $request->harga_satuan;
        $masterBarang->jumlah = $request->jumlah;
        $masterBarang->save();

        Alert::success('Berhasil!', 'Data barang berhasil di edit')->autoClose(3000);
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masterBarang = MasterBarang::find($id);

        $masterBarang->delete();

        Alert::success('Berhasil!', 'Data barang berhasil di Hapus')->autoClose(3000);

        return back();
    }
}
