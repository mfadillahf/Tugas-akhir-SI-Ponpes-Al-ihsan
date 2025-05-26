<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    //
    public function index()
    {
        $galeri = Galeri::orderBy('tanggal', 'desc')->get();
        return view('Sistem.Galeri', compact('galeri'));
    }

    public function create()
    {
        return view('Sistem.GaleriCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

        // Upload foto
        $file = $request->file('foto');
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/galeri', $filename);

        Galeri::create([
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('Sistem.GaleriEdit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

        $data = [
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ];

        // Jika ada file baru diupload
        if ($request->hasFile('foto')) {
            // Hapus file lama
            if ($galeri->foto && Storage::exists('public/galeri/' . $galeri->foto)) {
                Storage::delete('public/galeri/' . $galeri->foto);
            }

            $file = $request->file('foto');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/galeri', $filename);
            $data['foto'] = $filename;
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->foto && Storage::exists('public/galeri/' . $galeri->foto)) {
            Storage::delete('public/galeri/' . $galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    // Menampilkan detail galeri
    public function showDetail($id)
    {
        $galeri = Galeri::findOrFail($id);

        return response()->json([
            'deskripsi' => $galeri->deskripsi,
            'foto' => asset('storage/galeri/' . $galeri->foto),
            'tanggal' => \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y'),
        ]);
    }

}
