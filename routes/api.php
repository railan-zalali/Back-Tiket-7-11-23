<?php

use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
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

// Route::post('/profile/update', [ApiLoginController::class, 'update'])->middleware(['auth', 'verified']);


// Route::middleware('auth:api')->group(function () {
//     Route::post('/profile/update', 'ApiLoginController@update');
// });



// Route::middleware('auth')->group(function () {
//     Route::post('/profile/update', [ApiLoginController::class, 'update']);
// });

Route::get('users', [UserController::class, 'index']);
Route::get('places', [TempatController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('addnew', [UserController::class, 'store']);
Route::put('usersupdate/{id}', [UserController::class, 'update']);
Route::delete('usersdelete/{id}', [UserController::class, 'destroy']);
Route::get('searchTiket', [TempatController::class, 'searchTiket']);
Route::get('ticketType', [TicketTypeController::class, 'index']);
