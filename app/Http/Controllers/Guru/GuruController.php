<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;

class GuruController extends Controller
{
        public function index()
    {
        // $guru = Guru::with('user')->get();
        return view('Guru.Guru');
    }

    public function create() {
        $users = User::role('guru')->get();
        return view('admin.guru.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email',
            'nip' => 'nullable',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $users = User::role('guru')->get();
        return view('Guru.GuruEdit', compact('guru', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email',
            'nip' => 'nullable',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diupdate.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
