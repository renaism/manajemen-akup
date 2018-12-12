<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    public function daftarMenu()
    {
        return $this->belongsToMany('App\Menu', 'pesan')->using('App\Pesan')->withPivot('jumlah');
    }

    public function hargaTotal()
    {
        $harga_total = 0;
        foreach ($this->daftarMenu as $menu) {
            $harga_total += $menu->harga * $menu->pivot->jumlah;
        }
        return 0;
    }
}
