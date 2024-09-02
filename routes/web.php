<?php

use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkoutController;
use App\Http\Controllers\HomeController;
use App\Models\Exercise;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::middleware('auth','role:admin')->prefix('admin')->group(function(){
    Route::resource('program', ProgramController::class);
    Route::resource('workout', WorkoutController::class);
    Route::post('/workout/store', [WorkoutController::class, 'store'])->name('auth.workout.store');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('exercise', ExerciseController::class);
    Route::resource('user', UserController::class);
    Route::resource('subscription', SubscriptionController::class);
    Route::get('/admin/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');

});



//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
