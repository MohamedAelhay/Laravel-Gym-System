<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = ['name', 'created_at', 'img', 'creator_name', 'city_id'];

    protected $table = 'gyms';


    public function city(){

        return $this->belongsTo(City::class);
    }

    public function packages(){ 

        return $this->hasMany(GymPackage::class);
    }

    public function coaches(){

        return $this->hasMany(Coach::class);

    }

    public function sessions(){

        return $this->hasMany(Session::class);

    }

    public function customers(){

        return $this->hasMany(Customer::class);

    }

    public function gymManager(){

        return $this->hasMany(GymManager::class);

    }

}
