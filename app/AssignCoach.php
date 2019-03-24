<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignCoach extends Model
{
    protected $fillable = ['session_id','coach_id'];

    protected $table = 'sessions_coaches_history';
    public $timestamps = false;



}
