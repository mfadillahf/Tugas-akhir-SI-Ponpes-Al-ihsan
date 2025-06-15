<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Infaq\InfaqController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Agenda\AgendaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Santri\SantriController;
use App\Http\Controllers\Sistem\BeritaController;
use App\Http\Controllers\Sistem\GaleriController;
use App\Http\Controllers\Akademik\KelasController;
use App\Http\Controllers\Akademik\MapelController;
use App\Http\Controllers\Akademik\NilaiController;
use App\Http\Controllers\Sistem\TentangController;
use App\Http\Controllers\Donatur\DonaturController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Kepengurusan\KepengurusanController;




// Route::get('/', function () {
//     return redirect()->route('login');
// });
// Route::get('/', function () {
//     return view('landingpage.landingpage');
// });

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');


// Route Login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// callback midtrans
Route::post('/midtrans/callback', [InfaqController::class, 'callback'])->name('midtrans.callback');

// Form register Santri
Route::get('/register/santri', [RegisterController::class, 'showSantriForm'])->name('register.santri');
Route::post('/register/santri', [RegisterController::class, 'registerSantri'])->name('register.santri.post');

// Form register Donatur
Route::get('/register/donatur', [RegisterController::class, 'showDonaturForm'])->name('register.donatur');
Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur.post');

// berita detail
Route::get('berita/{id}/detail', [LandingPageController::class, 'beritaDetail'])->name('berita.detail');

// Galeri All
Route::get('/galeri/index', [LandingPageController::class, 'galeri'])->name('landing.galeri');

// tetang ponpes
Route::get('/tentang/ponpes', [LandingPageController::class, 'tentangponpes'])->name('landing.tentang');

// Kalender
Route::get('/kalender', [LandingPageController::class, 'kalender'])->name('landing.kalender');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //dashboard
    Route::middleware('role:admin')->get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::middleware('role:santri')->get('/santri/dashboard', [DashboardController::class, 'santriDashboard'])->name('dashboard.santri');
    Route::middleware('role:guru')->get('/guru/dashboard', [DashboardController::class, 'guruDashboard'])->name('dashboard.guru');
    Route::middleware('role:donatur')->get('/donatur/dashboard', [DashboardController::class, 'donaturDashboard'])->name('dashboard.donatur');

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

    // // Tambahan: rute untuk detail hapalan (misalnya muncul di pop-up/modal)
    // Route::get('hapalan/{id}/detail', [\App\Http\Controllers\Akademik\HapalanController::class, 'showDetail'])->name('hapalan.showDetail');

    // // Tambahan: proses simpan detail hapalan (AJAX / POST manual)
    // Route::post('hapalan/{id}/detail', [\App\Http\Controllers\Akademik\HapalanController::class, 'storeDetail'])->name('hapalan.storeDetail');

    // // Tambahan: edit/update detail hapalan (jika pakai modal atau redirect)
    // Route::get('hapalan/detail/{id}/edit', [\App\Http\Controllers\Akademik\HapalanController::class, 'editDetail'])->name('hapalan.editDetail');
    // Route::put('hapalan/detail/{id}', [\App\Http\Controllers\Akademik\HapalanController::class, 'updateDetail'])->name('hapalan.updateDetail');

    // // Tambahan: hapus detail
    // Route::delete('hapalan/detail/{id}', [\App\Http\Controllers\Akademik\HapalanController::class, 'destroyDetail'])->name('hapalan.destroyDetail');

    // agenda
    Route::resource('agenda', AgendaController::class);
    Route::get('agenda/{id}/detail', [AgendaController::class, 'showDetail'])->name('agenda.showDetail');

    // infaq
    Route::post('/infaq/pay', [InfaqController::class, 'pay'])->name('infaq.pay');
    
    Route::resource('infaq', InfaqController::class);

    // sistem
    Route::resource('berita', BeritaController::class);
    
    Route::resource('galeri', GaleriController::class);
    Route::get('galeri/{id}/detail', [GaleriController::class, 'showDetail'])->name('galeri.showDetail');

    Route::resource('tentang', TentangController::class);

    // profile
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    

});