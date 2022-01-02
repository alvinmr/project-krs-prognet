@extends('layouts.app')

@section('title', 'Nilai Matakuliah ' . $matakuliah->nama_matakuliah)

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pegawai.input-nilai.index') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <table id="tableInputNilai" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswaInMatakuliah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>
                                @livewire('pegawai.input-nilai' , ['transaksi_krs' => $item])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableInputNilai').DataTable();
        });
    </script>
@endpush
