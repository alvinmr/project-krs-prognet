@extends('layouts.app')

@section('title', 'EDIT KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="tableKRSMahasiswa" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Status</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($krs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->matakuliah->kode}}</td>
                            <td>{{ $item->matakuliah->jumlah_sks}}</td>
                            <td>{{ $item->status}}</td>
                            <td>{{ $item->matakuliah->prodi->nama_prodi}}</td>
                            <td>
                                <form action="{{ route('pegawai.krs-store-delete', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ route('pegawai.krs-edit', $item->id) }}"
                                    class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <form action="{{ route('pegawai.krs-store-edit', $krs->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_mahasiswa">Mahasiswa ID</label>
                    <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                        id="nama_mahasiswa" placeholder="Nama Mahasiswa" name="nama_mahasiswa"
                        value="{{ old('nama_mahasiswa', $krs->mahasiswa->nama) }}">
                    @error('nama_mahasiswa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nim_mahasiswa">NIM Mahasiswa</label>
                    <input type="text" class="form-control @error('nim_mahasiswa') is-invalid @enderror"
                        id="nim_mahasiswa" placeholder="NIM Mahasiswa" name="nim_mahasiswa"
                        value="{{ old('nim_mahasiswa', $krs->mahasiswa->nim) }}">
                    @error('nim_mahasiswa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                        id="tahun_ajaran" placeholder="2021" name="tahun_ajaran"
                        value="{{ old('tahun_ajaran', $krs->tahun_ajaran) }}">
                    @error('nama_matakuliah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control @error('semester') is-invalid @enderror" id="semester">
                        <option disabled selected>--Pilih Semester--</option>
                        <option value="ganjil" {{ $krs->semester == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="genap" {{ $krs->semester == 'genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror"
                        placeholder="Contoh : 2" type="number"
                        value="{{ old('nilai', $krs->nilai) }}"></input>
                    @error('nilai')
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
