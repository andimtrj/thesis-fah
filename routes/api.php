<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\Api\UserController::class, 'Register']);

Route::post('/generateTenantCode', [\App\Http\Controllers\Api\UserController::class, 'GenerateTenantCode']);
