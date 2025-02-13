<?php

use App\Http\Controllers\public\aboutController;
use Illuminate\Support\Facades\Route;


// authenticated

// public
Route::get('/', function () {
    return view('public.index');
})->name('home');
Route::get('/about-us', [aboutController::class, 'index'])->name('about');
Route::get('/our-works', function () {return 'OUR WORKS';})->name('works');
Route::get('/ideas', function () {return 'IDEAS';})->name('ideas');
Route::get('/contact', function () {return 'CONTACT';})->name('contact');