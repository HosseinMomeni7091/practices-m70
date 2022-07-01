<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Restaurant::factory()
        //     ->count(5)
        //     ->create();

        DB::table('restaurants')->insert([
       
            [
            "name"=> "darchin",
            "phone"=> "02333454287",
            "freight"=> 30000,
            "score"=> 5,
            "bank_account"=> "IR0696000000010324200001",
            "rest_address_id"=> 1,
            "rest_category_id"=> 1,
            "schedule_id"=> 1,
            ],
            [
            "name"=> "Badgir",
            "phone"=> "02333454289",
            "freight"=> 40000,
            "score"=> 3,
            "bank_account"=> "IR0696000000010324200001",
            "rest_address_id"=> 2,
            "rest_category_id"=> 1,
            "schedule_id"=> 2,
            ],
            [
            "name"=> "Haj Rahim",
            "phone"=> "02333454284",
            "freight"=> 20000,
            "score"=> 1,
            "bank_account"=> "IR0696000000010324200001",
            "rest_address_id"=> 3,
            "rest_category_id"=> 2,
            "schedule_id"=> 3,
            ],
        ]);
    }
}
