<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Schedule;
use App\Models\RestAddress;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Database\Seeders\FoodSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ScheduleSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\RestAddressSeeder;
use Database\Seeders\UserAddressSeeder;
use Database\Seeders\FoodCategorySeeder;
use Database\Seeders\RestCategorySeeder;
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
            'role' => "admin",
            'email' => "hossein.momeni@yahoo.com",
            'password' => Hash::make("123")],
            
            ['name' => "hossein_seller",
            'phone' => "09193337477",
            'role' => "seller",
            'email' => "hossein.momeni7091@yahoo.com",
            'password' => Hash::make("123")],

            ['name' => "hossein_seller",
            'phone' => "09193337478",
            'role' => "seller",
            'email' => "hossein.momeni7092@yahoo.com",
            'password' => Hash::make("123")],

            ['name' => "hossein_seller",
            'phone' => "09133337478",
            'role' => "seller",
            'email' => "hossein.momeni7095@yahoo.com",
            'password' => Hash::make("123")],
            
            ['name' => "hossein",
            'phone' => "09193337479",
            'role' => "buyer",
            'email' => "hossein.momeni7093@yahoo.com",
            'password' => Hash::make("123")]
        ]);
        // User::factory(10)->create();

        $this->call([
            FoodCategorySeeder::class,
            RestCategorySeeder::class,
            UserAddressSeeder::class,
            RestAddressSeeder::class,
            CommentSeeder::class,
            FoodSeeder::class,
            OrderSeeder::class,
            RestaurantSeeder::class,
            ScheduleSeeder::class
        ]);
    }
}
