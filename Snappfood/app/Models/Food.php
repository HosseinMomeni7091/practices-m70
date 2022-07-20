<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\FoodCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
    protected $table="foods";
     protected $fillable=[
        "name",
        "raw",
        "price",
        "image",
        "score",
        "discount",
        "restaurant_id",
        "food_category_id",
        "is_foodparty",
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class,"food_order","food_id","order_id")->withPivot('count')->withTimestamps();
    }
    public function foodcategory()
    {
        return $this->belongsTo(FoodCategory::class);
    }
}
