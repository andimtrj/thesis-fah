<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return view('register');
});


#region Authenticate
Route::post('/login', [AuthController::class, 'Authenticate']);
#endregion

Route::get('/login', function () {
    return view('login');
});

Route::get('/branch', function () {
    return view('branch');
});
