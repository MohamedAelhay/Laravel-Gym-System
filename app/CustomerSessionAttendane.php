<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSessionAttendane extends Model
{
    protected $fillable = ['attendance_time', 'attendance_date', 'user_id', 'session_id'];

    protected $table = 'customer_sessions_attendance';

    public $timestamps = false;

    public $incrementing = true;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
