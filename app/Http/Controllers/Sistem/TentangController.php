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
        $tentang = Tentang::first();
        return view('sistem.tentang', compact('tentang'));
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

                // Hapus gambar lama
                if ($tentang->gambar && Storage::exists('public/tentang/' . $tentang->gambar)) {
                    Storage::delete('public/tentang/' . $tentang->gambar);
                }
            }

            $tentang->update($data);

            DB::commit();
            return redirect()->route('tentang.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }
}
