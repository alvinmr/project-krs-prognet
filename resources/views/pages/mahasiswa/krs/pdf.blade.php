@extends('layouts.pdf')

@section('title', 'KRS Mahasiswa')

@section('content')
            <table id="tableMataKuliah" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Mata Kuliah</th>
                        <th scope="col">Nama Mata Kuliah</th>
                        <th scope="col">Dosen Pengampu</th>
                        <th scope="col">Jumlah SKS</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listKRS as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->matakuliah->kode }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                            <td>{{ $item->matakuliah->dosen->nama }}</td>
                            <td>{{ $item->matakuliah->jumlah_sks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@endsection
