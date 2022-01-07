@extends('layouts.app')

@section('title', 'List Mahasiswa Matakuliah : ' . $matakuliah->nama_matakuliah)

@section('content')
    <div class="card">
        <div class="card-header">
            <button onclick="history.back()" class="btn btn-primary">Kembali</button>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead class="font-weight-bold">
                    <td>No</td>
                    <td>Nama Mahasiswa</td>
                    <td>NIM</td>
                    <td>No Telpon</td>
                </thead>

                <tbody>
                    @foreach ($list_mahasiswa as $item)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->mahasiswa->nama }}</td>
                        <td>{{ $item->mahasiswa->nim }}</td>
                        <td>{{ $item->mahasiswa->telepon }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
