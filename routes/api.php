<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('/check-availability', [ReservationController::class, 'checkAvailability']);
Route::post('/reserve-table', [ReservationController::class, 'reserveTable']);
Route::get('/list-menu-items', [MenuController::class, 'listMenuItems']);
Route::post('/place-order', [OrderController::class, 'placeOrder'])->middleware('auth:sanctum');
Route::post('/pay/{orderId}', [PaymentController::class, 'pay'])->middleware('auth:sanctum');
