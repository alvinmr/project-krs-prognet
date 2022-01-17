@extends('layouts.pdf')

@section('title', 'KRS Mahasiswa')

@section('header')
    <h1> KARTU HASIL STUDI </h1>
    <hr size="4" width="90%" color="black">
@endsection


@section('content')
    <div class="data_mahasiswa">
        <div class="alignMe">
            <b>Nama</b> {{ auth('mahasiswa')->user()->nama }} <br>
            <b>NIM</b> {{ auth('mahasiswa')->user()->nim }} <br>
            <br>
        </div>
    </div>

    <table id="tableMataKuliah" width="90%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Nilai Huruf</th>
                <th>Nilai Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khs as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->matakuliah->kode }}</td>
                    <td scope="row">{{ $item->matakuliah->nama_matakuliah }}</td>
                    <td scope="row">{{ $item->matakuliah->jumlah_sks }}</td>
                    <td scope="row">{{ $item->nilai }}</td>
                    <td scope="row">
                        @php
                            if ($item->nilai == 'A') {
                                echo $item->matakuliah->jumlah_sks * 4.0;
                            } elseif ($item->nilai == 'B+') {
                                echo $item->matakuliah->jumlah_sks * 3.5;
                            } elseif ($item->nilai == 'B') {
                                echo $item->matakuliah->jumlah_sks * 3.0;
                            } elseif ($item->nilai == 'C+') {
                                echo $item->matakuliah->jumlah_sks * 2.5;
                            } elseif ($item->nilai == 'C') {
                                echo $item->matakuliah->jumlah_sks * 2.0;
                            } elseif ($item->nilai == 'D+') {
                                echo $item->matakuliah->jumlah_sks * 1.5;
                            } elseif ($item->nilai == 'D') {
                                echo $item->matakuliah->jumlah_sks * 1.0;
                            } elseif ($item->nilai == 'E') {
                                echo $item->matakuliah->jumlah_sks * 0;
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td class="gray">IP Semester </td>
                <td class="gray">{{ auth('mahasiswa')->user()->getIps() }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td class="gray">IP Kumulatif </td>
                <td class="gray">{{ auth('mahasiswa')->user()->ipk }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td class="gray">Maksimum Kredit (SKS) </td>
                <td class="gray">{{ $jumlahSks }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="tanggal">
        <b>Jimbaran, </b>
        <br>
        <br>
        <br>
        <br>
        <br>
        <b>I Nyoman Piarsa, ST., MT.</b>
    </div>

@endsection
