<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Infaq\InfaqController;
use App\Http\Controllers\Infaq\PengeluaranController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Agenda\AgendaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Santri\SantriController;
use App\Http\Controllers\Sistem\BeritaController;
use App\Http\Controllers\Sistem\GaleriController;
use App\Http\Controllers\Akademik\KelasController;
use App\Http\Controllers\Akademik\TahunAjaranController;
use App\Http\Controllers\Akademik\MapelController;
use App\Http\Controllers\Akademik\NilaiController;
use App\Http\Controllers\Sistem\TentangController;
use App\Http\Controllers\Donatur\DonaturController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Akademik\HapalanController;
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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// callback midtrans
Route::post('/midtrans/callback', [InfaqController::class, 'callback'])->name('midtrans.callback');

// Form register Santri
Route::get('/register/santri', [RegisterController::class, 'showSantriForm'])->name('register.santri');
Route::post('/register/santri', [RegisterController::class, 'registerSantri'])->name('register.santri.post');

// Form register Donatur
Route::get('/register/donatur', [RegisterController::class, 'showDonaturForm'])->name('register.donatur');
Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])->name('register.donatur.post');

// berita detail
Route::get('berita/{id}/baca', [LandingPageController::class, 'beritaDetail'])->name('berita.detail');

// Galeri All
Route::get('/galeri/index', [LandingPageController::class, 'galeri'])->name('landing.galeri');

//kepengurusan all
Route::get('/kepengurusan/index', [LandingPageController::class, 'kepengurusan'])->name('landing.kepengurusan');

//laporan infaq
Route::get('/laporan-infaq', [LandingPageController::class, 'laporanInfaq'])->name('laporan.infaq');

//laporan pengeluaran
Route::get('/laporan-pengeluaran', [LandingPageController::class, 'laporanPengeluaran'])->name('laporan.pengeluaran');

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
	Route::middleware('role:admin')->group(function () {
    Route::resource('santri', SantriController::class);
    Route::get('santri/{id}/detail', [SantriController::class, 'showDetail'])->name('santri.showDetail');
	});
	
    // guru
	Route::middleware('role:admin')->group(function () {
    Route::resource('guru', GuruController::class)->except(['show']);
    Route::get('guru/{id}/detail', [GuruController::class, 'showDetail'])->name('guru.showDetail');
	});
	
    // kepengurusan
	Route::middleware('role:admin')->group(function () {
    Route::resource('kepengurusan', KepengurusanController::class);
    Route::get('kepengurusan/{id}/detail', [KepengurusanController::class, 'showDetail'])->name('kepengurusan.showDetail');
	});
	
    // donatur
	Route::middleware('role:admin')->group(function () {
    Route::resource('donatur', DonaturController::class)->except(['show']);;
    Route::get('donatur/{id}/detail', [DonaturController::class, 'showDetail'])->name('donatur.showDetail');
	});
	
    // akademik
	Route::middleware('role:admin')->group(function () {
    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);;
	});
	
	// tahun ajaran
	Route::middleware('role:admin')->group(function () {
	Route::resource('tahun-ajaran', TahunAjaranController::class);
	});
	
    // mapel
	Route::middleware('role:admin')->group(function () {
    Route::resource('mapel', MapelController::class);
    Route::get('mapel/{id}/detail', [MapelController::class, 'showDetail'])->name('mapel.showDetail');
	});
    // nilai
    Route::resource('nilai', NilaiController::class);

    // hapalan
    Route::resource('hapalan', HapalanController::class);
    Route::get('/hapalan/{id}/detail', [HapalanController::class, 'showDetail'])->name('hapalan.showDetail');

    Route::post('/hapalan/{id}/detail', [HapalanController::class, 'storeDetail'])->name('hapalan.detail.store');
    Route::get('/hapalan/detail/{id}/edit', [HapalanController::class, 'editDetail'])->name('hapalan.detail.edit');
    Route::put('/hapalan/detail/{id}', [HapalanController::class, 'updateDetail'])->name('hapalan.detail.update');
    Route::delete('/hapalan/detail/{id}', [HapalanController::class, 'destroyDetail'])->name('hapalan.detail.destroy');
	Route::put('/hapalan/{id}/update-juz-level', [HapalanController::class, 'updateJuzLevel'])->name('hapalan.updateJuzLevel');

    // agenda
	Route::middleware('role:admin')->group(function () {
    Route::resource('agenda', AgendaController::class);
    Route::get('agenda/{id}/detail', [AgendaController::class, 'showDetail'])->name('agenda.showDetail');
	});
	
    // infaq
    Route::post('/infaq/pay', [InfaqController::class, 'pay'])->name('infaq.pay');

    Route::resource('infaq', InfaqController::class);
    Route::get('infaq/{id}/detail', [InfaqController::class, 'showDetail'])->name('infaq.showDetail');
	Route::put('/infaq/{id}/update-nominal', [InfaqController::class, 'updateNominal'])->name('infaq.updateNominal');
	
	// pengeluaran
	Route::middleware('role:admin')->group(function () {
    Route::resource('pengeluaran', PengeluaranController::class);
	});

    // terima dan tolak infaq
    Route::middleware('role:admin')->group(function () {
        Route::post('/infaq/{id}/terima', [InfaqController::class, 'terima'])->name('infaq.terima');
        Route::post('/infaq/{id}/tolak', [InfaqController::class, 'tolak'])->name('infaq.tolak');
    });

    // sistem
	Route::middleware('role:admin')->group(function () {
    Route::resource('berita', BeritaController::class);
    Route::get('berita/{id}/detail', [BeritaController::class, 'showDetail'])->name('berita.showDetail');
    // Galeri
    Route::resource('galeri', GaleriController::class);
    Route::get('galeri/{id}/detail', [GaleriController::class, 'showDetail'])->name('galeri.showDetail');
    // Tentang Ponpes
    Route::resource('tentang', TentangController::class);
	});
    // profile
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
