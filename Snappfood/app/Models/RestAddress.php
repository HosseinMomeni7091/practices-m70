<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'latitude',
        'longitude',
    ];

    public function restaurant() {
        return $this->hasOne(Restaurant::class);
    }
}
