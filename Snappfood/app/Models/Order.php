<?php

namespace App\Models;

use App\Models\Food;
use App\Models\User;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        "cost",
        "quantity",
        "status",
        "user_id",
        "restaurant_id",
        "discount_id",
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    // public function ifff()
    // {
    //     return $this->belongsTo(Restaurant::class)->where([["restaurant_id",$restId],["user_id",auth()->user()->id],["status","ordering"]]);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('foodorder','count')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
