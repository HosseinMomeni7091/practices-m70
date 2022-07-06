<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->insert([
       
            [
            "name"=> "Roastbeef",
            "raw"=> "Roast+Toast",
            "price"=> 140000,
            "score"=> 4.6,
            "discount"=> 0,
            "is_foodparty"=> false,
            "restaurant_id"=> "1",
            "food_category_id"=> "1",
            "image"=> "/storage/images/food.jpg",
            ],
            [
            "name"=> "Chicken",
            "raw"=> "Chicken+Toast",
            "price"=> 140000,
            "score"=> 4.6,
            "discount"=> 10,
            "is_foodparty"=> true,
            "restaurant_id"=> "1",
            "food_category_id"=> "1",
            "image"=> "/storage/images/food.jpg",

            ],
            [
            "name"=> "Roastbeef Pizza",
            "raw"=> "Roast+beard+Cheese",
            "price"=> 240000,
            "score"=> 3,
            "discount"=> 10,
            "is_foodparty"=> true,
            "restaurant_id"=> "1",
            "food_category_id"=> "2",
            "image"=> "/storage/images/food.jpg",

            ],
            [
            "name"=> "Kabab",
            "raw"=> "Grilled Roast",
            "price"=> 60000,
            "score"=> 5,
            "discount"=> 0,
            "is_foodparty"=> false,
            "restaurant_id"=> "1",
            "food_category_id"=> "3",
            "image"=> "/storage/images/food.jpg",

            ],
        ]);
    }
}
