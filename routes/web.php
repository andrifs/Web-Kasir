<?php

use App\Http\Controllers\DaftarTransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\TransaksiController;

use App\Http\Livewire\DaftarTransaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['guest']], function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('dashboard', DashboardController::class);

    Route::resource('transaksi', TransaksiController::class);
    Route::resource('daftar-transaksi', DaftarTransaksiController::class);
    Route::get('cetak/{id}', [DaftarTransaksiController::class, 'print'])->name('cetak');
});

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::resource('user', UserController::class);
    Route::resource('master-barang', MasterBarangController::class);
});

Route::get('/error', function () {
    return view('error');
});