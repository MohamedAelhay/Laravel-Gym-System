<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id','name', 'city_manager_id', 'country_id'];

    protected $table = 'cities';

    public $timestamps = false;

    public function cityManager(){

        return $this->hasOne(CityManager::class);

    }

    public function gyms(){

        return $this->hasMany(Gym::class);

    }

    public function country(){

        return $this->belongsTo(Country::class);

    }

}
