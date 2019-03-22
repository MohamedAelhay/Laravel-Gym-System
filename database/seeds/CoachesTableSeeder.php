<?php

use Illuminate\Database\Seeder;
use App\Coach;

class CoachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coach = new Coach();
     
        $coach->name = 'asmaa';
        $coach->gym_id = 1;
        $coach->save();
        
    }
}
