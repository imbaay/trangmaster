<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dienthoai extends Model
{
    use SoftDeletes;
    protected $table = 'dienthoais';
    /*
     * RELATIONS
     */
    public function noisanxuat()
    {
        return $this->belongsTo(Noisanxuat::class);
    }
    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class);
    }
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
    public function danhgia()
    {
        return $this->hasMany('App\Danhgia');
    }


    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /*
     * Scope for search books
     */
    public function scopeSearch($query, $term)
    {
        if($term)
        {
            $query->where(function ($q) use ($term){
                $q->where('title', 'LIKE', "%{$term}%");

                $q->orwhereHas('noisanxuat', function ($qr) use ($term){
                    $qr->where('name', 'LIKE', "%{$term}%");
                });
            });
        }
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
