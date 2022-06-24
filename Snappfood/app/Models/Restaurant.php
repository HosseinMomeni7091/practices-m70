<?php

namespace App\Models;

use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phone",
        "address",
        "latitude",
        "longitude",
        "freight",
        "working_hour",
        "bank_account",
        "picture",
        "is_active",
        "food_id",
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
