<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function chitietdonhang()
    {
        return $this->hasOne('App\Chitietdonhang');
    }
    public function shipping()
    {
        return $this->belongsTo('App\ShippingAddress', 'shipping_id');
    }
}
