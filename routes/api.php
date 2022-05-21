<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login'])->name('login');


// put all api protected routes here
Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'userDetails']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('customers', [CustomerController::class, 'index'])->name('get-customers');
    Route::get('customer/{id}', [CustomerController::class, 'singleCustomer'])->name('get-customer');
});
