<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['date_of_birth', 'gender', 'remaining_sessions', 'user_id'];

    protected $table = 'customers';

    public $timestamps = false;

}
