<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Bahan;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarBahan = Bahan::all();
        return view('bahan.index')->with('daftarBahan', $daftarBahan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bahan.create');
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
            'nama' => 'required|unique:bahan,nama',
            'satuan' => 'required',
            'stok' => 'required|numeric|gte:0|lte:999999.99'
        ]);

        $bahan = new Bahan;
        $bahan->nama = $request->input('nama');
        $bahan->satuan = $request->input('satuan');
        $bahan->stok = $request->input('stok');
        $bahan->save();

        return redirect('/bahan')->with('success', 'Bahan berhasil ditambahkan');
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
        $bahan = Bahan::find($id);
        return view('bahan.edit')->with('bahan', $bahan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bahan $bahan)
    {
        $this->validate($request, [
            'nama' => 'required|unique:bahan,nama,'.$bahan->id,
            'satuan' => 'required',
            'stok' => 'required|numeric|gte:0|lte:999999.99'
        ]);

        $bahan->nama = $request->input('nama');
        $bahan->satuan = $request->input('satuan');
        $bahan->stok = $request->input('stok');
        $bahan->save();

        return redirect('/bahan')->with('success', 'Bahan berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahan $bahan)
    {
        $bahan->daftarMenu()->detach();
        $bahan->delete();
        return redirect('/bahan')->with('success', 'Bahan berhasil dihapus');
    }
}
