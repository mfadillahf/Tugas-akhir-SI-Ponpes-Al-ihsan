<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Infaq;
use App\Models\Santri;
use App\Models\Donatur;
use App\Models\Kepengurusan;
use Illuminate\Http\Request;
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
    $jumlahSantri = Santri::count();
    $jumlahGuru = Guru::count();
    $jumlahDonatur = Donatur::count();
    $jumlahPengurus = Kepengurusan::count();

    return view('dashboardadmin', compact(
        'jumlahSantri',
        'jumlahGuru',
        'jumlahDonatur',
        'jumlahPengurus'
    ));
}

    public function santriDashboard()
    {
        $this->authorizeRole('santri');

        $santri = Santri::where('id_user', Auth::id())->first();
        return view('dashboardsantri', compact('santri'));
    }

    public function guruDashboard()
    {
        $this->authorizeRole('guru');

        return view('dashboardguru');
    }

    public function donaturDashboard()
    {
        $this->authorizeRole('donatur');

        $donatur = Donatur::where('id_user', Auth::id())->first();
        $totalDonasi = $donatur ? Infaq::where('id_donatur', $donatur->id_donatur)->sum('nominal') : 0;

        return view('dashboarddonatur', compact('totalDonasi'));
    }

    // Helper: validasi role pakai Spatie
    protected function authorizeRole(string $role)
    {
        if (!Auth::user()->hasRole($role)) {
            abort(403, 'Akses ditolak.');
        }
    }
}
