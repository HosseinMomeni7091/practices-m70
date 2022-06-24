<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\FoodSeeder;
use Database\Seeders\OrderSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RestaurantSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
       
            ['name' => "admin",
            'phone' => "09193337476",
            'address' => "semnan",
            'latitude' => "32",
            'longitude' =>"35",
            'role' => "admin",
            'email' => "hossein.momeni@yahoo.com",
            'password' => Hash::make("123")],
            
            ['name' => "hossein",
            'phone' => "09193337477",
            'address' => "semnan",
            'latitude' => "33",
            'longitude' =>"35",
            'role' => "seller",
            'email' => "hossein.momeni7091@yahoo.com",
            'password' => Hash::make("123"),]
        ]);
        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            CommentSeeder::class,
            FoodSeeder::class,
            OrderSeeder::class,
            RestaurantSeeder::class,
        ]);
    }
}
