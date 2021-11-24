<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function showLogin()
    {
        return view('pages.pegawai.login.index');
    }

    public function login(Request $request)
    {
        # code...
    }

    public function logout()
    {
        # code...
    }
}