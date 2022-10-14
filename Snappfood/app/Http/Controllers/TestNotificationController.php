<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Notification;

class TestNotificationController extends Controller
{
    public function SendNotification(){
        $targetuser = User::find(1);
        // first approach
        // $targetuser->notify(New TestNotification($targetuser));

        // second approach
        Notification::send($targetuser,New TestNotification($targetuser));



    }
}
