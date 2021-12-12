<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function showLogin()
    {
        return view('pages.mahasiswa.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('mahasiswa/dashboard');
        }

        return back()->withErrors([
            'nim' => 'NIM atau Password yang kamu masukkan salah. Coba kembali!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.showLogin');
    }

    public function dashboard()
    {
        return view('pages.dashboard.index');
    }
}
