<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (auth('mahasiswa')->check()) {
            return view('pages.mahasiswa.chat.index', compact('id'));
        } else {
            return view('pages.pegawai.chat.index', compact('id'));
        }
    }
}