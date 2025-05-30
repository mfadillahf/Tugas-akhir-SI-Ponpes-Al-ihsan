<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donatur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DonaturController extends Controller
{
    public function index()
    {
        $donatur = Donatur::with('user')->paginate(10);
        return view('Donatur.Donatur', compact('donatur'));
    }

    public function create()
    {
        return view('Donatur.DonaturCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'email' => 'nullable|email|unique:donaturs,email',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'id_jenis_user' => 3, //  donatur
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('donatur');

            Donatur::create([
                'id_user' => $user->id_user,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
            ]);

            DB::commit();
            return redirect()->route('donatur.index')->with('success', 'Donatur berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menambahkan donatur: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $donatur = Donatur::with('user')->findOrFail($id);
        return view('Donatur.DonaturEdit', compact('donatur'));
    }

    public function update(Request $request, $id)
    {
        $donatur = Donatur::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $donatur->user->id_user . ',id_user',
            'password' => 'nullable|confirmed|min:6',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'email' => 'nullable|email|unique:donaturs,email,' . $id . ',id_donatur',
        ]);

        DB::beginTransaction();

        try {
            $donatur->user->update([
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : $donatur->user->password,
            ]);

            $donatur->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'nip' => $request->nip,
            ]);

            DB::commit();
            return redirect()->route('donatur.index')->with('success', 'Donatur berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal update donatur: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $donatur = Donatur::findOrFail($id);
            $donatur->user()->delete(); // cascade
            return redirect()->route('donatur.index')->with('success', 'Donatur berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus donatur: ' . $e->getMessage()]);
        }
    }

    // menampilkan detail donatur
    public function showDetail($id)
    {
        $donatur = Donatur::with('user')->findOrFail($id);

        return response()->json([
            'nama'              => $donatur->nama,
            'alamat'            => $donatur->alamat,
            'no_telepon'        => $donatur->no_telepon,
            'email'             => $donatur->email,
        ]);
    }
}
