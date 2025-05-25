<?php


use App\Http\Controllers\Akademik\KelasController;
use App\Http\Controllers\Akademik\MapelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Santri\SantriController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Donatur\DonaturController;
use App\Http\Controllers\Infaq\InfaqController;
use App\Http\Controllers\Kepengurusan\KepengurusanController;
use App\Http\Controllers\Sistem\BeritaController;
use App\Http\Controllers\Sistem\GaleriController;



Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // santri
    Route::resource('santri', SantriController::class);
    Route::get('santri/{id}/detail', [SantriController::class, 'showDetail'])->name('santri.showDetail');

    // guru
    Route::resource('guru', GuruController::class);
    Route::get('guru/{id}/detail', [GuruController::class, 'showDetail'])->name('guru.showDetail');

    // kepengurusan
    Route::resource('kepengurusan', KepengurusanController::class);
    Route::get('kepengurusan/{id}/detail', [KepengurusanController::class, 'showDetail'])->name('kepengurusan.showDetail');

    // donatur
    Route::resource('donatur', DonaturController::class);
    Route::get('donatur/{id}/detail', [DonaturController::class, 'showDetail'])->name('donatur.showDetail');

    // akademik
    Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
    ]);;
    
    // mapel
    Route::resource('mapel', MapelController::class);

    // infaq
    Route::resource('infaq', InfaqController::class);

    // Route::resource('berita', BeritaController::class);
    
    // Route::resource('galeri', GaleriController::class);

    Route::get('/admin/dashboard', function () {
        return view('welcome');
    })->name('dashboard.admin');
});