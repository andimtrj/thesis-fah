<?php

use App\Http\Controllers\ApiWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;

// Route::get('/', function () {
//     return view('home');
// });
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('register');
    })->name('register');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/createBranch',  [BranchController::class, 'CreateBranch'])->name('login');

    Route::middleware('auth')->group(function(){
        Route::get('/branch', function () {
            return view('branch');
        })->name('branch');

        Route::get('/menu', function () {
            return view('menu');
        })->name('menu');

    });


    Route::get('/landing', function () {
        return view('landing');
    })->name('landing');

    Route::get('/branchadmin', function () {
        return view('branchadmin');
    })->name('branchadmin');
});


#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate'])->name('auth');
Route::post('/registration', [ApiWebController::class, 'Registration'])->name('registration');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
#endregion


