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
        // Hardcode ID khusus record QRIS
        $qris = Tentang::findOrFail(5);
        return view('sistem.qris', compact('qris'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $qris = Tentang::findOrFail(5); // ambil record id=2

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/tentang', $filename);

                // Hapus gambar lama
                if ($qris->gambar && Storage::exists('public/tentang/' . $qris->gambar)) {
                    Storage::delete('public/tentang/' . $qris->gambar);
                }

                $qris->update(['gambar' => $filename]);
            }

            DB::commit();
            return redirect()->route('qris.index')->with('success', 'QRIS berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui QRIS: ' . $e->getMessage()]);
        }
    }
}
