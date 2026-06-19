<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminTUController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TugasController;

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


    Route::post('/logout', [Login::class, 'logout'])->middleware('auth')->name('logout');

    Route::get('/datakelas', [KelasController::class, 'show']);
    Route::get('/datasiswa', [KelasController::class, 'show']);
    Route::post('/datakelas', [KelasController::class, 'simpan'])->name('kelas.simpan');

    Route::get('/datasiswa', [SiswaController::class, 'show']);
    Route::post('/datasiswa', [SiswaController::class, 'simpan'])->name('siswa.simpan');
    Route::delete('/datasiswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    Route::put('/datasiswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    Route::get('/dataguru', [GuruController::class, 'show']);
    Route::post('/dataguru', [GuruController::class, 'simpan'])->name('guru.simpan');
    Route::delete('/dataguru/{id}', [GuruController::class, 'delete'])->name('guru.delete');
    Route::put('/dataguru/{id}', [GuruController::class, 'update'])->name('guru.update');
    
    Route::get('/guru/input-nilai',  [NilaiController::class, 'show'])->name('guru.input-nilai');
    Route::post('/guru/input-nilai', [NilaiController::class, 'simpan'])->name('guru.simpan-nilai');

    Route::get('/dataadminTU', [AdminTUController::class, 'show']);
    Route::post('/dataadminTU', [AdminTUController::class, 'simpan'])->name('admin-TU.simpan');
    Route::delete('/dataadminTU/{id}', [AdminTUController::class, 'delete'])->name('admin-TU.delete');
    Route::put('/dataadminTU/{id}', [AdminTUController::class, 'update'])->name('admin-TU.update');

    Route::get('/kelola-tugas',          [TugasController::class, 'index'])->name('tugas.index');
    Route::post('/kelola-tugas',         [TugasController::class, 'simpan'])->name('tugas.simpan');
    Route::put('/kelola-tugas/{id}',     [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/kelola-tugas/{id}',  [TugasController::class, 'delete'])->name('tugas.delete');
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

