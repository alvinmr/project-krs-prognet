@extends('layouts.pdf')

@section('title', 'KRS Mahasiswa')

@section('header')
    <h1> PENGAJUAN KRS MAHASISWA </h1>
    <hr size="4" width="90%" color="black">
@endsection


@section('content')
    <div class="data_mahasiswa">
        @foreach ($data_mahasiswa as $item)
            @if ($item->id == $mahasiswas)
                <div class="alignMe">
                    <b>Nama</b> {{ $item->nama }} <br>
                    <b>NIM</b> {{ $item->nim }} <br>
        <br>
                </div>
            @endif
    </div>
    @endforeach

    <table id="tableMataKuliah" width="90%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Matakuliah</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listKRS as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->matakuliah->kode }}</td>
                    <td scope="row">{{ $item->matakuliah->nama_matakuliah }}</td>
                    <td scope="row">{{ $item->matakuliah->kelas }}</td>
                    <td scope="row">{{ $item->status }}</td>
                    <td scope="row">{{ $item->matakuliah->jumlah_sks }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td class="gray">Total SKS</td>
                <td class="gray">{{ $total_sks }}</td>
            </tr>
        </tfoot>
    </table>

    @foreach ($data_mahasiswa as $item)
        @if ($item->id == $mahasiswas)
            <div class="tanggal">
                <b>Jimbaran, </b>
                <br>
                <br>
                <br>
                <br>
                <br>
                <b>I Nyoman Piarsa, ST., MT.</b>
                {{-- <b>{{ $item->nama }}, {{ $item->nim }}</b> --}}
            </div>
        @endif
    @endforeach

@endsection
