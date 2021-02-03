<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
