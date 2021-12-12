@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.dosen.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                        placeholder="Contoh : 198507232020072001" name="nip" value="{{ old('nip') }}">
                    @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        placeholder="Contoh : Alvin Maulana Rhusuli" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" cols="30"
                        rows="10" placeholder="Contoh : AlvinTheRainmaster@gmail.com" type="email"
                        value="{{ old('email') }}"></input>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                        placeholder="Contoh : 089670455567" name="telepon" value="{{ old('telepon') }}">
                    @error('telepon')
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
