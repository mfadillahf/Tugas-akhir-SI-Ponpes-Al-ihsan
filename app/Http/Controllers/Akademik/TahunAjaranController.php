<?php

namespace App\Http\Controllers\Akademik;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahunAjaranController extends Controller
{
     public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return view('tahunajaran.tahunajaran', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('tahunajaran.tahunajarancreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahunajaran.tahunajaranedit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:10' . $tahunAjaran->id_tahun_ajaran . ',id_tahun_ajaran',
        ]);

        $tahunAjaran->update([
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil diupdate.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        try {
            $tahunAjaran->delete();
            return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus tahun ajaran: ' . $e->getMessage()]);
        }
    }
}
