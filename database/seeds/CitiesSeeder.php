<?php

use Illuminate\Database\Seeder;
use App\City;
use App\CityManager;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CityManager::create(['national_id'=>'12345678','user_id'=>1]);
        City::create(['city_manager_id'=>'1','country_id'=>'4','name'=>'Alex']);
    }
}
