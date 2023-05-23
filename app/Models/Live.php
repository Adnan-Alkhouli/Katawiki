<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable =  ['view','like','hidden'];

    protected $hidden =  ['product_id','view','like','hidden','created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class)->where('isBought',0);
    }

}
