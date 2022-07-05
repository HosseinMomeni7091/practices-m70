<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'sat_start',
        'sat_end',
        'sun_start',
        'sun_end',
        'mon_start',
        'mon_end',
        'tues_start',
        'tues_end',
        'wednes_start',
        'wednes_end',
        'thurs_start',
        'thurs_end',
        'fri_start',
        'fri_end',
    ];
    public function restaurant() {
     return $this->hasOne(Restaurant::class);
    }
}
