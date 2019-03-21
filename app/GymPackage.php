<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymPackage extends Model
{
    protected $fillable = ['name', 'price', 'number_of_sessions', 'gym_id'];
    protected $table = 'gym_packages';
}
