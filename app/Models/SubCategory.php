<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable =  ['name'];

    protected $hidden =  ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('isBought',0);
    }

    public function productsOfHome()
    {
        return $this->products()->one()->ofMany('price','max');
    }
}

