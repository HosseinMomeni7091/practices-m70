<?php

namespace App\Models;

use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\RestAddress;
use App\Models\RestCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phone",
        "rest_address_id",
        "rest_category_id",
        "freight",
        "score",
        "schedule_id",
        "bank_account",
        "picture",
        "is_active",
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
    public function restcategory()
    {
        return $this->belongsTo(RestCategory::class);
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
    public function restaddress()
    {
        return $this->hasOne(RestAddress::class);
    }
}
