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

        Route::get('/product', function () {
            return view('product');
        })->name('product');

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
        Route::get('/ingredient', [IngredientController::class, 'showIngredient'])->name('ingredient');
        Route::get('/add-ingredient', function () {return view('components.ingredient.add-ingredient');})->name('add-ingredient');
        Route::get('/edit-ingredient', function () {return view('components.ingredient.edit-ingredient');})->name('edit-ingredient');

        Route::get('/product', [ProductController::class, 'showProduct'])->name('product');
        Route::get('/add-product', function(){return view('components.product.add-product');})->name('add-product');

        Route::get('/landing', function () {Return view('landing');})->name('landing');
    });
});


#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate'])->name('auth');
Route::post('/registration', [ApiWebController::class, 'Registration'])->name('registration');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
#endregion
