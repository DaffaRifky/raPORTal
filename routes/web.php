<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Login::class, 'login']);

});

Route::post('/logout', [Login::class, 'logout'])->middleware('auth')->name('logout');

// route::get('/login', function () {
//     return view('pages.login');
// })->name('login');

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

route::get('/admin/data-guru', function () {
    return view('pages.admin.data-guru');
})->name('admin.data-guru');

route::get('/admin/data-kelas', function () {
    return view('pages.admin.data-kelas');
})->name('admin.data-kelas');

route::get('/admin/data-siswa', function () {
    return view('pages.admin.data-siswa');
})->name('admin.data-siswa');

route::get('/admin/data-admin', function () {
    return view('pages.admin.data-admin');
})->name('admin.data-admin');

route::get('/header', function () {
    return view('components.header');
})->name('components.header');
