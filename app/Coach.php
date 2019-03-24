<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ['name', 'gym_id'];

    protected $table = 'coaches';

    public $timestamps = false;

    public function session(){
        
        return $this->belongsToMany('App\Session');
    }
    public function gym(){
        return $this->belongsTo('App\Gym');
    }

}
