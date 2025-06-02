<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Infaq\InfaqController;
use App\Http\Controllers\Agenda\AgendaController;
use App\Http\Controllers\Santri\SantriController;
use App\Http\Controllers\Sistem\BeritaController;
use App\Http\Controllers\Sistem\GaleriController;
use App\Http\Controllers\Akademik\KelasController;
use App\Http\Controllers\Akademik\MapelController;
use App\Http\Controllers\Akademik\NilaiController;
use App\Http\Controllers\Donatur\DonaturController;
use App\Http\Controllers\Kepengurusan\KepengurusanController;




Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    // santri
    Route::resource('santri', SantriController::class);
    Route::get('santri/{id}/detail', [SantriController::class, 'showDetail'])->name('santri.showDetail');

    // guru
    Route::resource('guru', GuruController::class)->except(['show']);
    Route::get('guru/{id}/detail', [GuruController::class, 'showDetail'])->name('guru.showDetail');

    // kepengurusan
    Route::resource('kepengurusan', KepengurusanController::class);
    Route::get('kepengurusan/{id}/detail', [KepengurusanController::class, 'showDetail'])->name('kepengurusan.showDetail');

    // donatur
    Route::resource('donatur', DonaturController::class)->except(['show']);;
    Route::get('donatur/{id}/detail', [DonaturController::class, 'showDetail'])->name('donatur.showDetail');

    // akademik
    Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
    ]);;
    
    // mapel
    Route::resource('mapel', MapelController::class);
    Route::get('mapel/{id}/detail', [MapelController::class, 'showDetail'])->name('mapel.showDetail');

    // nilai
    Route::resource('nilai', NilaiController::class);

    // hapalan
    Route::resource('hapalan', \App\Http\Controllers\Akademik\HapalanController::class);

    // agenda
    Route::resource('agenda', AgendaController::class);
    Route::get('agenda/{id}/detail', [AgendaController::class, 'showDetail'])->name('agenda.showDetail');

    // infaq
    Route::resource('infaq', InfaqController::class);

    // sistem
    Route::resource('berita', BeritaController::class);
    Route::get('berita/{id}/detail', [BeritaController::class, 'showDetail'])->name('berita.showDetail');
    
    Route::resource('galeri', GaleriController::class);
    Route::get('galeri/{id}/detail', [GaleriController::class, 'showDetail'])->name('galeri.showDetail');

    

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');

    // Route::get('/santri/dashboard', function () {
    //     return view('welcome');
    // })->name('dashboard.santri');

    Route::get('/guru/dashboard', function () {
        return view('DashboardGuru');
    })->name('dashboard.guru');

    Route::get('/donatur/dashboard', function () {
        return view('DashboardDonatur');
    })->name('dashboard.donatur');
});