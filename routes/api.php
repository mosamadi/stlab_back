<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\NotificationController as NotificationController;
use \App\Http\Controllers\Auth\OAuthController as OAuthController;
use \App\Http\Controllers\UserController as UserController;
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





Route::group(['prefix' => 'oauth'], static function () {
    Route::group(['prefix'=>'google'],static function(){
        Route::get('login',[OAuthController::class,'getGoogleOAuthLink']);
        Route::get('callback',[OAuthController::class,'googleCallback']);
    });
});


Route::middleware('auth:sanctum')->get('/notification/ss',[NotificationController::class ,'index'] );
Route::middleware('auth:sanctum')->post('/notification/ids',[NotificationController::class,'updateNotification']);

Route::group(['prefix'=>'user'],function (){
   Route::get('/activities',[UserController::class,'userMonthlyActivity']);
});
