@extends('layouts.app')

@section('title', 'KHS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mahasiswa.khs-print') }}" class="btn btn-primary">
                Cetak KHS
            </a>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row md-2 mb-3">
                    <div class="col-md-2">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" onchange="this.form.submit()" class="form-control"
                            id="tahun_ajaran_id" aria-label="Tahun Ajaran">
                            @foreach ($tahun_ajaran as $item)
                                @if (request()->get('tahun_ajaran_id'))
                                    <option value="{{ $item->id }}"
                                        {{ request()->get('tahun_ajaran_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @else
                                    <option value="{{ $item->id }}"
                                        {{ auth('mahasiswa')->user()->getLastTahunAjaran() == $item->id
                                            ? 'selected'
                                            : '' }}>
                                        {{ $item->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <table>
                <tr class="font-weight-bold h6">
                    <td class="pr-5">IP Semester</td>
                    <td>{{ auth('mahasiswa')->user()->getIps(request()->get('tahun_ajaran_id') ?? null) }}</td>
                </tr>
                <tr class="font-weight-bold h6">
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
                    @foreach ($khs as $item)
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
