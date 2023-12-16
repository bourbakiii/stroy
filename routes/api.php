<?php

use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WorkersController;
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

Route::prefix('auth')->middleware('api')->controller(UsersController::class)->group(function () {
    Route::post('signup', 'create');
    Route::post('signin', 'login');
    Route::post('refresh', 'refresh');
//    Route::post('send-reset-code', 'sendResetCode');
//    Route::post('reset-password', 'resetPassword');
});


Route::prefix('builidings')->middleware('api')->controller(BuildingsController::class)->group(function () {
    Route::post('/', 'create');
//    Route::post('signin', 'login');
//    Route::post('refresh', 'refresh');
//    Route::post('send-reset-code', 'sendResetCode');
//    Route::post('reset-password', 'resetPassword');
});

Route::prefix('workers')->middleware('api')->controller(WorkersController::class)->group(function () {
    Route::post('/', 'create');
});
