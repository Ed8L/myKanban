<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoListTaskController;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return view('guest.home');
})->middleware('guest')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [ProjectController::class, 'index'])->name('userProfile');
    Route::resource('project', ProjectController::class)->only(['store', 'show', 'update', 'destroy']);
    Route::resource('todo', TodoListController::class)->only(['store', 'destroy']);
    Route::resource('task', TodoListTaskController::class)->only(['store', 'edit', 'update', 'destroy']);
    Route::resource('board', BoardController::class)->only(['store', 'update', 'destroy', 'edit']);
});

require __DIR__ . '/auth.php';
