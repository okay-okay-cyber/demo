<?php

use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WorkoutController;
use App\Http\Controllers\HomeController;
use App\Models\Exercise;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::resource('program', ProgramController::class);
    Route::resource('workout', WorkoutController::class);
    Route::post('/workout/store', [WorkoutController::class, 'store'])->name('auth.workout.store');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('exercise', ExerciseController::class);
});



//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
