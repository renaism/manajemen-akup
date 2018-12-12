<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public function daftarBahan()
    {
        return $this->belongsToMany('App\Bahan', 'pakai')->using('App\Pakai')->withPivot('jumlah');
    }

    public function daftarTransaksi()
    {
        return $this->belongsToMany('App\Transaksi', 'pesan')->using('App\Pesan')->withPivot('jumlah');
    }
}
