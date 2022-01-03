@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.matakuliah.create') }}" class="btn btn-primary">Tambah Matakuliah</a>
        </div>
        <div class="card-body">
            <table id="tableDosen" class="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Matakuliah</th>
                        <th>Waktu</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama_matakuliah }}</td>
                            <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td>{{ $item->transaksi_krs()->whereStatus('disetujui')->count() }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary" href="{{ route('pegawai.input-nilai.show', $item->id) }}">
                                        Masukkan Nilai
                                    </a>
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
