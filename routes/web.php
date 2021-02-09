<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('home');
})->middleware('guest')->name('home');

Route::get('profile', [PageController::class, 'showUserProfile'])->middleware(['auth'])->name('userProfile');

Route::resource('project', ProjectController::class)->only(['store', 'show']);

require __DIR__.'/auth.php';
