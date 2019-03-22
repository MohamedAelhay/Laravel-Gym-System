<?php

use Illuminate\Database\Seeder;
use App\Gym;
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
        $gym->created_at = '2009-10-14 19:00:00';
        $gym->img = 'img';
        $gym->creator_name = 'hesham';
        $gym->city_id = 2;
        $gym->save();
    
    }
}
