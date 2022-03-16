<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];



    public function subCategory()
    {
        return $this->hasMany(Sub_category::class);
    }
}
