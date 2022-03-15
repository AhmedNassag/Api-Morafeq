<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['id','name','image','products','phones','workingTime','country','region','category','rate'];
}
