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

route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard');
})->name('admin.dashboard');

route::get('/guru/dashboard', function () {
    return view('pages.guru.dashboard');
})->name('guru.dashboard');

route::get('/guru/input-nilai', function () {
    return view('pages.guru.input-nilai');
})->name('guru.input-nilai');

route::get('/guru/data-pribadi', function () {
    return view('pages.guru.data-pribadi');
})->name('guru.data-pribadi');

