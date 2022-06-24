<?php

use App\Models\Category;
use App\Models\Food;
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
            $table->string("address");
            $table->string("latitude");
            $table->string("longitude");
            $table->integer("freight");
            $table->string("working_hour");
            $table->string("bank_account");
            $table->string("picture")->nullable();
            $table->boolean("is_active")->default(true);
            $table->foreignIdFor(Food::class)->nullable();
            $table->foreignIdFor(Category::class)->nullable();
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
