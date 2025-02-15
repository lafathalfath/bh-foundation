<?php

use App\Http\Controllers\admin\AppSettingsController;
use App\Http\Controllers\public\AboutController;
use App\Http\Controllers\public\homeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\public\IdeasController;
use App\Http\Controllers\public\ContactController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

// guest
Route::prefix('/auth')->middleware(GuestMiddleware::class)->group(function () {
    Route::get('/manage', [AuthController::class, 'loginView'])->name('auth.login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// authenticated
Route::middleware(AuthenticateMiddleware::class)->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('/admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/app-settings', [AppSettingsController::class, 'index'])->name('admin.app_settings.view');
        Route::put('/app-settings/update', [AppSettingsController::class, 'update'])->name('admin.app_settings.update');
    });
});

// public
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/our-works', function () {return 'OUR WORKS';})->name('works');
Route::get('/ideas', [IdeasController::class, 'index'])->name('ideas');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');