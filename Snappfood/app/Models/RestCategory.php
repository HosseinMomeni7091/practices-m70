<?php

namespace App\Models;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestCategory extends Model
{
    use HasFactory;
    protected $fillable = ["name"];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
 
}
