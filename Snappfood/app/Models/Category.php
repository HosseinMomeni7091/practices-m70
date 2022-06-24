<?php

namespace App\Models;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["name", "type"];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
