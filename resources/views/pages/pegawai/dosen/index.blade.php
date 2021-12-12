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
                                <form action="{{ route('pegawai.dosen.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ route('pegawai.dosen.edit', $item->id) }}"
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
            $('#tableDosen').DataTable();
        });
    </script>
@endpush