<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $fillable =  ['first_name','last_name','image','email','password'];

    protected $hidden =  ['password','created_at','updated_at'];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function favorite_products()
    {
        return $this->belongsToMany(Product::class, 'favorites')->using(Favorite::class)->where('isBought',0);
    }

    public function actions()
    {
        return $this->belongsToMany(Product::class,'actions')
        ->using(Action::class)
        ->withtimestamps()
        ->withpivot('price');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function product()
    {
        return $this->products()->one()->latestOfMany();
    }
}
