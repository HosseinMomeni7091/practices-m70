<?php

use App\Models\Discount;
use App\Models\Food;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("cost")->default("0");
            $table->integer("quantity")->nullable();
            $table->string("status")->default("ordering");
            // $table->enum("status",array("paid","progressing","preparing","Delivering","Delivered"));
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Discount::class)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
