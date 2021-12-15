@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
        </div>
        <div class="card-body">
            <table id="tableMahasiswa" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Angkatan</th>
                        <th>Prodi</th>
                        <th>Foto Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->angkatan }}</td>
                            <td>{{ $item->prodi->nama_prodi }}</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('foto_mahasiswa/' . $item->foto_mahasiswa) }}"
                                    alt="{{ $item->foto_mahasiswa }}">
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="aksi_krs"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                        <a href="{{ route('pegawai.mahasiswa.edit', $item->id) }}"
                                            class="dropdown-item">Edit</a>
                                        <form action="{{ route('pegawai.mahasiswa.destroy', $item->id) }}" method="post"
                                            id="hapus-mahasiswa{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="dropdown-item text-danger"
                                                id="btn-hapus-mahasiswa{{ $item->id }}">Hapus</a>
                                        </form>
                                        @push('scripts')
                                            <script>
                                                $('#btn-hapus-mahasiswa{{ $item->id }}').on('click', function() {
                                                    Swal.fire({
                                                        title: 'Menyetujui ?',
                                                        text: 'Apakah anda yakin ingin data ini?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Yakin'
                                                    }).then(res => {
                                                        if (res.isConfirmed) {
                                                            $('#hapus-mahasiswa{{ $item->id }}').submit()
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMahasiswa').DataTable();
        });
    </script>
@endpush
