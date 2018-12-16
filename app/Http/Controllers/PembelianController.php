<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Bahan;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarPembelian = Pembelian::orderBy('tanggal', 'desc')->get();
        foreach ($daftarPembelian as $pembelian) {
            $pembelian->nama = 'Pembelian '.$pembelian->bahan->nama.' sejumlah '.$pembelian->jumlah.' '.$pembelian->bahan->satuan;
        }
        return view('pembelian.index')->with('daftarPembelian', $daftarPembelian);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelian.create')->with('daftarBahan', Bahan::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bahan' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'tanggal' => 'required|date'
        ]);

        $pembelian = new Pembelian;
        $bahan = Bahan::find($request->input('bahan'));

        $pembelian->jumlah = $request->input('jumlah');
        $pembelian->harga = $request->input('harga');
        $pembelian->tanggal = $request->input('tanggal');
        $pembelian->bahan()->associate($bahan);

        $pembelian->bahan->stok += $pembelian->jumlah;

        $pembelian->push();

        return redirect('/pembelian')->with('success', 'Pembelian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembelian = Pembelian::find($id);
        return view('pembelian.edit')->with('pembelian', $pembelian)->with('daftarBahan', []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jumlah' => 'required',
            'harga' => 'required',
            'tanggal' => 'required|date'
        ]);

        $pembelian = Pembelian::find($id);
        
        $jumlah_diff = $request->input('jumlah') - $pembelian->jumlah;
        $pembelian->jumlah = $request->input('jumlah');
        $pembelian->harga = $request->input('harga');
        $pembelian->tanggal = $request->input('tanggal');

        $pembelian->bahan->stok += $jumlah_diff;

        $pembelian->push();

        return redirect('/pembelian')->with('success', 'Pembelian berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->bahan->stok -= $pembelian->jumlah;
        $pembelian->bahan->save();
        $pembelian->delete();
        return redirect('/pembelian')->with('success', 'Pembelian berhasil dihapus');
    }
}
