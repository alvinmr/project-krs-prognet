@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
          <div class="card-body">
                <h5 class="card-title">Mahasiswa Aktif</h5>
                <h6 class="card-subtitle mb-4 text-muted">Terdapat {{$mahasiswa}} mahasiswa yang aktif </h6>
                <h5 class="card-title">Dosen Aktif</h5>
                <h6 class="card-subtitle mb-2 text-muted">Terdapat {{$dosen}} dosen yang aktif </h6>
        </div>
    </div>
@endsection
