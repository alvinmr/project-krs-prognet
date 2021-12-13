@extends('layouts.app')

@section('title', 'Membuat KRS')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mahasiswa.krs-index') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            @if (session('status'))
                <h6 class="alert alert-success alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </h6>
            @endif
            <div class="mb-3">
                <label for="search_matakuliah" class="form-label">Cari Matakuliah</label>
                <input type="text" class="form-control" id="searchMatkul" placeholder="Kode Matakuliah">
            </div>

            <table class="table" id="tableMahasiswa">
                <thead>
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Jumlah SKS</th>
                        <th scope="col">Jam-Mulai</th>
                        <th scope="col">Jam-Selesai</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMataKuliahs as $listMataKuliah)
                        <tr>
                            <td>{{ $listMataKuliah->kode }}</td>
                            <td>{{ $listMataKuliah->nama_matakuliah }}</td>
                            <td>{{ $listMataKuliah->semester }}</td>
                            <td>{{ $listMataKuliah->jumlah_sks }}</td>
                            <td>{{ $listMataKuliah->jam_mulai }}</td>
                            <td>{{ $listMataKuliah->jam_selesai }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mahasiswa.krs-detail', ['id' => $listMataKuliah->id]) }}"
                                        type="button" class="btn btn-success">Detail</a>
                                    <form action="{{ route('mahasiswa.krs-store', ['id' => $listMataKuliah->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Data ini ingin menambah Matakuliah ini kedalam KRS?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            visibility: hidden;
        }

    </style>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#tableMahasiswa').DataTable();
            $('#searchMatkul').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
