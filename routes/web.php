<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoListTaskController;

Route::get('/', function () {
    return view('guest.home');
})->middleware('guest')->name('home');

Route::get('profile', [ProjectController::class, 'index'])
    ->middleware(['auth'])
    ->name('userProfile');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('project', ProjectController::class)->only(['store', 'show', 'update', 'destroy']);
    Route::resource('todo', TodoListController::class)->only(['store', 'destroy']);
    Route::resource('task', TodoListTaskController::class)->only(['store']);
});

require __DIR__ . '/auth.php';
