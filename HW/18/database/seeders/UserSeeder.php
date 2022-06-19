<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                    "family"=>"Mohammadi",
                    "email"=>"test1@test.com",
                    "phone"=> "09123337476",
                    "password"=> Hash::make("123"),
                    "is_admin"=> 0,
                ],
                [
                    "name"=>"Ali",
                    "family"=>"Alii",
                    "email"=>"test2@test.com",
                    "phone"=> "09123337477",
                    "password"=> Hash::make("123"),
                    "is_admin"=> 0,

                ],
                [
                    "name"=>"Hassan",
                    "family"=>"Hassani",
                    "email"=>"test3@test.com",
                    "phone"=> "09123337478",
                    "password"=> Hash::make("123"),
                    "is_admin"=> 0,
                    
                ],
                [
                    "name"=>"Hossein",
                    "family"=>"Hosseini",
                    "email"=>"test4@test.com",
                    "phone"=> "09123337479",
                    "password"=> Hash::make("123"),
                    "is_admin"=> 0,
                ],
                [
                    "name"=>"admin",
                    "family"=>"admin",
                    "email"=>"admin@admin.com",
                    "phone"=> "09999999999",
                    "password"=> Hash::make("admin"),
                    "is_admin"=> 1,
                ],
            ]
            );
    }
}
