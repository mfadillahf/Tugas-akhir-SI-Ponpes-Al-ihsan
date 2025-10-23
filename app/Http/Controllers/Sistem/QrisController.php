<?php

namespace App\Http\Controllers\Sistem;

use App\Models\Tentang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QrisController extends Controller
{
    public function index()
    {
        // Ambil data QRIS (misalnya ID 2)
        $qris = Tentang::find(2);

        // Kalau belum ada, otomatis buat datanya
        if (!$qris) {
            $qris = Tentang::create([
                'judul' => 'QRIS Donasi',
                'deskripsi' => 'Gambar QRIS Donasi Pondok Pesantren',
                'gambar' => null,
            ]);
        }

        return view('sistem.qris', compact('qris'));
    }

    public function update(Request $request, Tentang $tentang)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
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
                $file->storeAs('public/qris', $filename);

                if ($tentang->gambar && Storage::exists('public/qris/' . $tentang->gambar)) {
                    Storage::delete('public/qris/' . $tentang->gambar);
                }

                $data['gambar'] = $filename;
            }

            $tentang->update($data);

            DB::commit();
            return redirect()->route('qris.index')->with('success', 'QRIS berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui QRIS: ' . $e->getMessage()]);
        }
    }
}
