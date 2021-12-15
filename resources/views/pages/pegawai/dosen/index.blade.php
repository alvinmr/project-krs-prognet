@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.dosen.create') }}" class="btn btn-primary">Tambah Dosen</a>
        </div>
        <div class="card-body">
            <table id="tableDosen" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telpon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="aksi_krs"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                        <a href="{{ route('pegawai.dosen.edit', $item->id) }}"
                                            class="dropdown-item">Edit</a>
                                        <form action="{{ route('pegawai.dosen.destroy', $item->id) }}"
                                            id="hapus-dosen{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="dropdown-item text-danger"
                                                id="btn-hapus-dosen{{ $item->id }}">Hapus</a>
                                        </form>
                                        @push('scripts')
                                            <script>
                                                $('#btn-hapus-dosen{{ $item->id }}').on('click', function() {
                                                    Swal.fire({
                                                        title: 'Yakin ?',
                                                        text: 'Apakah anda yakin ingin menghapus data ini?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Yakin'
                                                    }).then(res => {
                                                        if (res.isConfirmed) {
                                                            $('#hapus-dosen{{ $item->id }}').submit()
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
            $('#tableDosen').DataTable();

        });
    </script>
@endpush
