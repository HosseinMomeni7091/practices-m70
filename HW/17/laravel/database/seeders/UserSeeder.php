<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    "name"=>"Mohammad",
                    "phone"=> "09123337476"
                ],
                [
                    "name"=>"Ali",
                    "phone"=> "09133337476"
                ],
                [
                    "name"=>"Hassan",
                    "phone"=> "09143337476"
                ],
                [
                    "name"=>"Hossein",
                    "phone"=> "09193337476"
                ],
            ]
            );
    }
}
