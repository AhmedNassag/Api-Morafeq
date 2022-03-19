<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = ['name','country_id'];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
