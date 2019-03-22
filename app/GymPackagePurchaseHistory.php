<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GymPackagePurchaseHistory extends Pivot
{
    protected $fillable = ['package_name', 'package_price','purchase_date','user_id', 'gym_id'];

    protected $table = 'gym_packages_purchase_history';

    public $timestamps = false;

    public $incrementing = true;

}