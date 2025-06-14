<?php

namespace App\Http\Controllers\Sistem;

use App\Models\Tentang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    public function index()
    {
        $tentang = Tentang::all();
        return view('sistem.tentang', compact('tentang'));
    }

    public function create()
    {
        return view('sistem.tentangcreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/tentang', $filename);
                $data['gambar'] = $filename;
                
            }

            Tentang::create($data);

            DB::commit();
            return redirect()->route('tentang.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit(Tentang $tentang)
    {
        return view('sistem.tentangedit', compact('tentang'));
    }

    public function update(Request $request, Tentang $tentang)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/tentang', $filename);
                $data['gambar'] = $filename;

                // hapus gambar lama
                if ($tentang->gambar && Storage::exists('public/tentang/' . $tentang->gambar)) {
                    Storage::delete('public/tentang/' . $tentang->gambar);
                }
            }

            $tentang->update($data);

            DB::commit();
            return redirect()->route('tentang.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroy(Tentang $tentang)
    {
        DB::beginTransaction();

        try {
            if ($tentang->gambar && Storage::exists('public/tentang/' . $tentang->gambar)) {
                Storage::delete('public/tentang/' . $tentang->gambar);
            }

            $tentang->delete();

            DB::commit();
            return back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
