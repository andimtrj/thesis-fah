<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return view('register');
});

<<<<<<< HEAD
Route::get('/login', function () {
    return view('login');
});

Route::get('/branch', function () {
    return view('branch');
});
=======

#region Authenticate
Route::post('/login', [AuthController::class, 'Authenticate']);
#endregion
>>>>>>> b33e8cf9af32b44501d139bd3ab7c0e17f786944
