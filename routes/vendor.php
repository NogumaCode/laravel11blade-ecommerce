<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;


// 管理者ログイン
Route::get('/vendor/login', [VendorController::class, 'login'])->name('vendor.login');
Route::post('/vendor/login', [VendorController::class, 'authenticate'])->middleware('throttle:3,1')->name('vendor.login.submit'); // ログイン処理


Route::middleware(['auth:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::post('/vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');
});
// require __DIR__.'/auth.php';
