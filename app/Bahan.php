<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';

    public function daftarMenu()
    {
        return $this->belongsToMany('App\Menu', 'pakai')->using('App\Pakai')->withPivot('jumlah');
    }

    public function daftarPembelian()
    {
        return $this->hasMany('App\Pembelian');
    }
}
