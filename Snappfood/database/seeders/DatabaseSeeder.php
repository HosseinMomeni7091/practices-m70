<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => "admin",
            'phone' => "09193337476",
            'address' => "semnan",
            'latitude' => 32,
            'longitude' =>35,
            'role' => "admin",
            'email' => "hossein.momeni@yahoo.com",
            'password' => Hash::make("123"),
        ]);
    }
}
