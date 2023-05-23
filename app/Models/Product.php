<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =  ['sub_category_id','name','description','price','days','hours','minutes'];

    protected $hidden =  ['created_at','updated_at','days','hours','minutes','pivot'];

    public function live()
    {
        return $this->hasOne(Live::class);
    }

    public function seller()
    {
        return $this->belongsTo(Product::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites')
        ->using(Favorite::class);
    }

    public function buyers()
    {
        return $this->belongsToMany(User::class,'actions')
        ->using(Action::class)->orderByPivot('price','desc')
        ->withtimestamps()
        ->withpivot('price');
    }

}
