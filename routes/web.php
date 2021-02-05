<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(auth()->check()) {
        return redirect()->route('dashboard', auth()->user()->login);
    }
    return view('home');
})->name('home');

Route::get('/user/{user_login}', [PageController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
