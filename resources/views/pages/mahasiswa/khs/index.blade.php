@extends('layouts.app')

@section('title', 'KHS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Info Indeks Prestasi</h4>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td class="mr-3">IP Semester</td>
                    <td>{{ auth('mahasiswa')->user()->getIps() }}</td>
                </tr>
                <tr>
                    <td>IP Kumulatif</td>
                    <td>{{ auth('mahasiswa')->user()->ipk }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="tableMataKuliah" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Mata Kuliah</th>
                        <th scope="col">Nama Mata Kuliah</th>
                        <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth('mahasiswa')->user()->transaksi_krs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->matakuliah->kode }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                            <td>{{ $item->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
