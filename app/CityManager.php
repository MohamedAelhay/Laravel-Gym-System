<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    protected $fillable = ['national_id', 'id'];
        protected $table = 'city_managers';
 
    public $timestamps = false;

    public function city(){

        return $this->belongsTo(City::class);

    }

    public function user()
    {
        return $this->morphMany(User::class,'role');
    }


}
