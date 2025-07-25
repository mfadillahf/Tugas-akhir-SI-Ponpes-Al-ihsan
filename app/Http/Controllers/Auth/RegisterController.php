<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Santri;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showSantriForm()
    {
        return view('Auth.registerSantri');
    }

    public function showDonaturForm()
    {
        return view('Auth.registerDonatur');
    }

    public function registerSantri(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'nama_lengkap' => 'required',
            'nama_panggil' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan_asal' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'no_hp_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_ibu' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'id_jenis_user' => 3, // ID Role Santri
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('santri');

            Santri::create([
                'id_user' => $user->id_user,
                'id_kelas' => 11, // default kelas atau isi dari inputan kalau ada
				'id_tahun_ajaran' => 1, // default kelas atau isi dari inputan kalau ada
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggil' => $request->nama_panggil,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan_asal' => $request->pendidikan_asal,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();
			Log::error('Gagal register santri: ' . $e->getMessage());
    		return back()->with('error', 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi atau hubungi admin.');
        }
    }

    public function registerDonatur(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'nama' => 'required',
            'no_telepon' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'id_jenis_user' => 4, // ID Role Donatur
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
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
