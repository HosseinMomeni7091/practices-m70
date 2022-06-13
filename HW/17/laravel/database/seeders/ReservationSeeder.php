<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert(
            [
                [
                    "user_id"=>1,
                    "day"=> "saturday",
                    "service"=>"External",
                    "time"=>"9:30--9:45",
                    "cost"=>"25000",
                    "code"=>"aaaaaaaa"
                ],
                [
                    "user_id"=>2,
                    "day"=> "saturday",
                    "service"=>"Internal",
                    "time"=>"9:30--9:50",
                    "cost"=>"30000",
                    "code"=>"bbbbbbbb"
                ],
                [
                    "user_id"=>3,
                    "day"=> "saturday",
                    "service"=>"Basic",
                    "time"=>"10:30--11:30",
                    "cost"=>"80000",
                    "code"=>"cccccccc"
                ],
                [
                    "user_id"=>1,
                    "day"=> "tuesday",
                    "service"=>"Basic",
                    "time"=>"10:30--11:30",
                    "cost"=>"80000",
                    "code"=>"dddddddd"
                ]
            ]
            );
    }
}
