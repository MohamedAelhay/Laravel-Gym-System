<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    protected $fillable = ['national_id'];
    protected $table = 'city_managers';

    public $timestamps = false;

    public function city()
    {
        return $this->hasOne(City::class, 'city_manager_id');
    }

    public function user()
    {
        return $this->morphMany(User::class, 'role');
    }
}
