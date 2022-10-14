<?php

namespace App\Http\Controllers;

use App\Jobs\buyerjob;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function SendEmail(){
        dispatch(new buyerjob())->delay(now()->addMinutes(1));
        dd("Email has been sent");
    }
}
