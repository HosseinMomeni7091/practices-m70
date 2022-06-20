<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->insert(
            [
                [
                    "name"=>"Basic",
                    "time"=>"60",
                    "cost"=>"80000",
                ],
                [
                    "name"=>"Internal",
                    "time"=>"20",
                    "cost"=>"30000",
                ],
                [
                    "name"=>"External",
                    "time"=>"15",
                    "cost"=>"20000",
                ],
            ]);
    }
}
