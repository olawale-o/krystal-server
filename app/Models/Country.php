<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }
}
