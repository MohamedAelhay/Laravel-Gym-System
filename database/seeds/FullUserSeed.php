<?php

use App\User;
use Illuminate\Database\Seeder;
use App\City;
use App\CityManager;
use App\GymManager;

class FullUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GymManager::create(['national_id'=>'865742','gym_id'=>'9']);

        $gymManager = new User();
        $gymManager->name = 'Nagato';
        $gymManager->email = 'gym3@iti.com';
        $gymManager->password = bcrypt('gym');
        $gymManager->assignRole('gym-manager');
        $gymManager->role_type = 'App\GymManager';
        $gymManager->role_id = 3;
        $gymManager->save();



        
    }
}
