<?php

use Illuminate\Database\Seeder;
use App\Gym;
class GymsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gym::create(['name'=>'gold\'s gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
        Gym::create(['name'=>'A gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
        Gym::create(['name'=>'B gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
        Gym::create(['name'=>'C gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
        Gym::create(['name'=>'D gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
        Gym::create(['name'=>'E gym','created_at'=>'2019-3-2'
            ,'img'=>'c/imgs/1','creator_name'=>'Ahmed','city_id'=>'1']);
    }
}
