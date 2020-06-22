<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shipping_addresses';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
