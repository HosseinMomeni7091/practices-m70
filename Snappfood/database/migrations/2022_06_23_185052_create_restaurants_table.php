<?php

use App\Models\Food;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\RestAddress;
use App\Models\RestCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->foreignIdFor(RestAddress::class)->nullable();
            $table->integer("freight");
            $table->integer("score")->default(5);
            $table->foreignIdFor(Schedule::class)->nullable();
            $table->string("bank_account");
            $table->string("picture")->nullable();
            $table->boolean("is_active")->default(true);
            $table->foreignIdFor(RestCategory::class)->nullable();
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
        Schema::dropIfExists('restaurants');
    }
};
