<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerSessionAttendane extends Pivot
{
    protected $fillable = ['attendance_time', 'attendance_date', 'user_id', 'session_id'];

    protected $table = 'customer_sessions_attendance';

    public $timestamps = false;

    public $incrementing = true;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
