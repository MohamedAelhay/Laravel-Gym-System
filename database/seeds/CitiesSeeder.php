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

        CityManager::create(['national_id'=>'687426582','user_id'=>1]);
        City::create(['city_manager_id'=>'1','country_id'=>'51','name'=>'Alex']);


        CityManager::create(['national_id'=>'687426582','user_id'=>2]);
        City::create(['city_manager_id'=>'2','country_id'=>'48','name'=>'Cairo']);


        CityManager::create(['national_id'=>'9854210','user_id'=>3]);
        City::create(['city_manager_id'=>'3','country_id'=>'10','name'=>'London']);
    }
}
