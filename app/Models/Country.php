<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name'];


    public function region()
    {
        return $this->hasMany(Region::class);
    }

    public function market()
    {
        return $this->hasMany(Market::class);
    }
}
