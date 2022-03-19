<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_sub_category extends Model
{
    protected $table = 'sub_sub_categories';
    protected $fillable = [''];


    public function subcategory()
    {
        return $this->belongsTo(Sub_category::class);
    }

    public function market()
    {
        return $this->hasMany(Market::class);
    }
}
