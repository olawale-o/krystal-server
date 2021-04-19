<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('gigs')->group(function() {
    Route::get('/all', [GigController::class,'allGigs']);
    Route::get('/rejected', [GigController::class,'rejectedGigs']);
    Route::get('/{id}', [GigController::class,'gigs']);
    Route::delete('/delete/{id}', [GigController::class,'delete']);
});
Route::post('new-gig', [GigController::class,'create']);
Route::post('create', [RegisterController::class,'create']);
Route::post('login', [LoginController::class,'login']);