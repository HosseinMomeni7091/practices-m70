<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_addresses')->insert([
       
            ["title"=> "Home",
            "address"=> "Tehran, Tehran, St. Africa",
            "latitude"=> 35.715298,
            "longitude"=> 51.404343,
            "user_id"=> 4],

            ["title"=> "Campany",
            "address"=> "Tehran, Tehran, St. Tarasht",
            "latitude"=> 35.715315,
            "longitude"=> 51.404398,
            "user_id"=> 4],

            ["title"=> "Campany",
            "address"=> "Tehran, Tehran, St. Tarasht",
            "latitude"=> 35.715315,
            "longitude"=> 51.404398,
            "user_id"=> 2],
        ]);
    }
}
