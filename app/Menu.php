<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public function bahan()
    {
        return $this->belongsToMany('App\Bahan', 'pakai')->withPivot('jumlah');
    }
}
