<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kepengurusan;
use App\Models\Santri;
use App\Models\Donatur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
    $jumlahSantri = Santri::count();
    $jumlahGuru = Guru::count();
    $jumlahDonatur = Donatur::count();
    $jumlahPengurus = Kepengurusan::count();

    return view('DashboardAdmin', compact('jumlahSantri', 'jumlahGuru', 'jumlahDonatur', 'jumlahPengurus'));
    }
}
