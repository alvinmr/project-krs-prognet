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
                        <th scope="col">Aksi</th>
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
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="aksi_krs"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                        <a href="{{ route('mahasiswa.krs-detail', ['id' => $listMataKuliah->id]) }}"
                                            type="button" class="dropdown-item">Detail</a>
                                        <form action="{{ route('mahasiswa.krs-store', ['id' => $listMataKuliah->id]) }}"
                                            method="POST" id="tambah-krs{{ $listMataKuliah->id }}">
                                            @csrf
                                            <a href="#" class="dropdown-item text-success"
                                                id="btn-tambah-krs{{ $listMataKuliah->id }}">Tambah</a>
                                        </form>
                                        @push('scripts')
                                            <script>
                                                $('#btn-tambah-krs{{ $listMataKuliah->id }}').on('click', function() {
                                                    Swal.fire({
                                                        title: 'Yakin ?',
                                                        text: 'Apakah anda yakin ingin menambahkan matakuliah ini ke dalam KRS?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Yakin'
                                                    }).then(res => {
                                                        if (res.isConfirmed) {
                                                            $('#tambah-krs{{ $listMataKuliah->id }}').submit()
                                                        }
                                                    })
                                                })
                                            </script>
                                        @endpush
                                    </div>
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
