<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
       
            [
            "sat_start"=> "9:00",
            "sat_end"=> "22:00",
            "sun_start"=> "9:00",
            "sun_end"=> "22:00",
            "mon_start"=> "9:00",
            "mon_end"=> "22:00",
            "tues_start"=> "9:00",
            "tues_end"=> "22:00",
            "wednes_start"=> "9:00",
            "wednes_end"=> "22:00",
            "thurs_start"=> "9:00",
            "thurs_end"=> "22:00",
            "fri_start"=> "9:00",
            "fri_end"=> "22:00",
            ],
            [
            "sat_start"=> "10:00",
            "sat_end"=> "22:00",
            "sun_start"=> "10:00",
            "sun_end"=> "22:00",
            "mon_start"=> "10:00",
            "mon_end"=> "22:00",
            "tues_start"=> "10:00",
            "tues_end"=> "22:00",
            "wednes_start"=> "10:00",
            "wednes_end"=> "22:00",
            "thurs_start"=> "10:00",
            "thurs_end"=> "22:00",
            "fri_start"=> "10:00",
            "fri_end"=> "22:00",
            ],
            [
            "sat_start"=> "12:00",
            "sat_end"=> "22:00",
            "sun_start"=> "12:00",
            "sun_end"=> "22:00",
            "mon_start"=> "12:00",
            "mon_end"=> "22:00",
            "tues_start"=> "12:00",
            "tues_end"=> "22:00",
            "wednes_start"=> "12:00",
            "wednes_end"=> "22:00",
            "thurs_start"=> "12:00",
            "thurs_end"=> "22:00",
            "fri_start"=> "12:00",
            "fri_end"=> "22:00",
            ],
        ]);
    }
}
