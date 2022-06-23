<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        "cost",
        "quantity",
        "status",
        "buyer_id",
        "restaurant_id",
        "food_id",
    ];
}
