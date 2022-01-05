<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
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
        // Ascending karena librarynya ngebaca dari kiri ke kanan
        $listTahunAjaran = TahunAjaran::orderBy('id', 'asc')->pluck('nama')->toArray();
        $listIpkPerSemester = auth()->user()->ipk;
        return view('pages.mahasiswa.dashboard.index', compact('listTahunAjaran'));
    }
}