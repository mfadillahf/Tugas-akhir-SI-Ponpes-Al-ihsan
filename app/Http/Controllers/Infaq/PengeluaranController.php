<?php

namespace App\Http\Controllers\Infaq;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.pengeluaran', compact('pengeluaran'));
    }

    public function create()
    {
        return view('pengeluaran.pengeluarancreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|integer',
            'keterangan' => 'nullable|string|max:50',
        ]);

        Pengeluaran::create([
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.pengeluaranedit', compact('pengeluaran'));
    }

    public function update(Request $request, pengeluaran $pengeluaran)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|integer',
            'keterangan' => 'required|string|max:50',
        ]);

        $pengeluaran->update([
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diupdate.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        try {
            $pengeluaran->delete();
            return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus pengeluaran: ' . $e->getMessage()]);
        }
    }
}
