<?php

namespace App\Http\Controllers\Sistem;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('tanggal', 'desc')->get();
        return view('sistem.galeri', compact('galeri'));
    }

    public function create()
    {
        $kategori = KategoriGaleri::all();
        return view('sistem.galericreate', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_galeri_id' => 'required|exists:kategori_galeris,id',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'kategori_galeri_id' => $request->kategori_galeri_id,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
            ];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/galeri', $filename);
                $data['foto'] = $filename;
            }

            Galeri::create($data);

            DB::commit();
            return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit(Galeri $galeri)
    {
        $kategori = KategoriGaleri::all();
        return view('sistem.galeriedit', compact('galeri', 'kategori'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'kategori_galeri_id' => 'required|exists:kategori_galeris,id',
            'deskripsi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'kategori_galeri_id' => $request->kategori_galeri_id,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
            ];

            if ($request->hasFile('foto')) {
                if ($galeri->foto && Storage::exists('public/galeri/' . $galeri->foto)) {
                    Storage::delete('public/galeri/' . $galeri->foto);
                }

                $file = $request->file('foto');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/galeri', $filename);
                $data['foto'] = $filename;
            }

            $galeri->update($data);

            DB::commit();
            return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroy(Galeri $galeri)
    {
        DB::beginTransaction();

        try {
            if ($galeri->foto && Storage::exists('public/galeri/' . $galeri->foto)) {
                Storage::delete('public/galeri/' . $galeri->foto);
            }

            $galeri->delete();

            DB::commit();
            return back()->with('success', 'Galeri berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function showDetail($id)
    {
        $galeri = Galeri::findOrFail($id);

        return response()->json([
            'deskripsi' => $galeri->deskripsi,
            'foto' => asset('storage/app/public/galeri/' . $galeri->foto),
            'tanggal' => \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y'),
        ]);
    }
}
