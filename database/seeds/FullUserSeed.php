<?php

use App\User;
use Illuminate\Database\Seeder;
use App\City;
use App\CityManager;

class FullUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cityManager = new User();
        $cityManager->name = 'Amira';
        $cityManager->email = 'city4@iti.com';
        $cityManager->password = bcrypt('city');
        $cityManager->assignRole('city-manager');
        $cityManager->role_type = 'App\CityManager';
        $cityManager->role_id = 4;
        $cityManager->save();

        CityManager::create(['national_id'=>'5984643','user_id'=>6]);

        
    }
}
