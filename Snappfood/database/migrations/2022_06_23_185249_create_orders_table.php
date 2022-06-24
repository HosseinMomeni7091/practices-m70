<?php

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
            $table->integer("cost");
            $table->integer("quantity");
            $table->string("status");
            // $table->enum("status",array("progressing","preparating","Delivering","Delivered"));
            $table->foreignIdFor(User::class)->nullable();
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
