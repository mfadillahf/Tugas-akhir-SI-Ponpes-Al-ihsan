<?php

namespace App\Http\Controllers\Sistem;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();

        if (!$kontak) {
            $kontak = Kontak::create([
                'tiktok'    => null,
                'facebook'  => null,
                'instagram' => null,
                'whatsapp'  => null,
                'email'     => null,
                'youtube'   => null,
            ]);
        }

        return view('sistem.kontak', compact('kontak'));
    }

    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'tiktok'    => 'nullable|url',
            'facebook'  => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp'  => 'nullable|string|max:20',
            'email'     => 'nullable|email',
            'youtube'   => 'nullable|url',
        ]);

        DB::beginTransaction();

        try {
            $kontak->update([
                'tiktok'    => $request->tiktok,
                'facebook'  => $request->facebook,
                'instagram' => $request->instagram,
                'whatsapp'  => $request->whatsapp,
                'email'     => $request->email,
                'youtube'   => $request->youtube,
            ]);

            DB::commit();
            return redirect()->route('kontak.index')->with('success', 'Kontak berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui kontak: ' . $e->getMessage()]);
        }
    }
}
