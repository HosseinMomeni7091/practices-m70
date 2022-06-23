<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        "comment",
        "reply",
        "is_accept",
        "deleted_request",
        "order_id",
        "buyer_id",
    ];

}
