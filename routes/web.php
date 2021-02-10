<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\ToDoListTaskController;

Route::get('/', function () {
    return view('home');
})->middleware('guest')->name('home');

Route::get('profile', [PageController::class, 'showUserProfile'])->middleware(['auth'])->name('userProfile');

Route::post('/todoListTask', [ToDoListTaskController::class, 'store']);
Route::post('/todoListTask/{id}', [ToDoListTaskController::class, 'update']);

Route::resource('project', ProjectController::class)->only(['store', 'show']);
Route::resource('todoList', ToDoListController::class);


require __DIR__.'/auth.php';
