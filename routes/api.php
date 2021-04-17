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

Route::post('new-gig', [GigController::class,'create']);
Route::get('all-gigs', [GigController::class,'allGigs']);
Route::get('rejected-gigs', [GigController::class,'rejectedGigs']);
Route::get('my-gigs/{id}', [GigController::class,'gigs']);
Route::post('create', [RegisterController::class,'create']);
Route::post('login', [LoginController::class,'login']);