<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
     public function edit()
    {
        if (user()->hasRole('santri')) {
            $profile = user()->santri;
            return view('profile.profilesantri', compact('profile'));
        }

        if (user()->hasRole('guru')) {
            $profile = user()->guru;
            return view('profile.profileguru', compact('profile'));
        }

        if (user()->hasRole('donatur')) {
            $profile = user()->donatur;
            return view('profile.profiledonatur', compact('profile'));
        }

        abort(403, 'Role tidak dikenali');
    }

    public function update(Request $request)
    {
        if (user()->hasRole('santri')) {
            $profile = user()->santri;

            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:50',
                'nama_panggil' => 'required|string|max:50',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string|max:255',
                'no_telepon' => 'nullable|string|max:14',
                'email' => 'nullable|email|max:50',
                'jenis_kelamin' => 'required|string|max:10',
                'pendidikan_asal' => 'required|string|max:50',
                'nama_ayah' => 'required|string|max:50',
                'pekerjaan_ayah' => 'required|string|max:30',
                'no_hp_ayah' => 'required|string|max:14',
                'nama_ibu' => 'required|string|max:50',
                'pekerjaan_ibu' => 'required|string|max:30',
                'no_hp_ibu' => 'required|string|max:14',
            ]);

            // Jaga agar email tetap tidak null
            $validated['email'] = $validated['email'] ?? $profile->email;

            DB::transaction(function () use ($profile, $validated) {
                $profile->update($validated);
            });

            return back()->with('success', 'Profil santri berhasil diperbarui.');
        }

        if (user()->hasRole('guru')) {
            $profile = user()->guru;

            $validated = $request->validate([
                'nama' => 'required|string|max:50',
                'no_telepon' => 'required|string|max:14',
                'email' => 'nullable|email|max:50',
                'nip' => 'nullable|string|max:20',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string|max:10',
            ]);

            $validated['email'] = $validated['email'] ?? $profile->email;

            DB::transaction(function () use ($profile, $validated) {
                $profile->update($validated);
            });

            return back()->with('success', 'Profil guru berhasil diperbarui.');
        }

        if (user()->hasRole('donatur')) {
            $profile = user()->donatur;

            $validated = $request->validate([
                'nama' => 'required|string|max:50',
                'alamat' => 'nullable|string|max:255',
                'no_telepon' => 'required|string|max:14',
                'email' => 'nullable|email|max:50',
            ]);

            $validated['email'] = $validated['email'] ?? $profile->email;

            DB::transaction(function () use ($profile, $validated) {
                $profile->update($validated);
            });

            return back()->with('success', 'Profil donatur berhasil diperbarui.');
        }

        abort(403, 'Role tidak dikenali');
    }
}
