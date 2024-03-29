<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiOrderController;
use App\Http\Controllers\API\ApiAddressController;
use App\Http\Controllers\API\ApiCommentController;
use App\Http\Controllers\API\ApiRestaurantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [APiAuthController::class, 'login']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/addresses', [ApiAddressController::class, 'index']);
    Route::post('/addresses', [ApiAddressController::class, 'store']);
    Route::post('/addresses/{address_id}', [ApiAddressController::class, 'currentAddress']);

    Route::get('/restaurants/{restaurant_id}', [ApiRestaurantController::class, 'index']);
    Route::get('/restaurants', [ApiRestaurantController::class, 'show']);
    Route::get('/restaurants/{restaurant_id}/foods', [ApiRestaurantController::class, 'showFood']);

    
    Route::post('/carts/add', [ApiOrderController::class, 'addtocart']);
    Route::patch('/carts/add', [ApiOrderController::class, 'update']);
    Route::post('/carts/{cart_id}/pay', [ApiOrderController::class, 'pay'])->whereNumber("cart_id");
    Route::get('/carts/{cart_id}', [ApiOrderController::class, 'show'])->whereNumber("cart_id");
    Route::get('/carts', [ApiOrderController::class, 'index']);
    
    
    Route::get('/comments', [ApiCommentController::class, 'show']);
    Route::post('/comments', [ApiCommentController::class, 'store']);

    Route::post('/logout', [ApiAuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
