<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu';
    protected $dates = ['deleted_at'];

    public function daftarBahan()
    {
        return $this->belongsToMany('App\Bahan', 'pakai')->using('App\Pakai')->withPivot('jumlah');
    }

    public function daftarTransaksi()
    {
        return $this->belongsToMany('App\Transaksi', 'pesan')->using('App\Pesan')->withPivot('harga', 'jumlah');
    }
}
