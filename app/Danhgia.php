<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhgia extends Model
{
    protected $table = 'donhangs';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function dienthoai()
    {
        return $this->belongsTo('App\Dienthoai');
    }

}
