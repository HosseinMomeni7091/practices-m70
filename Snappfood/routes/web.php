<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\Auth\SellerController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\RestCategoryController;
use App\Http\Controllers\Auth\AuthFormController;
use App\Http\Controllers\TestNotificationController;


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
Route::any("/logout",[AuthController::class,"logout"])->name("logout");


Route::any("/loginform",[AuthFormController::class,"loginform"])->name("loginform");
Route::any("/registerform",[AuthFormController::class,"registerform"])->name("registerform");


Route::resource('restaurants', RestaurantController::class);
Route::resource('foods', FoodController::class);
Route::resource('restcategory', RestCategoryController::class);
Route::resource('foodcategory', FoodCategoryController::class);
Route::resource('discount', DiscountController::class);
// Route::resource('comments', CommentController::class);

// admincontroller - router
Route::get("/restaurantCategories",[AdminController::class,"restaurantCategories"])->name("restaurantCategories");
Route::get("/foodCategories",[AdminController::class,"foodCategories"])->name("foodCategories");
Route::get("/discounts",[AdminController::class,"discounts"])->name("discounts");
Route::get("/adminComments",[AdminController::class,"adminComments"])->name("adminComments");
Route::get("/actionOnComment",[AdminController::class,"actionOnComment"])->name("actionOnComment");
Route::get("/advertisements",[AdminController::class,"advertisements"])->name("advertisements");


// sellercontroller - router
Route::get("/currentOrders",[SellerController::class,"currentOrders"])->name("currentOrders");
Route::get("/detailCurrentOrders",[SellerController::class,"detailCurrentOrders"])->name("detailCurrentOrders");

Route::get("/comments",[SellerController::class,"comments"])->name("comments");
Route::post("/searchCommentOfFood",[SellerController::class,"searchCommentOfFood"])->name("searchCommentOfFood");
Route::get("/updateCommentStatus",[SellerController::class,"updateCommentStatus"])->name("updateCommentStatus");
Route::get("/sendCommentReply",[SellerController::class,"sendCommentReply"])->name("sendCommentReply");

Route::post("/filterOnReport",[SellerController::class,"filterOnReport"])->name("filterOnReport");

Route::get("/UpdateOrderStatus",[SellerController::class,"UpdateOrderStatus"])->name("UpdateOrderStatus");
Route::get("/completedOrders",[SellerController::class,"completedOrders"])->name("completedOrders");
Route::get("/sellReport",[SellerController::class,"sellReport"])->name("sellReport");
Route::get("/allfoods",[SellerController::class,"foods"])->name("allfoods");
Route::post("/allfoods",[SellerController::class,"foods"])->name("allfoods");
Route::post("/editefood",[SellerController::class,"editeFood"])->name("editefood");
Route::get("/createfood",[SellerController::class,"createfood"])->name("createfood");
Route::get("/sellerComments",[SellerController::class,"sellerComments"])->name("sellerComments");
Route::get("/foodParty",[SellerController::class,"foodParty"])->name("foodParty");
Route::get("/configuration",[SellerController::class,"configuration"])->name("configuration");
Route::get("/updateconfiguration",[SellerController::class,"updateconfiguration"])->name("updateconfige");



// emailtest
Route::get('/emailtest',[EmailController::class, 'SendEmail']);

// Notification Test
Route::get('/notficationtest',[TestNotificationController::class, 'SendNotification']);







