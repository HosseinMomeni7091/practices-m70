<?php

use App\Models\Order;
use App\Models\FoodCategory;
use App\Models\Restaurant;
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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("raw");
            $table->string("image")->nullable();
            $table->integer("price");
            $table->integer("score")->default(5);
            $table->integer("discount")->default(0);
            $table->boolean("is_foodparty")->default(false);
            $table->foreignIdFor(FoodCategory::class)->nullable();
            $table->foreignIdFor(Restaurant::class)->nullable();
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
        Schema::dropIfExists('foods');
    }
};
