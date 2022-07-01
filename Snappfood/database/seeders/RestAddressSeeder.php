<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rest_addresses')->insert([
       
            [
            "address"=> "Tehran, Tehran, St. Africa",
            "latitude"=> 35.715298,
            "longitude"=> 51.404343,
            ],

            [
            "address"=> "Esfahan, Esfahan, St. Tarasht",
            "latitude"=> 35.715315,
            "longitude"=> 51.404398,
            ],

            [
            "address"=> "Mashahd, Mashahd, St. Tarasht",
            "latitude"=> 35.715315,
            "longitude"=> 51.404398,
            ],
        ]);
    }
}
