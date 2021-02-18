<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToDoListController;

Route::get('/', function () {
    return view('guest.home');
})->middleware('guest')->name('home');

Route::get('profile', [ProjectController::class, 'index'])
    ->middleware(['auth'])
    ->name('userProfile');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('project', ProjectController::class)->only(['store', 'show', 'update', 'destroy']);
    Route::resource('todo', ToDoListController::class)->only(['store', 'destroy']);
});

require __DIR__ . '/auth.php';
