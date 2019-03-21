<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymPackagePurchaseHistory extends Model
{
    protected $fillable = ['package_name', 'package_price','purchase_date','user_id', 'gym_id'];
    protected $table = 'gym_packages_purchase_history';
}
