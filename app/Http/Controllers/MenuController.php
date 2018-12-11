<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Menu;
use App\Bahan;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarMenu = Menu::orderBy('nama', 'asc')->paginate(10);
        return view('menu.index')->with('daftarMenu', $daftarMenu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create')->with('daftarBahan', Bahan::all());
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
            'nama' => 'required',
            'harga' => 'required|integer|gte:0|lte:99999999'
        ]);

        $menu = new Menu;
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->save();

        foreach ($request->input('daftarBahan') as $key => $bahan_id) {
            $menu->daftarBahan()->attach($bahan_id, [
                'jumlah' => $request->input('jumlahBahan')[$key]
            ]);
        }

        $menu->push();

        return redirect('/menu')->with('success', 'Menu berhasil ditambahkan');
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
        $menu = Menu::find($id);
        return view('menu.edit')->with('menu', $menu)->with('daftarBahan', Bahan::all());;
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
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|integer|gte:0|lte:99999999'
        ]);

        $menu = Menu::find($id);
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $daftarBahan = [];
        foreach ($request->input('daftarBahan') as $key => $bahan_id) {
            $daftarBahan[$bahan_id] = ['jumlah' => $request->input('jumlahBahan')[$key]]; 
        }
        $menu->daftarBahan()->sync($daftarBahan);

        $menu->push();

        return redirect('/menu')->with('success', 'Menu berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->daftarBahan()->detach();
        $menu->delete();
        return redirect('/menu')->with('success', 'Menu berhasil dihapus');
    }
}
