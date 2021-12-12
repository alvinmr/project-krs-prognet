@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="mb-3">
                    <label for="name" class="form-label">Kode Matakuliah</label>
                    <input type="text" class="form-control" id="kode" name="kode" value="{{ $listMataKuliahs->kode}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Matakuliah</label>
                    <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" value="{{ $listMataKuliahs->nama_matakuliah}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester" value="{{ $listMataKuliahs->semester}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Status Matakuliah</label>
                    <input type="text" class="form-control" id="status_matakuliah" name="status_matakuliah" value="{{ $listMataKuliahs->status_matakuliah}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Jam Mulai</label>
                    <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $listMataKuliahs->jam_mulai}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Jam Selesai</label>
                    <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $listMataKuliahs->jam_selesai}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Dosen</label>
                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $listMataKuliahs->dosen->nama}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Prodi</label>
                    <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="{{ $listMataKuliahs->prodi->nama_prodi}}" readonly>
                </div>
                <a type="button" class="btn btn-success" href="{{ route('mahasiswa.krs-create') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
