@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.mahasiswa.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30"
                        rows="10" placeholder="Contoh : Jl. Kudu Sari">{{ old('alamat') }}</textarea>
                    @error('alamat')
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
                <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <select name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan">
                        <option disabled selected>--Pilih Angkatan--</option>
                        @foreach ($angkatans as $item)
                            <option value="{{ $item }}" {{ old('angkatan') == $item ? 'selected' : '' }}>
                                {{ $item }}</option>
                        @endforeach
                    </select>
                    @error('angkatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control @error('prodi') is-invalid @enderror" id="prodi">
                        <option disabled selected>--Pilih Program Studi--</option>
                        @foreach ($prodis as $item)
                            <option value="{{ $item->id }}" {{ old('prodi') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('prodi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unggahFoto">Unggah Foto Mahasiswa</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="foto_mahasiswa"
                                class="custom-file-input @error('foto_mahasiswa') is-invalid @enderror" id="unggahFoto"
                                aria-describedby="unggahFoto">
                            <label class="custom-file-label" for="unggahFoto">Choose file</label>
                        </div>
                    </div>
                    @error('foto_mahasiswa')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-disabled" onclick="history.back()">Back</button>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $('#unggahFoto').on('change', function(e) {
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endpush
