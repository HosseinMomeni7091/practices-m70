<?php

use App\Models\Category;
use App\Models\Order;
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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("raw");
            $table->string("image")->nullable();
            $table->integer("price");
            $table->integer("discount");
            $table->boolean("is_foodparty")->default("false");
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(Category::class)->constrained();
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
        Schema::dropIfExists('food');
    }
};
