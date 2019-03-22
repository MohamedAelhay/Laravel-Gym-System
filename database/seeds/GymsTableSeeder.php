<?php

use Illuminate\Database\Seeder;

class GymsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gym = new Gym();
        $gym->name = 'Golden Gym';
        $gym->created_at = '25/7/1994';
        $gym->img = nullValue();
        $gym->creator_name = 'hesham';
        $gym->city_id =
        $gym->save();
        $gym->assignRole('city-manager');
    }
}
