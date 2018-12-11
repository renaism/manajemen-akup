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
}
