<?php

use App\Http\Controllers\ApiWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
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


    Route::middleware('auth')->group(function(){
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
    });
});


#region Authenticate
Route::post('/auth', [AuthController::class, 'Authenticate'])->name('auth');
Route::post('/registration', [ApiWebController::class, 'Registration'])->name('registration');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
#endregion


