<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable=[
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
        "category_id",
    ];
}
