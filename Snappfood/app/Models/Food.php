<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "category_id",
    ];
}
