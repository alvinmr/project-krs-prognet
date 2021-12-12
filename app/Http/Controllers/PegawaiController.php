<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function showLogin()
    {
        return view('pages.pegawai.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('pegawai')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('pegawai/dashboard');
        }

        return back()->withErrors([
            'nip' => 'NIP atau Password yang kamu masukkan salah. Coba kembali!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('pegawai')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('pegawai.showLogin');
    }

    public function dashboard()
    {
        return view('pages.dashboard.index');
    }
}