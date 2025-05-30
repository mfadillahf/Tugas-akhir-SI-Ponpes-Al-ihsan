<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->paginate(10);
        return view('Guru.Guru', compact('guru'));
    }

    public function create()
    {
        return view('Guru.GuruCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'nama' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'email' => 'nullable|email|unique:gurus,email',
            'nip' => 'nullable|unique:gurus,nip',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'id_jenis_user' => 2, //  guru
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('guru');

            Guru::create([
                'id_user' => $user->id_user,
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'nip' => $request->nip,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menambahkan guru: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('Guru.GuruEdit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $guru->user->id_user . ',id_user',
            'password' => 'nullable|confirmed|min:6',
            'nama' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'email' => 'nullable|email|unique:gurus,email,' . $id . ',id_guru',
            'nip' => 'nullable|unique:gurus,nip,' . $id . ',id_guru',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::beginTransaction();

        try {
            $guru->user->update([
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : $guru->user->password,
            ]);

            $guru->update([
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'nip' => $request->nip,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Guru berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal update guru: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->user()->delete(); // cascade
            return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus guru: ' . $e->getMessage()]);
        }
    }

    // menampilkan detail guru
    public function showDetail($id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        return response()->json([
            'nama'     => $guru->nama,
            'no_telepon'       => $guru->no_telepon,
            'email'            => $guru->email,
            'nip'              => $guru->nip,
            'tanggal_lahir'    => $guru->tanggal_lahir,
            'jenis_kelamin'    => $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
        ]);
    }
}
