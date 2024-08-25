<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);


Route::middleware(['auth:api'])->group(function(){

    //logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //products
    Route::controller(ProductsController::class)->prefix('products')->group(function(){
        Route::get('/', 'index' );
        Route::post('/store', 'store' );
    });

     //users
     Route::controller(UserController::class)->prefix('users')->group(function(){
        Route::get('/', 'index' );
        Route::post('/store', 'store' );
    });

});
