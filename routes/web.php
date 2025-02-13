<?php

use App\Http\Controllers\public\aboutController;
use App\Http\Controllers\public\homeController;
use Illuminate\Support\Facades\Route;


// authenticated

// public
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about-us', [aboutController::class, 'index'])->name('about');
Route::get('/our-works', function () {return 'OUR WORKS';})->name('works');
Route::get('/ideas', function () {return 'IDEAS';})->name('ideas');
Route::get('/contact', function () {return 'CONTACT';})->name('contact');