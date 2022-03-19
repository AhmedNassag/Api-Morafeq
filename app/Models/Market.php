<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $table = 'markets';
    protected $fillable = ['name','image','address','location','workingTime','rate','favourite','sub_sub_category_id','country_id'];


    public function subsubcategory()
    {
        return $this->belongsTo(Sub_sub_category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function phone()
    {
        return $this->hasMany(Phone::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class,'market_product');
    }
}
