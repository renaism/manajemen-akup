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
        $daftarMenu = Menu::orderBy('nama', 'asc')->get();
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
            'nama' => 'required|unique:menu,nama',
            'harga' => 'required|integer|gte:0|lte:99999999',
            'gambar' => 'image|nullable|max:1999'
        ]);

        $menu = new Menu;
        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->save();

        // Assigning list of bahan to the menu
        if($request->has('daftarBahan')) {
            foreach ($request->input('daftarBahan') as $key => $bahan_id) {
                $menu->daftarBahan()->attach($bahan_id, [
                    'jumlah' => $request->input('jumlahBahan')[$key]
                ]);
            }
        }

        // Handlie image upload
        if($request->hasFile('gambar')) {
            // Get file name with the extension
            $fNameExt = $request->file('gambar')->getClientOriginalName();
            // Get just the file name
            $fName = pathinfo($fNameExt, PATHINFO_FILENAME);
            // Get just the extension
            $fExt = $request->file('gambar')->getClientOriginalExtension();
            // File name to store
            $fNameStore = 'menuimg'.'_'.$menu->id.'_'.time().'.'.$fExt;
            // Put the image to storage
            $path = Storage::putFileAs('public/menu/gambar', $request->file('gambar'), $fNameStore);
            
            $menu->gambar = $fNameStore;
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
        return view('menu.edit')->with('menu', $menu)->with('daftarBahan', Bahan::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'nama' => 'required|unique:menu,nama,'.$menu->id,
            'harga' => 'required|integer|gte:0|lte:99999999',
            'gambar' => 'image|nullable|max:1999'
        ]);

        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');

        $daftarBahan = [];
        foreach ($request->input('daftarBahan') as $key => $bahan_id) {
            $daftarBahan[$bahan_id] = ['jumlah' => $request->input('jumlahBahan')[$key]]; 
        }
        $menu->daftarBahan()->sync($daftarBahan);

        // Update image if necessary
        if($request->hasFile('gambar')) {
            // Get file name with the extension
            $fNameExt = $request->file('gambar')->getClientOriginalName();
            // Get just the file name
            $fName = pathinfo($fNameExt, PATHINFO_FILENAME);
            // Get just the extension
            $fExt = $request->file('gambar')->getClientOriginalExtension();
            // File name to store
            $fNameStore = 'menuimg'.'_'.$menu->id.'_'.time().'.'.$fExt;
            // Put the image to storage
            $path = Storage::putFileAs('public/menu/gambar', $request->file('gambar'), $fNameStore);
            //Delete the old image
            if($menu->gambar != 'default.jpg') {
                Storage::delete('public/menu/gambar/'.$menu->gambar);
            }

            $menu->gambar = $fNameStore;
        }
        // Delete the image if necessary
        else if($request->input('deleteGambar') == 'true') {
            if($menu->gambar != 'default.jpg') {
                Storage::delete('public/menu/gambar/'.$menu->gambar);
            }
            $menu->gambar = 'default.jpg';
        }

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
        if($menu->gambar != 'default.jpg') {
            // Delete the menu image
            Storage::delete('public/menu/gambar/'.$menu->gambar);
        }
        $menu->delete();
        return redirect('/menu')->with('success', 'Menu berhasil dihapus');
    }
}
