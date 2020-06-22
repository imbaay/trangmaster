<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noisanxuat extends Model
{
    protected $table = 'noisanxuats';

    public function dienthoai()
    {
        return $this->hasMany('App\Dienthoai');
    }
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * Image Accessor
     */
    public function getImageUrlAttribute($value)
    {
        return asset('/').'assets/img/'.$this->image->file;
    }
    public function getDefaultImgAttribute($value)
    {
        return asset('/').'assets/img/'.'user-placeholder.png';
    }
}
