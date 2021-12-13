@extends('layouts.app')

@section('title', 'KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mahasiswa.krs-create') }}" class="btn btn-primary">Tambah KRS</a>
        </div>
        <div class="card-body">
                <table id="tableMataKuliah" class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Mata Kuliah</th>
                            <th scope="col">Nama Mata Kuliah</th>
                            <th scope="col">Dosen Pengampu</th>
                            <th scope="col">Jumlah SKS</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($listKRSs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->matakuliah->kode }}</td>
                                    <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                                    <td>{{ $item->matakuliah->dosen->nama }}</td>
                                    <td>{{ $item->matakuliah->jumlah_sks }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
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
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMataKuliah').DataTable();
        });
    </script>
@endpush
