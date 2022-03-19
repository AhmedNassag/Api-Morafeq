<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','price','status','rate'];


    public function market()
    {
        return $this->hasMany(Market::class,'market_product');
    }
}
