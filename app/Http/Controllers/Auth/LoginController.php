<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLogin(){
    $pageConfigs = ['myLayout' => 'blank'];
    return view('Auth.login', compact('pageConfigs'));
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::with('jenisUser')->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah');
        }

        // Laravel Auth
        Auth::login($user); // 

        // role Spatie
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->hasRole('santri')) {
            return redirect()->route('dashboard.santri');
        } elseif ($user->hasRole('guru')) {
            return redirect()->route('dashboard.guru');
        } elseif ($user->hasRole('donatur')) {
            return redirect()->route('dashboard.donatur');
        } else {
            return redirect()->route('login')->with('error', 'User Tidak Terdaftar');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
