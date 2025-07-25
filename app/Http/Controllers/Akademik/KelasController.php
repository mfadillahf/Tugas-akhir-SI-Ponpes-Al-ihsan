<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
     public function index()
    {
        $kelas = Kelas::all();
        return view('Kelas.Kelas', compact('kelas'));
    }

    public function create()
    {
        return view('Kelas.kelascreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10|unique:kelas,nama_kelas',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas)
    {
        return view('Kelas.KelasEdit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10|unique:kelas,nama_kelas,' . $kelas->id_kelas . ',id_kelas',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate.');
    }

    public function destroy(Kelas $kelas)
    {
        try {
            $kelas->delete();
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus kelas: ' . $e->getMessage()]);
        }
    }
}
