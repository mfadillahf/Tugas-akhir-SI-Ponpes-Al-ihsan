<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\Kepengurusan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();
        $galeri = Galeri::latest()->take(6)->get();
        $kepengurusan = Kepengurusan::latest()->get();
        $tentang = Tentang::latest()->first();
        
        return view('landingpage.landingpage', 
        compact('berita', 'galeri', 'kepengurusan', 'tentang'));
    }

    // berita detail
    public function showDetail($id)
    {
        $berita = Berita::findOrFail($id); 
        $beritaLain = Berita::where('id_berita', '!=', $id)->latest()->take(5)->get();
        return view('landingpage.beritadetail', compact('berita', 'beritaLain'));
    }
}
