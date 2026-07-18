<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MPController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminTUController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\KepalaSekolahController;

Route::get('/', fn () => Redirect::route('login'));

Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
Route::post('/login', [Login::class, 'login']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [Login::class, 'logout'])->middleware('auth')->name('logout');

    Route::get('/data-kelas', [KelasController::class, 'show'])->name('kelas.show');
    Route::post('/data-kelas', [KelasController::class, 'simpan'])->name('kelas.simpan');
    Route::put('/data-kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/data-kelas/{id}', [KelasController::class, 'delete'])->name('kelas.delete');

    Route::get('/data-siswa', [SiswaController::class, 'show'])->name('siswa.show');
    Route::post('/data-siswa', [SiswaController::class, 'simpan'])->name('siswa.simpan');
    Route::delete('/data-siswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    Route::put('/data-siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::post('/check-nis', [SiswaController::class, 'checkNis'])->name('siswa.checkNis');

    Route::get('/mata-pelajaran', [MPController::class, 'show'])->name('mp.show');
    Route::post('/mata-pelajaran', [MPController::class, 'simpan'])->name('mp.simpan');
    Route::delete('/mata-pelajaran/{id}', [MPController::class, 'delete'])->name('mp.delete');
    Route::put('/mata-pelajaran/{id}', [MPController::class, 'update'])->name('mp.update');

    Route::get('/data-guru', [GuruController::class, 'show'])->name('guru.show');
    Route::post('/data-guru', [GuruController::class, 'simpan'])->name('guru.simpan');
    Route::delete('/data-guru/{id}', [GuruController::class, 'delete'])->name('guru.delete');
    Route::put('/data-guru/{id}', [GuruController::class, 'update'])->name('guru.update');

    Route::get('/guru/input-nilai',  [NilaiController::class, 'showInput'])->name('guru.input-nilai');
    Route::post('/guru/input-nilai', [NilaiController::class, 'simpan'])->name('guru.simpan-nilai');

    Route::get('/guru/rekap-nilai',  [NilaiController::class, 'showRekap'])->name('guru.rekap-nilai');

    Route::get('/data-admin-TU', [AdminTUController::class, 'show'])->name('admin-TU.show');
    Route::post('/data-admin-TU', [AdminTUController::class, 'simpan'])->name('admin-TU.simpan');
    Route::delete('/data-admin-TU/{id}', [AdminTUController::class, 'delete'])->name('admin-TU.delete');
    Route::put('/data-admin-TU/{id}', [AdminTUController::class, 'update'])->name('admin-TU.update');

    Route::get('/kelola-tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::post('/kelola-tugas', [TugasController::class, 'simpan'])->name('tugas.simpan');
    Route::put('/kelola-tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/kelola-tugas/{id}', [TugasController::class, 'delete'])->name('tugas.delete');

    Route::get('/wali-kelas/kelas-saya', [WaliKelasController::class, 'kelas_saya'])->name('wali-kelas.kelas-saya');
    Route::get('/wali-kelas/rapor', [WaliKelasController::class, 'rapor'])->name('wali-kelas.rapor');

    Route::get('/kepala-sekolah/penilaian-siswa', [KepalaSekolahController::class, 'index'])
     ->name('kepala-sekolah.penilaian-siswa');

    Route::get('/profil-saya', [ProfileController::class, 'show'])->name('profil-saya.show');
    Route::put('/profil-saya', [ProfileController::class, 'update'])->name('profil-saya.update');
    Route::post('/profil-saya/upload-foto-profil', [ProfileController::class, 'uploadFP'])->name('profil-saya.upload-foto-profil');
    Route::post('/profil-saya/upload-tanda-tangan', [ProfileController::class, 'uploadTT'])->name('profil-saya.upload-tanda-tangan');

    Route::post('/guru-check-duplicate', [ProfileController::class, 'checkDuplicate'])->name('guru.checkDuplicate');
    Route::post('/admin-TU-check-duplicate', [ProfileController::class, 'checkDuplicate'])->name('admin-TU.checkDuplicate');
});

