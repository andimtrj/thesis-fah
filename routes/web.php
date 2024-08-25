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
