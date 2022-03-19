<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    protected $fillable = ['number','market_id'];


    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
