<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
        'is_current',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
