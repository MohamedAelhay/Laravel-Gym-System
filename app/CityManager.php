<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    protected $fillable = ['national_id', 'user_id'];

    protected $table = 'city_managers';

    public $timestamps = false;
}
