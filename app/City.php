<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'city_manager_id', 'country_id'];
    protected $table = 'cities';
}
