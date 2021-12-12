@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode Mata Kuliah</th>
                            <th scope="col">Nama Kuliah</th>
                            <th scope="col">Dosen Pengampu</th>
                            <th scope="col">Jumlah SKS</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($listKRSs as $listKRS)
                                <tr>
                                    <td>{{$listKRS->matakuliah->kode}}</td>
                                    <td>{{$listKRS->matakuliah->nama_matakuliah}}</td>
                                    <td>{{$listKRS->matakuliah->dosen->nama_dosen}}</td>
                                    <td>{{$listKRS->matakuliah->semester}}</td>
                                    <td>{{$listKRS->status}}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route("mahasiswa.krs-edit")}}">Sunting KRS</a>
                                        <form action="{{ route('mahasiswa.krs-store-delete', ['id' => $listKRS->id]) }}" method="POST"
                                            onsubmit="return confirm('Apakah Data ini ingin Menghapus Matakuliah ini ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus KRS</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
        </div>
        <a class="btn btn-success" href="{{route("mahasiswa.krs-create")}}">Ajukan KRS</a>
    </div>
@endsection
