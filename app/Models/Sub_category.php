<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = ['name','category_id'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subsubCategory()
    {
        return $this->hasMany(Sub_sub_category::class);
    }
}
