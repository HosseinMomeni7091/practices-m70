<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_categories')->insert([
       
            [
            "name"=>"sandwich"
            ],
            [
            "name"=>"Pizza"
            ],
            [
            "name"=>"kabab"
            ],

        ]);
    }
}
