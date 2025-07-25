<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Infaq;
use App\Models\Santri;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
	   Paginator::useBootstrapFive();
	  setlocale(LC_TIME, 'id_ID.UTF-8');
    	Carbon::setLocale('id');
	  
        // Notifikasi infaq dan santri baru
        View::composer('*', function ($view) {
		if (Auth::check() && Auth::user()->hasRole('admin')) {
			$infaqsMenunggu = Infaq::with('donatur')
				->where('status', 'pending')
				->orderByDesc('created_at')
				->get();

			$calonSantri = Santri::where('status', 'calon')
				->orderByDesc('created_at')
				->get();

			// Gabung notifikasi
			$notifikasiGabungan = collect([]);

			foreach ($infaqsMenunggu as $infaq) {
				$notifikasiGabungan->push([
					'type' => 'infaq',
					'nama' => optional($infaq->donatur)->nama ?? 'Donatur Tidak Diketahui',
					'deskripsi' => 'Infaq sebesar <b>Rp' . number_format($infaq->nominal, 0, ',', '.') . '</b>',
					'waktu' => $infaq->created_at,
					'link' => route('infaq.index')
				]);
			}

			foreach ($calonSantri as $santri) {
				$notifikasiGabungan->push([
					'type' => 'santri',
					'nama' => $santri->nama_lengkap,
					'deskripsi' => 'Mengajukan pendaftaran sebagai santri.',
					'waktu' => $santri->created_at,
					'link' => route('santri.index')
				]);
			}

			// Urutkan berdasarkan waktu terbaru
			$notifikasiGabungan = $notifikasiGabungan->sortByDesc('waktu')->values();

			$view->with('notifikasiGabungan', $notifikasiGabungan);
			$view->with('jumlahNotifikasiGabungan', $notifikasiGabungan->count());
		}
	});
	  
    Vite::useStyleTagAttributes(function (?string $src, string $url, ?array $chunk, ?array $manifest) {
      if ($src !== null) {
        return [
          'class' => preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?core)-?.*/i", $src) ? 'template-customizer-core-css' :
                    (preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?theme)-?.*/i", $src) ? 'template-customizer-theme-css' : '')
        ];
      }
      return [];
    });
  }
}