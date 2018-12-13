<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Bahan;
use App\Menu;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarTransaksi = Transaksi::orderBy('tanggal', 'desc')->paginate(10);
        foreach ($daftarTransaksi as $transaksi) {
            //
        }
        return view('transaksi.index')->with('daftarTransaksi', $daftarTransaksi); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create')->with('daftarMenu', Menu::all());
    }

    private function cekKetersediaan($daftar_pesan) {
        $bahan_needed = [];
        foreach ($daftar_pesan as $menu_id => $jumlah) {
            $menu = Menu::find($menu_id);
            foreach ($menu->daftarBahan as $bahan) {
                if (isset($bahan_needed[$bahan->id])) {
                    $bahan_needed[$bahan->id] += $bahan->pivot->jumlah * $jumlah;
                }
                else {
                    $bahan_needed[$bahan->id] = $bahan->pivot->jumlah * $jumlah;
                }
            }
        }

        foreach ($bahan_needed as $bahan_id => $needed) {
            $bahan = Bahan::find($bahan_id);
            if ($bahan->stok < $needed) {
                return false;
            }
        }
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bahan_available = $this->cekKetersediaan($request->input('jumlah'));
        if($bahan_available) {
            $transaksi = new Transaksi;
            return redirect('/transaksi/create')->with('success', 'Bahan tersedia');
        }
        else {
            return back()->withInput()->with('error', 'Bahan tidak cukpu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
