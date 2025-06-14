<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\Kepengurusan;
use Illuminate\Http\Request;
use App\Models\KategoriGaleri;

class LandingPageController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->take(4)->get();
        $galeri = Galeri::latest()->take(4)->get();
        $kategoriGaleri = KategoriGaleri::with('galeris')->get();
        $kepengurusan = Kepengurusan::latest()->get();
        $tentang = Tentang::latest()->first();
        
        return view('landingpage.landingpage', 
        compact('berita', 'galeri', 'kepengurusan', 'tentang','kategoriGaleri'));
    }

    // berita detail
    public function showDetail($id)
    {
        $berita = Berita::findOrFail($id); 
        $beritaLain = Berita::where('id_berita', '!=', $id)->latest()->take(5)->get();
        return view('landingpage.beritadetail', compact('berita', 'beritaLain'));
    }

    // Galeri All
    public function galeri()
{
    $galeri = Galeri::latest()->get(); 
    $kategoriGaleri = KategoriGaleri::all(); 
    return view('LandingPage.GaleriIndex', compact('galeri', 'kategoriGaleri'));
}
}
