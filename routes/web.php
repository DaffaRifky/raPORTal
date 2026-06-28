<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminTUController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\KepalaSekolahController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
Route::post('/login', [Login::class, 'login']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [Login::class, 'logout'])->middleware('auth')->name('logout');

    Route::get('/datakelas',         [KelasController::class, 'show']);
    Route::post('/datakelas',        [KelasController::class, 'simpan'])->name('kelas.simpan');
    Route::put('/datakelas/{id}',    [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/datakelas/{id}', [KelasController::class, 'delete'])->name('kelas.delete');

    Route::get('/datasiswa', [SiswaController::class, 'show']);
    Route::post('/datasiswa', [SiswaController::class, 'simpan'])->name('siswa.simpan');
    Route::delete('/datasiswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    Route::put('/datasiswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    Route::get('/dataguru', [GuruController::class, 'show']);
    Route::post('/dataguru', [GuruController::class, 'simpan'])->name('guru.simpan');
    Route::delete('/dataguru/{id}', [GuruController::class, 'delete'])->name('guru.delete');
    Route::put('/dataguru/{id}', [GuruController::class, 'update'])->name('guru.update');

    Route::get('/guru/input-nilai',  [NilaiController::class, 'showInput'])->name('guru.input-nilai');
    Route::post('/guru/input-nilai', [NilaiController::class, 'simpan'])->name('guru.simpan-nilai');

    Route::get('/guru/rekap-nilai',  [NilaiController::class, 'showRekap'])->name('guru.rekap-nilai');

    Route::get('/dataadminTU', [AdminTUController::class, 'show']);
    Route::post('/dataadminTU', [AdminTUController::class, 'simpan'])->name('admin-TU.simpan');
    Route::delete('/dataadminTU/{id}', [AdminTUController::class, 'delete'])->name('admin-TU.delete');
    Route::put('/dataadminTU/{id}', [AdminTUController::class, 'update'])->name('admin-TU.update');

    Route::get('/kelola-tugas',          [TugasController::class, 'index'])->name('tugas.index');
    Route::post('/kelola-tugas',         [TugasController::class, 'simpan'])->name('tugas.simpan');
    Route::put('/kelola-tugas/{id}',     [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/kelola-tugas/{id}',  [TugasController::class, 'delete'])->name('tugas.delete');

    Route::get('/wali-kelas/kelas-saya', [WaliKelasController::class, 'index'])->name('wali-kelas.kelas-saya');

    Route::get('/kepala-sekolah/penilaian-siswa', [KepalaSekolahController::class, 'index'])
     ->name('kepala-sekolah.penilaian-siswa');

    // route::get('/profil-saya', function () {
    //     return view('pages.profil-saya');
    // })->name('profil-saya');

    Route::get('/profil-saya',  [ProfileController::class, 'show'])->name('profil-saya');
    Route::post('/profil-saya', [ProfileController::class, 'upload'])->name('profil-saya.upload');
});

route::get('/header', function () {
    return view('components.header');
})->name('components.header');

route::get('/sidebar', function () {
    return view('components.sidebar');
})->name('components.sidebar');

