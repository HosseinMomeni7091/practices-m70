<?php

use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [usercontroller::class,"home"]);

Route::get('/track', function () {
    return view('track');
});
Route::post('/track', function () {
    return view('track');
});

// Route::get('/', function () {
//     return view('confirmation');
// });
Route::post('/reservation2', [usercontroller::class,"type"]);

Route::get('/reservation2/Automatic', [usercontroller::class,"automaticReserve"])->name("AutomaticReservation");

// Route::get('/reservation2/Automatic/autotoConfirmation', [usercontroller::class,"autotoConfirmation"])->name("autotoConfirmation");

Route::get('/reservation2/Manual', [usercontroller::class,"manualReserve"])->name("ManualReservation");

Route::post('/reservation2/Manual/pre_proccess', [usercontroller::class,"preProccess"])->name("pre_proccess");
Route::post('/reservation2/Manual/pre_proccess/confirmed', [usercontroller::class,"confirmedTime"])->name("confirmedTime");
Route::get('/reservation2/Auto/pre_proccess/confirmed', [usercontroller::class,"confirmedTime"])->name("confirmedTime");
Route::get('/reservation2/Manual/pre_proccess/confirmed', [usercontroller::class,"confirmedTime"])->name("confirmedTime");

Route::post('/searchtracknumber', [usercontroller::class,"searchtracknumber"]);
Route::post('/cancel', [usercontroller::class,"cancel"]);
Route::post('/edite', [usercontroller::class,"edite"]);
