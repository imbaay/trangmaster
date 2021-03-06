<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    protected $guarded = [];

    public function dienthoai()
    {
        return $this->hasMany('App\Dienthoai');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
