<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;
     protected $fillable=[
        "name",
        "raw",
        "price",
        "image",
        "discount",
        "is_foodparty",
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
