<?php

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

Route::get('/', function () {
    return view('index');
});

Route::resource('bahan', 'BahanController');
Route::resource('menu', 'MenuController');
Route::resource('pembelian', 'PembelianController');
Route::resource('transaksi', 'TransaksiController');
Route::get('/keuangan', 'RekapKeuanganController@index');