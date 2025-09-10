<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Infaq;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Donatur;
use App\Models\Kepengurusan;
use Illuminate\Http\Request;
use App\Models\HapalanDetail;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->hasRole('santri')) {
            return redirect()->route('dashboard.santri');
        } elseif ($user->hasRole('guru')) {
            return redirect()->route('dashboard.guru');
        } elseif ($user->hasRole('donatur')) {
            return redirect()->route('dashboard.donatur');
        }

        abort(403, 'Anda tidak memiliki akses ke dashboard.');
    }

    public function adminDashboard()
    {
        $this->authorizeRole('admin');
        $jumlahSantri = Santri::count();
        $jumlahGuru = Guru::count();
        $jumlahDonatur = Donatur::count();
        $jumlahPengurus = Kepengurusan::count();
        $setting = Setting::first();

        return view('dashboardadmin', compact(
            'jumlahSantri',
            'jumlahGuru',
            'jumlahDonatur',
            'jumlahPengurus',
            'setting'
        ));
    }
    public function toggleLaporan(Request $request)
    {
        $setting = Setting::firstOrCreate([]);

        $field = $request->input('field');
        $setting->update([
            $field => !$setting->$field
        ]);

        return response()->json(['success' => true, 'value' => $setting->$field]);
    }

    public function santriDashboard()
    {
        $this->authorizeRole('santri');

        $santri = Santri::where('id_user', Auth::id())->first();

        // Rata-rata nilai
        $rataRataNilai = round(Nilai::where('id_santri', $santri->id_santri)->avg('nilai'), 2);

        // Ambil semua keterangan hapalan berdasarkan id_santri
        $keteranganList = HapalanDetail::whereIn('id_hapalan', function ($query) use ($santri) {
            $query->select('id_hapalan')
                ->from('hapalans')
                ->where('id_santri', $santri->id_santri);
        })->pluck('keterangan');

        // Ekstrak nama surah dari keterangan
        $surahList = [];
        foreach ($keteranganList as $keterangan) {
            if (preg_match('/surah\s+([a-zA-Z\-]+)/i', $keterangan, $match)) {
                $surahName = strtolower(trim($match[1]));
                $surahList[] = $surahName;
            }
        }

        $surahUnik = collect($surahList)->unique()->values();
        $jumlahSurah = $surahUnik->count();

    
        $mapelCounts = Nilai::with('mapel')
    ->where('id_santri', $santri->id_santri)
    ->get()
    ->pluck('mapel.nama_mapel')
    ->countBy();

        return view('dashboardsantri', compact(
            'santri',
            'rataRataNilai',
            'jumlahSurah',
            'mapelCounts',
        ));
    }

    public function guruDashboard()
    {
        $this->authorizeRole('guru');
        $jumlahSantri = Santri::count();
        $jumlahGuru = Guru::count();
        $jumlahDonatur = Donatur::count();
        $jumlahPengurus = Kepengurusan::count();

        return view('dashboardguru', compact(
            'jumlahSantri',
            'jumlahGuru',
            'jumlahDonatur',
            'jumlahPengurus'
        ));
    }

    public function donaturDashboard()
    {
        $this->authorizeRole('donatur');

        $donatur = Donatur::where('id_user', Auth::id())->first();
        $totalDonasi = $donatur ?
            Infaq::where('id_donatur', $donatur->id_donatur)
            ->where('status', 'paid')
            ->sum('nominal') : 0;

        // Donasi per bulan (12 bulan terakhir)
        $infaqPerBulan = Infaq::selectRaw('MONTH(created_at) as bulan, SUM(nominal) as total')
            ->where('id_donatur', $donatur->id_donatur)
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');


        // Inisialisasi 12 bulan
        $bulanLabels = [];
        $dataBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanLabels[] = \Carbon\Carbon::create()->month($i)->format('M');
            $dataBulan[] = $infaqPerBulan[$i] ?? 0;
        }

        // Hitung donasi bulan ini dan sebelumnya
        $bulanIni = now()->month;
        $totalBulanIni = $infaqPerBulan[$bulanIni] ?? 0;
        $totalBulanLalu = $infaqPerBulan[$bulanIni - 1] ?? 0;
        $persentaseKenaikan = $totalBulanLalu > 0
            ? round((($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100, 2)
            : ($totalBulanIni > 0 ? 100 : 0);

        return view('dashboarddonatur', compact(
            'totalDonasi',
            'bulanLabels',
            'dataBulan',
            'totalBulanIni',
            'persentaseKenaikan'
        ));
    }

    // Helper: validasi role pakai Spatie
    protected function authorizeRole(string $role)
    {
        if (!Auth::user()->hasRole($role)) {
            abort(403, 'Akses ditolak.');
        }
    }
}
