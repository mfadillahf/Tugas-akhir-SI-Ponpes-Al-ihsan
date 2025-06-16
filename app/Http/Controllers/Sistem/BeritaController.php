<?php

namespace App\Http\Controllers\Sistem;

use App\Models\User;
use App\Models\Berita;
use App\Models\JenisBerita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['user', 'jenisBerita'])->paginate(10);
        return view('sistem.berita', compact('berita'));
    }

    public function create()
    {
        $jenisBerita = JenisBerita::all();
        return view('sistem.beritacreate', compact('jenisBerita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_berita' => 'required|exists:jenis_beritas,id_jenis_berita',
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'id_user' => Auth::user()->id_user,
                'id_jenis_berita' => $request->id_jenis_berita,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
            ];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/berita', $filename);
                $data['foto'] = $filename;
            }

            Berita::create($data);

            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $jenisBerita = JenisBerita::all();
        return view('sistem.beritaedit', compact('berita', 'jenisBerita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis_berita' => 'required|exists:jenis_beritas,id_jenis_berita',
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        DB::beginTransaction();

        try {
            $data = [
                'id_user' => Auth::user()->id_user,
                'id_jenis_berita' => $request->id_jenis_berita,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
            ];

            if ($request->hasFile('foto')) {
                if ($berita->foto && Storage::exists('public/berita/' . $berita->foto)) {
                    Storage::delete('public/berita/' . $berita->foto);
                }

                $file = $request->file('foto');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/berita', $filename);
                $data['foto'] = $filename;
            }

            $berita->update($data);

            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($berita->foto && Storage::exists('public/berita/' . $berita->foto)) {
                Storage::delete('public/berita/' . $berita->foto);
            }

            $berita->delete();

            DB::commit();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function showDetail($id)
    {
        $berita = Berita::with(['user', 'jenisBerita'])->findOrFail($id);
        return response()->json([
            'judul' => $berita->judul,
            'isi' => $berita->isi,
            'kategori' => optional($berita->jenisBerita)->kategori,
            'tanggal' => \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y'),
            'foto' => asset('storage/berita/' . $berita->foto),
            'penulis' => optional($berita->user)->username,
        ]);
    }
}
