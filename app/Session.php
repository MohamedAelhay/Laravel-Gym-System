<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Session extends Model
{
    protected $fillable = ['name', 'starts_at', 'finishes_at', 'gym_id', 'session_date'];

    protected $table = 'sessions';

    public $timestamps = false;

    public function coach(){
        
        return $this->belongsToMany('App\Coach','sessions_coaches_history', 'session_id','coach_id');
    }
    public function gym(){
        return $this->belongsTo('App\Gym');
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
