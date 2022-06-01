<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{title}/{id}/{cat}', function ($title, $id, $cat) {

    compact("title","id","cat");
    return view("content",compact("title","id","cat"));

    // return redirect("/$cat/index.blade.php");


})->whereNumber('id')->whereAlpha('title')->whereIn('cat', ['sport', 'economy', 'values']);

// /Allah/100/sport


// Route::get('/{cat}/index.blade.php', function ($title, $id, $cat) {
//     return view('test',compact("title","id","cat"));
// })->name('profile');
 