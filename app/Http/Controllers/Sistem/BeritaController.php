<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBerita;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['user', 'jenisBerita'])->latest()->paginate(5);
        return view('sistem.berita', compact('berita'));
    }

    public function create()
    {
        $users = User::all();
        $jenisBeritas = JenisBerita::all();
        return view('sistem.beritacreate', compact('users', 'jenisBeritas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_jenis_berita' => 'required|exists:jenis_beritas,id_jenis_berita',
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $users = User::all();
        $jenisBeritas = JenisBerita::all();
        return view('berita.edit', compact('berita', 'users', 'jenisBeritas'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_jenis_berita' => 'required|exists:jenis_beritas,id_jenis_berita',
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
