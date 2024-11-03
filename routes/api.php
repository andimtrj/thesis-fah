<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


#region User
// Route::post('/registerTenantOwner', [\App\Http\Controllers\Api\UserController::class, 'RegisterTenantOwner']);
// Route::post('/registerBranchAdmin', [\App\Http\Controllers\Api\UserController::class, 'RegisterBranchAdmin']);
#endregion

#region Branch
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/createBranch', [\App\Http\Controllers\Api\BranchController::class, 'CreateBranch']);
// });
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/registerBranchAdmin', [\App\Http\Controllers\Api\UserController::class, 'RegisterBranchAdmin']);
});

#endregion

