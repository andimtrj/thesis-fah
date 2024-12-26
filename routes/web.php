<?php

use App\Http\Controllers\AdjustmentPageController;
use App\Http\Controllers\AdjustmentTrxHController;
use App\Http\Controllers\ApiWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchAdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PurchasePageController;
use App\Http\Controllers\PurchaseTrxHController;
use App\Http\Controllers\UsagePageController;
use App\Http\Controllers\UsageTrxHController;
use App\Http\Controllers\UserController;
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
        Route::get('/dashboard', function() {
            return view('dashboard');
        })->name('dashboard');

        Route::middleware(App\Http\Middleware\CheckRole::class . ':TO')->group(function(){
            // Branch
            Route::get('/branch', [BranchController::class, 'showBranchPaging'])->name('branch');
            Route::get('/add-branch', function () {
                return view('components.branch.add-branch');
            })->name('add-branch');

            Route::get('/edit-branch/{id}', [BranchController:: class, 'DetailBranchPage'])->name('edit-branch');
            Route::post('/create-branch',  [BranchController::class, 'CreateBranch'])->name('create-branch');
            Route::post('/update-branch/{id}',  [BranchController::class, 'UpdateBranch'])->name('update-branch');
            Route::get('/get-paging-branch', [BranchController::class, 'GetPagingBranch'])->name('get-paging-branch');
            Route::post('/delete-branch/{id}', [BranchController::class, 'DeleteBranch'])->name('delete-branch');

            //Branch Admin
            Route::get('/branch-admin/{branchId}', [BranchAdminController::class, 'showBranchAdminPaging'])->name('branch-admin');
            Route::get('/add-branch-admin/{branchId}', [BranchAdminController::class, 'showAddBranchAdminPage'])->name('add-branch-admin');
            Route::get('/edit-branch-admin/{branchAdminId}', [BranchAdminController::class, 'showEditBranchAdminPage'])->name('edit-branch-admin');
            Route::post('/insert-branch-admin', [UserController::class, 'RegisterBranchAdmin'])->name('insert-branch-admin');
            Route::post('/update-branch-admin', [UserController::class, 'UpdateBranchAdmin'])->name('update-branch-admin');
            Route::post('/delete-branch-admin/{id}', [UserController::class, 'DeleteBranchAdmin'])->name('delete-branch-admin');
        });
        Route::get('/landing', function () {
            return view('landing');
        })->name('landing');


        // Ingredient
        Route::get('/ingredient', [IngredientController::class, 'showIngredientPage'])->name('ingredient');
        Route::get('/add-ingredient', [IngredientController::class, 'showAddIngredientPage'])->name('add-ingredient');
        Route::get('/edit-ingredient/{id}', [IngredientController::class, 'DetailIngredientPage'])->name('edit-ingredient');
        Route::post('/insert-ingredient', [IngredientController::class, 'InsertIngredient'])->name('insert-ingredient');
        Route::post('/update-ingredient/{id}', [IngredientController::class, 'UpdateIngredient'])->name('update-ingredient');
        Route::post('/delete-ingredient/{id}', [IngredientController::class, 'DeleteIngredient'])->name('delete-ingredient');

        Route::get('/product', [ProductController::class, 'showProductPage'])->name('product');
        Route::get('/add-product', [ProductController::class, 'showAddProductPage'])->name('add-product');
        Route::get('/edit-product/{id}', [ProductController::class, 'showEditProductPage'])->name('edit-product');
        Route::post('/insert-product', [ProductController::class, 'InsertProduct'])->name('insert-product');
        Route::post('/update-product/{id}', [ProductController::class, 'UpdateProduct'])->name('update-product');
        Route::post('/delete-product/{id}', [ProductController::class, 'DeleteProduct'])->name('delete-product');


        Route::get('/get-metrics/{ingredient_code}', [IngredientController::class, 'getMetrics'])->name('get-metrics');

        // Summary
        Route::get('/summary', function () {
            return view('summary');
        })->name('summary');

        // Usage
        Route::get('/usage', [UsagePageController::class, 'ShowUsagePage'])->name('usage');
        Route::get('/add-usage', [UsagePageController::class, 'ShowAddUsagePage'])->name('add-usage');
        Route::post('/insert-usage', [UsageTrxHController::class, 'InsertUsageTrxH'])->name('insert-usage');

        // Purchase
        Route::get('/purchase', [PurchasePageController::class, 'ShowPurchasePage'])->name('purchase');
        Route::get('/add-purchase', [PurchasePageController::class, 'ShowAddPurchasePage'])->name('add-purchase');
        Route::post('/insert-purchase', [PurchaseTrxHController::class, 'InsertPurchaseTrxH'])->name('insert-purchase');

        //Adjustment
        Route::get('/adjustment', [AdjustmentPageController::class, 'ShowAdjustmentPage'])->name('adjustment');
        Route::get('/add-adjustment', [AdjustmentPageController::class, 'ShowAddAdjustmentPage'])->name('add-adjustment');
        Route::post('/insert-adjustment', [AdjustmentTrxHController::class, 'InsertAdjustmentTrxH'])->name('insert-adjustment');



        Route::get('/landing', function () {Return view('landing2');})->name('landing');
        Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
    });
});


#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate'])->name('auth');
Route::post('/registration', [ApiWebController::class, 'Registration'])->name('registration');
#endregion
