<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;


// 管理者ログイン
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login'); // ログインページ表示
Route::post('/admin/login', [AdminController::class, 'authenticate'])->middleware('throttle:3,1')->name('admin.login.submit'); // ログイン処理


// 認証後の管理者専用ルート
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // ダッシュボード
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout'); // ログアウト処理
});


// require __DIR__.'/auth.php';
