<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = ['name', 'created_at', 'img', 'creator_name', 'city_id'];

    protected $table = 'gyms';

    public $timestamps = false;

    public function package(){

        return $this->hasMany(GymPackage::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
