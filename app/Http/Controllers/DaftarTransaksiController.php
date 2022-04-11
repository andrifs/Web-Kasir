<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;
use PDF;

class DaftarTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $daftarTransaksi = "";
        if (auth()->user()->role == "kasir") {
            # code...
            $daftarTransaksi = TransaksiPembelian::whereDate('created_at', Carbon::today())->latest()->get();
        }else{
            $daftarTransaksi = TransaksiPembelian::latest()->get();
        }

        return view('page.daftar-transaksi.index', compact('daftarTransaksi'));
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
        //
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
        $totalHarga = TransaksiPembelian::find($id);
        $daftarTransaksi = TransaksiPembelianBarang::where('transaksi_pembelian_id', $id)->get();
        return view('page.daftar-transaksi.detail', compact('daftarTransaksi', 'totalHarga'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($id)
    {
        # code...
        $dataTransaksi = TransaksiPembelianBarang::where('transaksi_pembelian_id', $id)->get();
        $totalHarga = TransaksiPembelian::find($id);
        $data = [
            'title' => 'Data Transaksi Kasir SIPD JABAR',
            'date' => date('m/d/Y'),
            'dataTransaksi' => $dataTransaksi,
            'totalHarga' => $totalHarga
        ];

        // dd($data);
        $pdf = PDF::loadView('page.daftar-transaksi.print', $data);
        return $pdf->stream();
    }


}
