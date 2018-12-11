<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    public function bahan()
    {
        return $this->belongsTo('App\Bahan');
    }
}
