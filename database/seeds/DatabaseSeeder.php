<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //     $this->call(UsersTableSeeder::class);
         $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');
         $this->call(RolesAndPermissionsSeeder::class);
        
        $this->call(UsersSeeder::class);

        $this->call(CitiesSeeder::class);

        $this->call(GymsSeeder::class);
        $this->call(CoachesTableSeeder::class);
        $this->call(FullUserSeed::class);

    }
}
