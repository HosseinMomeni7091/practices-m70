<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("home");


Route::any("/login",[AuthController::class,"login"])->name("login");
Route::any("/register",[AuthController::class,"register"])->name("register");


Route::any("/loginform",[AuthFormController::class,"loginform"])->name("loginform");
Route::any("/registerform",[AuthFormController::class,"registerform"])->name("registerform");
