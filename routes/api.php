<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\newForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::controller(AuthController::class)->group(function(){
    Route::post('register','Addregister');
    Route::post('login','login');
    Route::post('logout','logout')->middleware('auth:sanctum');
    Route::post('verify','verifiedOtp');
    Route::post('resend','resendOtp');
    Route::post('forgotPassword', 'forgotPassword');
    Route::post('resetpassword', 'resetpassword');
    //Route::post('reset-password', [AuthController::class, 'resetPassword']);
   
});
Route::controller(HomeController::class)->middleware('auth:sanctum')->group
(function(){
    Route::get('products','productList');
    Route::get('categories','categoryList');
});
Route::controller(HomeController::class)->middleware('auth:sanctum')->group
(function(){
    Route::get('programs','programList');
    Route::get('exercises','exerciseList');
    Route::get('workouts','workoutList');
});

Route::post('password/email',[ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset',[ForgotPasswordController::class, 'reset'])->name('password.reset');

Route::post('forgot-password',[newForgotPasswordController::class, 'forgotPassword']);

Route::post('reset-password',[newForgotPasswordController::class, 'resetPassword']);