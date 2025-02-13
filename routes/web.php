<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('public.index');
});

Route::get('/ideas', function () {
    return view('public.index');
});

Route::get('/contact', function () {
    return view('public.contact');
});

