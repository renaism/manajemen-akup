<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';

    public function menu()
    {
        return $this->belongsToMany('App\Menu', 'pakai')->withPivot('jumlah');
    }
}
