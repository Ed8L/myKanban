<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware('guest')->name('home');

Route::get('/user/{user_login}', [PageController::class, 'userProfile'])->middleware(['auth'])->name('userProfile');

require __DIR__.'/auth.php';
