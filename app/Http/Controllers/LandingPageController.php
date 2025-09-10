<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\Kepengurusan;
use Illuminate\Http\Request;
use App\Models\KategoriGaleri;
use App\Models\Agenda;
use App\Models\Santri;
use App\Models\Guru;
use App\Models\Infaq;
use App\Models\Pengeluaran;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
	public function index(Request $request)
	{
		$berita = Berita::latest()->take(4)->get();
		$galeri = Galeri::latest()->take(4)->get();
		$kategoriGaleri = KategoriGaleri::with('galeris')->get();
		$kepengurusan = Kepengurusan::latest()->take(4)->get();
		$tentang = Tentang::latest()->first();
		$totalSantri = Santri::where('status', 'Santri')->count();
		$totalGuru = Guru::count();
		$totalKepengurusan = Kepengurusan::count();
		$setting = Setting::first();


		$laporanInfaq = Infaq::select([
			'donaturs.nama',
			DB::raw('SUM(infaqs.nominal) as total_infaq'),
			DB::raw('MAX(infaqs.tanggal) as tanggal_terakhir')
		])
		->join('donaturs', 'infaqs.id_donatur', '=', 'donaturs.id_donatur')
		->whereMonth('infaqs.tanggal', Carbon::now()->month)
		->whereYear('infaqs.tanggal', Carbon::now()->year)
		->where('infaqs.status', 'paid')
		->groupBy('donaturs.nama')
		->orderByDesc('tanggal_terakhir')
		->take(5)
		->get();


		$totalInfaq = Infaq::whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->where('status', 'paid')
			->sum('nominal');

	
		$laporanPengeluaran = Pengeluaran::select(['id_pengeluaran', 'keterangan', 'nominal', 'tanggal'])
			->whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->orderByDesc('tanggal')
			->take(5)
			->get();


		$totalPengeluaran = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->sum('nominal');

		return view('landingpage.landingpage', compact(
			'berita', 'galeri', 'kepengurusan', 'tentang', 'kategoriGaleri',
			'totalGuru', 'totalSantri', 'laporanInfaq', 'laporanPengeluaran',
			'totalKepengurusan', 'totalInfaq', 'totalPengeluaran', 'setting'
		));
	}	
	//infaq masuk
	public function laporanInfaq()
	{
		$laporan = Infaq::select([
			'donaturs.nama',
			DB::raw('SUM(infaqs.nominal) as total_infaq'),
			DB::raw('MAX(infaqs.tanggal) as tanggal_terakhir')
		])
		->join('donaturs', 'infaqs.id_donatur', '=', 'donaturs.id_donatur')
		->whereMonth('infaqs.tanggal', Carbon::now()->month)
		->whereYear('infaqs.tanggal', Carbon::now()->year)
		->where('infaqs.status', 'paid')
		->groupBy('donaturs.nama')
		->orderByDesc('tanggal_terakhir')
		->paginate(10);

		$total = Infaq::whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->where('status', 'paid')
			->sum('nominal');

		return view('landingpage.laporanInfaq', compact('laporan', 'total'));
	}
	
	//pengeluaran
	public function laporanPengeluaran()
	{
		$laporan = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->orderByDesc('tanggal')
			->paginate(10);

		$total = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
			->whereYear('tanggal', Carbon::now()->year)
			->sum('nominal');

		return view('landingpage.laporanPengeluaran', compact('laporan', 'total'));
	}
	

    // berita detail
    public function beritaDetail($id)
    {
        $berita = Berita::findOrFail($id);
        $beritaLain = Berita::where('id_berita', '!=', $id)->latest()->take(5)->get();
        return view('landingpage.beritadetail', compact('berita', 'beritaLain'));
    }

    // Galeri All index
    public function galeri()
    {
        $galeri = Galeri::latest()->get();
        $kategoriGaleri = KategoriGaleri::all();
        return view('landingpage.galeriindex', compact('galeri', 'kategoriGaleri'));
    }

    // kalender
    public function kalender()
    {
        $agenda = Agenda::with('jenisAgenda')->orderBy('tanggal_mulai', 'asc')->get();

        $events = $agenda->map(function ($item) {
            $event = [
                'title' => $item->judul,
                'start' => $item->tanggal_mulai,
            ];

            // Jika tanggal_selesai ada dan berbeda dari tanggal_mulai, tambahkan end
            if ($item->tanggal_akhir && $item->tanggal_mulai != $item->tanggal_akhir) {
                $event['end'] = \Carbon\Carbon::parse($item->tanggal_akhir)->addDay()->format('Y-m-d');
            }

            return $event;
        });

        return view('landingpage.kalender', compact('agenda', 'events'));
    }
	
	public function kepengurusan()
    {
        $kepengurusan = Kepengurusan::latest()->get();
        return view('landingpage.kepengurusanIndex', compact('kepengurusan'));
    }


    // tentang ponpes
    public function tentangponpes()
    {
        $tentang = Tentang::first();
        $beritaLain = Berita::latest()->take(5)->get();

        return view('landingpage.tentangdetail', compact('tentang', 'beritaLain'));
    }
}
