<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cityManager = new User();
        $cityManager->name = 'Ahmed';
        $cityManager->email = 'city@iti.com';
        $cityManager->password = bcrypt('city');
        $cityManager->save();
        $cityManager->assignRole('city-manager');

        $cityManager = new User();
        $cityManager->name = 'Mansy';
        $cityManager->email = 'city1@iti.com';
        $cityManager->password = bcrypt('city');
        $cityManager->save();
        $cityManager->assignRole('city-manager');

        $cityManager = new User();
        $cityManager->name = 'Ziad';
        $cityManager->email = 'city2@iti.com';
        $cityManager->password = bcrypt('city');
        $cityManager->save();
        $cityManager->assignRole('city-manager');
//        $cityManager->ban();
//        $cityManager->ban([
//            'comment' => 'Enjoy your ban!',
//        ]);
        $gymManager = new User();
        $gymManager->name = 'Shaf3y';
        $gymManager->email = 'gym@iti.com';
        $gymManager->password = bcrypt('gym');
        $gymManager->save();
        $gymManager->assignRole('gym-manager');
//        $gymManager->ban();
//        $gymManager->ban([
//            'comment' => 'Enjoy your ban!',
//        ]);
        $admin = new User();
        $admin->name = 'AbdElHay';
        $admin->email = 'admin@iti.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->assignRole('super-admin');
    }
}
