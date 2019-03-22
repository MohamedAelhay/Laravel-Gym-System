<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $timestamps = false;

    public function user(){

        return $this->belongsToMany(User::class);
    }

}
