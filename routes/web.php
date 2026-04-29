<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/login', function () {
    return view('pages.login');
})->name('login');

route::get('/sidebar', function () {
    return view('components.sidebar');
})->name('sidebar');
