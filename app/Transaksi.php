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
}
