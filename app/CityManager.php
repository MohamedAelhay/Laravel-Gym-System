<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    protected $fillable = ['national_id', 'user_id'];
    protected $primaryKey = 'national_id';
    protected $table = 'city_managers';
 
    public $timestamps = false;

    public function city(){

        return $this->belongsTo(City::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
