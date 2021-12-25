@extends('layouts.app')

@section('title', 'Data Tahun Ajaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.tahunajaran.create') }}" class="btn btn-primary">Tambah Tahun Ajaran</a>
        </div>
        <div class="card-body">
            <table id="tableTahunAjaran" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahunajaran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="aksi_tahunajaran"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_tahunajaran">
                                        <a href="{{ route('pegawai.tahunajaran.edit', $item->id) }}"
                                            class="dropdown-item">Edit</a>
                                        <form action="{{ route('pegawai.tahunajaran.destroy', $item->id) }}" method="post"
                                            id="hapus-tahunajaran{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="dropdown-item text-danger"
                                                id="btn-hapus-tahunajaran{{ $item->id }}">Hapus</a>
                                        </form>
                                        @push('scripts')
                                            <script>
                                                $('#btn-hapus-tahunajaran{{ $item->id }}').on('click', function() {
                                                    Swal.fire({
                                                        title: 'Menyetujui ?',
                                                        text: 'Apakah anda yakin ingin data ini?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Yakin'
                                                    }).then(res => {
                                                        if (res.isConfirmed) {
                                                            $('#hapus-tahunajaran{{ $item->id }}').submit()
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
            $('#tableTahunAjaran').DataTable();
        });
    </script>
@endpush