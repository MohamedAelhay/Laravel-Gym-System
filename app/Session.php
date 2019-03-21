<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name', 'start_at', 'finishes_at', 'coach_id', 'gym_id', 'seassion_date'];

    protected $table = 'sessions';

    public $timestamps = false;

}
