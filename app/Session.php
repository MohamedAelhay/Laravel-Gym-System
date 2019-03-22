<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name', 'start_at', 'finishes_at', 'coach_id', 'gym_id', 'seassion_date'];

    protected $table = 'sessions';

    public $timestamps = false;

    public function gym(){

        return $this->belongsTo(Gym::class);

    }


    public function users(){

        return $this->belongsToMany(User::class)
            ->using(CustomerSessionAttendane::class)
            ->withPivot([
                'attendance_time', 'attendance_date',
                'user_id', 'session_id'
            ]);

    }

}
