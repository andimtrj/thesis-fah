<?php

use App\Http\Controllers\ApiWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('home');
// });
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('register');
    })->name('register');

    Route::get('/login', function () {
        return view('login');
    });

    Route::middleware('auth')->group(function(){
        Route::get('/branch', function () {
            return view('branch');
        })->name('branch');
    });

    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');


    Route::get('/landing', function () {
        return view('landing');
    });

});



#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate']);
Route::post('/registration', [ApiWebController::class, 'Registration']);
#endregion



