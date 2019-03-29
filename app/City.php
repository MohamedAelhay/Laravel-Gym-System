<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'city_manager_id', 'country_id'];

    protected $table = 'cities';

    public $timestamps = false;

    public function cityManager()
    {
<<<<<<< HEAD
        return $this->belongsTo(CityManager::class, 'city_manager_id');
=======

        // return $this->hasOne(CityManager::class);
        return $this->belongsTo('App\CityManager', 'city_manager_id');
>>>>>>> ab3da6292a25a7e334a6fa00340db260f55e7620
    }

    public function gyms()
    {
        return $this->hasMany(Gym::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
