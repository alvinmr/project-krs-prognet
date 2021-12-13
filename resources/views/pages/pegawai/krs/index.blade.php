@extends('layouts.app')

@section('title', 'Data KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="tableKRSMahasiswa" class="table">
                <thead>
                    <tr>
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
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->matakuliah->kode}}</td>
                            <td>{{ $item->matakuliah->jumlah_sks}}</td>
                            <td>{{ $item->status}}</td>
                            <td>{{ $item->matakuliah->prodi->nama_prodi}}</td>
                            <td>
                                <form action="{{ route('pegawai.krs-store-delete', $item->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                @if ( $item->status != 'disetujui') 
                                <form action="{{ route('pegawai.krs-approve', $item->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                @endif
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
