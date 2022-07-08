<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
       
            [
            "name"=>"Eid",
            "discount"=>10,
            ],
            [
            "name"=>"CharshanbeSouri",
            "discount"=>30,
            ],
            [
            "name"=>"Ramadan",
            "discount"=>99,
            ],
           
        ]);
    }
}
