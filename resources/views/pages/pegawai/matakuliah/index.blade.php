@extends('layouts.app')

@section('title', 'Data Matakuliah')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.matakuliah.create') }}" class="btn btn-primary">Tambah Matakuliah</a>
        </div>
        <div class="card-body">
            <table id="tableDosen" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Matakuliah</th>
                        <th>Semester</th>
                        <th>Jumlah SKS</th>
                        <th>Status Matakuliah</th>
                        <th>Waktu</th>
                        <th>Dosen</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama_matakuliah }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->jumlah_sks }}</td>
                            <td>{{ $item->status_matakuliah }}</td>
                            <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td>{{ $item->dosen->nama }}</td>
                            <td>{{ $item->prodi->nama_prodi }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle"
                                        type="button" id="aksi_krs" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                        <a href="{{ route('pegawai.matakuliah.edit', $item->id) }}"
                                            class="dropdown-item">Edit</a>
                                        <form action="{{ route('pegawai.matakuliah.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
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
            $('#tableDosen').DataTable();
        });
    </script>
@endpush
