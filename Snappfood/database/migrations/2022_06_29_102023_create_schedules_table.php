<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string("sat_start");
            $table->string("sat_end");

            $table->string("sun_start");
            $table->string("sun_end");

            $table->string("mon_start");
            $table->string("mon_end");

            $table->string("tues_start");
            $table->string("tues_end");

            $table->string("wednes_start");
            $table->string("wednes_end");

            $table->string("thurs_start");
            $table->string("thurs_end");

            $table->string("fri_start");
            $table->string("fri_end");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
