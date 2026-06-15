<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\guruController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
Route::post('/login', [Login::class, 'login']);


Route::middleware('auth')->group(function () {
    route::get('/guru/dashboard', function () {
    return view('pages.guru.dashboard');
    })->name('guru.dashboard');

    route::get('/dashboard', function () {
    return view('pages.dashboard');
    })->name('dashboard');

    route::get('/guru/input-nilai', function () {
        return view('pages.guru.input-nilai');
    })->name('guru.input-nilai');

    route::get('/guru/data-pribadi', function () {
        return view('pages.guru.data-pribadi');
    })->name('guru.data-pribadi');

    route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    route::get('/admin/data-guru', [guruController::class, 'show'])->name('admin.data-guru');

    route::get('/admin/data-kelas', function () {
        return view('pages.admin.data-kelas');
    })->name('admin.data-kelas');

    route::get('/admin/data-siswa', function () {
        return view('pages.admin.data-siswa');
    })->name('admin.data-siswa');

    route::get('/admin/data-admin', [guruController::class, 'adminData'])->name('admin.data-admin');

    Route::post('/logout', [Login::class, 'logout'])->middleware('auth')->name('logout');

    Route::get('/datakelas', [KelasController::class, 'show']);
    Route::get('/datasiswa', [KelasController::class, 'show']);
    Route::post('/datakelas', [KelasController::class, 'simpan'])->name('kelas.simpan');

    Route::get('/datasiswa', [SiswaController::class, 'show']);
    Route::post('/datasiswa', [SiswaController::class, 'simpan'])->name('siswa.simpan');
    Route::delete('/datasiswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    Route::get('/datasiswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/datasiswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    Route::get('/dataguru', [guruController::class, 'show']);
    Route::post('/dataguru', [guruController::class, 'simpan'])->name('guru.simpan');
});





// route::get('/login', function () {
//     return view('pages.login');
// })->name('login');




route::get('/header', function () {
    return view('components.header');
})->name('components.header');

route::get('/sidebar', function () {
    return view('components.sidebar');
})->name('components.sidebar');

