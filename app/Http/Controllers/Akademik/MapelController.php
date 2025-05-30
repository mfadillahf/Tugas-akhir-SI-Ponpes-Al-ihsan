<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Models\Guru;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::with('guru')->paginate(10);
        $guru = Mapel::select('id_guru')->distinct()->get();
        return view('Mapel.mapel',compact('mapel'));
    }
    public function create()
    {
        $guru = Guru::all();
        return view('Mapel.MapelCreate', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:gurus,id_guru',
            'mapel' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Mapel::create($request->all());

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $guru = Guru::all();
        return view('Mapel.MapelEdit', compact('mapel', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_guru' => 'required|exists:gurus,id_guru',
            'mapel' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }

    // menampilkan detail Mapel
    public function showDetail($id)
    {
        $mapel = Mapel::with('guru')->findOrFail($id);

        return response()->json([
            'mapel'     => $mapel->mapel,
            'guru'      => [
                'nama' => optional($mapel->guru)->nama,
            ],
            'deskripsi' => $mapel->deskripsi,
        ]);
    }
}
