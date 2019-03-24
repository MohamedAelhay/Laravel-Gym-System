<?php

namespace App;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Model;

class GymManager extends Model
{
    protected $fillable = ['national_id', 'user_id', 'banned_at'];

    protected $table = 'gym_managers';

    public $timestamps = false;

    public function user()
    {
        return $this->morphOne(User::class,'role');
    }

    public function gym(){

        return $this->belongsTo(Gym::class);
    }


}
