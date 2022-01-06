<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Dosen;
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
        $mahasiswa = Mahasiswa::where('status_mahasiswa', 1)->get()->count();
        $dosen = Dosen::where('status_dosen', 1)->get()->count();
        return view('pages.pegawai.dashboard.index', compact('mahasiswa', 'dosen'));
    }
}
