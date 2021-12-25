@extends('layouts.app')

@section('title', 'Tambah Data Tahun Ajaran')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.tahunajaran.update', $tahunajaran->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Tahun Ajaran</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                        id="nama" placeholder="Contoh : Tahun Ajaran 2020/2021" name="nama"
                        value="{{ old('nama', $tahunajaran->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-disabled" onclick="history.back()">Back</button>
            </form>
        </div>
    </div>
@endsection
