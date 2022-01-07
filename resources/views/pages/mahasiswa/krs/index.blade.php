@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mahasiswa.krs-create') }}" class="btn btn-primary">Tambah KRS</a>
        </div>
        <div class="card-body">
            <form action="" method="GET">
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
                            <td>
                                <span class="badge @if ($item->status == 'disetujui') badge-success @elseif ($item->status == 'ditolak') badge-danger @else badge-warning @endif">{{ $item->status }}</span>
                            </td>
                            @if ($item->tahun_ajaran_id ==
        auth('mahasiswa')->user()->getLastTahunAjaran())
                                <td>
                                    <form action="{{ route('mahasiswa.krs-store-delete', ['id' => $item->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Data ini ingin Menghapus Matakuliah ini ?')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus KRS</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <a href="#" class="btn btn-primary">List Mahasiswa</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMataKuliah').DataTable();
        });
    </script>
@endpush
