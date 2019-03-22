<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymPackage extends Model
{
    protected $fillable = ['name', 'price', 'number_of_sessions', 'gym_id'];

    protected $table = 'gym_packages';

    public $timestamps = false;

    public function gym(){

        return $this->belongsTo(Gym::class);

    }

    public function users(){

        return $this->belongsToMany(User::class)
            ->using(GymPackagePurchaseHistory::class)
            ->withPivot([
                'package_name', 'package_price','purchase_date'
                ,'user_id', 'gym_id'
            ]);

    }

}
