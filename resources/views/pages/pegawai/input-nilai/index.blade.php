@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="" method="GET">
                <div class="row md-2 mb-3">
                    <div class="col-md-2">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" onchange="this.form.submit()" class="form-control"
                            id="tahun_ajaran_id" aria-label="Tahun Ajaran">
                            @foreach ($tahun_ajaran as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->get('tahun_ajaran_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <table id="tableDosen" class="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Matakuliah</th>
                        <th>Waktu</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama_matakuliah }}</td>
                            <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td>{{ $item->transaksi_krs()->whereStatus('disetujui')->count() }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary" href="{{ route('pegawai.input-nilai.show', $item->id) }}">
                                        Masukkan Nilai
                                    </a>
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
