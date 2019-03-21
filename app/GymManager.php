<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymManager extends Model
{
    protected $fillable = ['national_id', 'user_id', 'banned_at'];

    protected $table = 'gym_managers';

    public $timestamps = false;

}
