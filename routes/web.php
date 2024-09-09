<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
});

Route::get('/branch', function () {
    return view('branch');
})->name('branch');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/branchadmin', function () {
    return view('branchadmin', ['hideActions' => true]);
})->name('branchadmin');
