@extends('layouts.app')

@section('title', 'Tambah Matakuliah')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.matakuliah.update', $matakuliah->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_matakuliah">Nama Matakuliah</label>
                    <input type="text" class="form-control @error('nama_matakuliah') is-invalid @enderror"
                        id="nama_matakuliah" placeholder="Contoh : Pemrograman Internet" name="nama_matakuliah"
                        value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}">
                    @error('nama_matakuliah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas">
                        <option disabled selected>--Pilih kelas--</option>
                        <option value="A" {{ $matakuliah->kelas == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $matakuliah->kelas == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $matakuliah->kelas == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $matakuliah->kelas == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah_sks">Jumlah SKS</label>
                    <input name="jumlah_sks" id="jumlah_sks" class="form-control @error('jumlah_sks') is-invalid @enderror"
                        placeholder="Contoh : 2" type="number"
                        value="{{ old('jumlah_sks', $matakuliah->jumlah_sks) }}"></input>
                    @error('jumlah_sks')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status_matakuliah">Status</label>
                    <select name="status_matakuliah" class="form-control @error('status_matakuliah') is-invalid @enderror"
                        id="status_matakuliah">
                        <option disabled selected>--Pilih Status Matkul--</option>
                        @foreach ($status_matakuliah as $item)
                            <option value="{{ $item }}"
                                {{ old('status_matakuliah', $matakuliah->status_matakuliah) == $item ? 'selected' : '' }}>
                                {{ $item }}</option>
                        @endforeach
                    </select>
                    @error('status_matakuliah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai"
                        placeholder="Contoh : 198507232020072001" name="jam_mulai"
                        value="{{ old('jam_mulai', $matakuliah->jam_mulai) }}">
                    @error('jam_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai"
                        placeholder="Contoh : 198507232020072001" name="jam_selesai"
                        value="{{ old('jam_selesai', $matakuliah->jam_selesai) }}">
                    @error('jam_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dosen">Dosen</label>
                    <select name="dosen" class="form-control @error('dosen') is-invalid @enderror" id="dosen">
                        <option disabled selected>--Pilih Dosen--</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}"
                                {{ old('dosen', $matakuliah->dosen_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('dosen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="program_studi">Program Studi</label>
                    <select name="program_studi" class="form-control @error('program_studi') is-invalid @enderror"
                        id="program_studi">
                        <option disabled selected>--Pilih Program Studi</option>
                        @foreach ($program_studi as $item)
                            <option value="{{ $item->id }}"
                                {{ old('program_studi', $matakuliah->prodi_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('program_studi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <select name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                        id="tahun_ajaran">
                        <option disabled selected>--Pilih Tahun Ajaran</option>
                        @foreach ($tahun_ajaran as $item)
                            <option value="{{ $item->id }}"
                                {{ old('tahun_ajaran', $matakuliah->tahun_ajaran_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('tahun_ajaran')
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
