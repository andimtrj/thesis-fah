<?php

use App\Http\Controllers\ApiWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IngredientController;
use App\Models\Branch;

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


    Route::middleware('auth')->group(function () {
        // Branch
        Route::get('/branch', [BranchController::class, 'showBranchPaging'])->name('branch');
        Route::get('/landing', function () {
            return view('landing');
        })->name('landing');

        Route::get('/add-branch', function () {
            return view('components.branch.add-branch');
        })->name('add-branch');

        Route::get('/edit-branch/{id}', [BranchController:: class, 'DetailBranchPage'])->name('edit-branch');
        Route::post('/create-branch',  [BranchController::class, 'CreateBranch'])->name('create-branch');
        Route::post('/update-branch/{id}',  [BranchController::class, 'UpdateBranch'])->name('update-branch');
        Route::get('/get-paging-branch', [BranchController::class, 'GetPagingBranch'])->name('get-paging-branch');


        // Ingredient
        Route::get('/ingredient', [IngredientController::class, 'showIngredientPage'])->name('ingredient');
        Route::get('/add-ingredient', [IngredientController::class, 'showAddIngredientPage'])->name('add-ingredient');
        Route::get('/edit-ingredient/{id}', [IngredientController::class, 'DetailIngredientPage'])->name('edit-ingredient');
        Route::post('/insert-ingredient', [IngredientController::class, 'InsertIngredient'])->name('insert-ingredient');
        Route::post('/update-ingredient/{id}', [IngredientController::class, 'UpdateIngredient'])->name('update-ingredient');

        Route::get('/product', [ProductController::class, 'showProductPage'])->name('product');
        Route::get('/add-product', [ProductController::class, 'showAddProductPage'])->name('add-product');
        Route::get('/edit-product/{id}', [ProductController::class, 'showEditProductPage'])->name('edit-product');
        Route::post('/insert-product', [ProductController::class, 'InsertProduct'])->name('insert-product');
        Route::get('/get-metrics/{ingredient_code}', [IngredientController::class, 'getMetrics'])->name('get-metrics');

        // Summary
        Route::get('/summary', function () {
            return view('summary');
        })->name('summary');

        Route::get('/landing', function () {Return view('landing');})->name('landing');
    });
});


#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate'])->name('auth');
Route::post('/registration', [ApiWebController::class, 'Registration'])->name('registration');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
#endregion
