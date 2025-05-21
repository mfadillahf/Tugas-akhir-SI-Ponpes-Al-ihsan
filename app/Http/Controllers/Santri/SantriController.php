<?php

namespace App\Http\Controllers\Santri;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SantriController extends Controller
{
    public function index()
    {
        // $santri = Santri::with('kelas')->get();
        // return view('Santri.santri', compact('santri'));
        return view('Santri.santri');
    }

    public function create()
    {
        $users = User::all();
        $kelas = Kelas::all();
        return view('Santri.santricreate', compact('users', 'kelas'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_user' => 'required',
    //         'id_kelas' => 'required',
    //         'nama_lengkap' => 'required',
    //         'nama_panggil' => 'required',
    //         'tanggal_lahir' => 'required|date',
    //         'alamat' => 'required',
    //         'no_telepon' => 'nullable',
    //         'email' => 'nullable|email',
    //         'jenis_kelamin' => 'required|in:L,P',
    //         'pendidikan_asal' => 'required',
    //         'nama_ayah' => 'required',
    //         'pekerjaan_ayah' => 'required',
    //         'no_hp_ayah' => 'required',
    //         'nama_ibu' => 'required',
    //         'pekerjaan_ibu' => 'required',
    //         'no_hp_ibu' => 'required',
    //     ]);

    //     Santri::create([
    //         ...$request->all(),
    //         'status' => 'santri'
    //     ]);

    //     return redirect()->route('santri.santri')->with('success', 'Data santri berhasil ditambahkan.');
    // }

    // public function edit($id)
    // {
    //     $santri = Santri::findOrFail($id);
    //     $users = User::all();
    //     $kelas = Kelas::all();
    //     return view('Santri.edit', compact('santri', 'users', 'kelas'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $santri = Santri::findOrFail($id);

    //     $santri->update($request->all());

    //     return redirect()->route('santri.santri')->with('success', 'Data santri berhasil diupdate.');
    // }

    // public function destroy($id)
    // {
    //     $santri = Santri::findOrFail($id);
    //     $santri->delete();

    //     return redirect()->route('santri.santri')->with('success', 'Data santri berhasil dihapus.');
    // }
}
