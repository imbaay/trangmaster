<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    public function donhang()
    {
        return $this->belongsTo('App\Donhang');
    }
}
