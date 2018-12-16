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
            $transaksi->nama = "Transaksi pada tanggal ".date('d F Y', strtotime($transaksi->tanggal))." jam ".date('H:i', strtotime($transaksi->tanggal));
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
        $bahan_lack = [];
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
                $bahan_lack[] = $bahan;
            }
        }
        return $bahan_lack;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bahan_lack = $this->cekKetersediaan($request->input('jumlah'));
        if(count($bahan_lack) > 0) {
            $bahan_lack_string = "";
            for($i = 0; $i < count($bahan_lack)-1; $i++) {
                $bahan_lack_string .= $bahan_lack[$i]->nama . ', ';
            }
            $bahan_lack_string .= $bahan_lack[$i]->nama;
            return back()->withInput()->with('error', 'Bahan berikut kurang: '.$bahan_lack_string);
        }
        else {
            $transaksi = new Transaksi;
            $transaksi->tanggal = date('Y-m-d H:i:s');
            $transaksi->save();
            foreach ($request->input('jumlah') as $menu_id => $jumlah) {
                if ($jumlah > 0) {
                    $menu = Menu::find($menu_id);
                    $transaksi->daftarMenu()->attach($menu_id, [
                        'harga' => $menu->harga,
                        'jumlah' => $jumlah
                    ]);
                    foreach ($menu->daftarBahan as $bahan) {
                        $bahan->stok -= $bahan->pivot->jumlah * $jumlah;
                    }
                    $menu->push();
                }
            }
            $transaksi->save();
            return redirect('/transaksi/'.$transaksi->id)->with('success', 'Transaksi terekam');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        return view('transaksi.show')->with('transaksi', $transaksi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
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
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        foreach ($transaksi->daftarMenu as $menu) {
            foreach ($menu->daftarBahan as $bahan) {
                $bahan->stok += $bahan->pivot->jumlah * $menu->pivot->jumlah;
            }
            $menu->push();
        }
        $transaksi->daftarMenu()->detach();
        $transaksi->delete();
        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
