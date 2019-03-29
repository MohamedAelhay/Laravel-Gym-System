<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'city_manager_id', 'country_id'];

    protected $table = 'cities';

    public $timestamps = false;

<<<<<<< HEAD
    public function cityManager(){

        // return $this->hasOne(CityManager::class);
        return $this->belongsTo('App\CityManager','city_manager_id');
=======
    public function cityManager()
    {
        return $this->belongsTo(CityManager::class, 'city_manager_id');
>>>>>>> 6e2060c910857d34c929d739df1b6b1f5ba0d367
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
