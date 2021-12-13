@extends('layouts.app')

@section('title', 'Data KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.krs-create') }}" class="btn btn-primary">Tambah KRS Mahasiswa</a>
        </div>
        <div class="card-body">
            <table id="tableKRSMahasiswa" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Status</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listKRSs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->matakuliah->kode}}</td>
                            <td>{{ $item->matakuliah->jumlah_sks}}</td>
                            <td>{{ $item->status}}</td>
                            <td>{{ $item->matakuliah->prodi->nama_prodi}}</td>
                            <td>
                                <form action="{{ route('pegawai.krs-store-delete', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ route('pegawai.mahasiswa.edit', $item->id) }}"
                                    class="btn btn-warning">Edit</a>
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
            $('#tableKRSMahasiswa').DataTable();
        });
    </script>
@endpush
