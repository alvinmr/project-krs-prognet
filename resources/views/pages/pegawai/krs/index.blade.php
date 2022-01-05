@extends('layouts.app')

@section('title', 'Data KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="" method="GET">
                <div class="row md-2 mb-3">
                    <div class="col-md-2">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" onchange="this.form.submit()" class="form-control" id="tahun_ajaran_id" aria-label="Tahun Ajaran">
                            @foreach ($tahun_ajaran as $item)
                                <option value="{{$item->id}}" {{ request()->get('tahun_ajaran_id') == $item->id ? "checked" : "" }}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <table id="tableKRSMahasiswa" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->angkatan }}</td>
                            <td>{{ $item->prodi->nama_prodi }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-primary" ype="button" data-toggle="modal"
                                        data-target="#modal-krs{{ $loop->iteration }}">Lihat KRS</a>
                                </div>
                            </td>
                        </tr>
                        @push('modals')
                            <!-- Modal -->
                            <div class="modal fade " id="modal-krs{{ $loop->iteration }}" tabindex="0" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Data KRS {{ $item->nama }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body ">
                                            <div class="table-responsive">
                                                <table class="table table-hover ">
                                                    <thead>
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Kode</td>
                                                            <td>Nama Matakuliah</td>
                                                            <td>Semester</td>
                                                            <td>SKS</td>
                                                            <td>Status</td>
                                                            <td>Waktu</td>
                                                            <td>Dosen</td>
                                                            <td>Prodi</td>
                                                            <td>Aksi</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($item->transaksi_krs as $krs)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $krs->matakuliah->kode }}</td>
                                                                <td>{{ $krs->matakuliah->nama_matakuliah }}</td>
                                                                <td>{{ $krs->matakuliah->semester }}</td>
                                                                <td>{{ $krs->matakuliah->jumlah_sks }}</td>
                                                                <td>
                                                                    <span
                                                                        class="badge @if ($krs->status == 'disetujui') badge-success @elseif ($krs->status == 'ditolak') badge-danger @else badge-warning @endif">{{ $krs->status }}</span>
                                                                </td>
                                                                <td>{{ $krs->matakuliah->jam_mulai }} -
                                                                    {{ $krs->matakuliah->jam_selesai }}</td>
                                                                <td>{{ $krs->matakuliah->dosen->nama }}</td>
                                                                <td>{{ $krs->matakuliah->prodi->nama_prodi }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle"
                                                                            type="button" id="aksi_krs" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                            Aksi
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                                                            <form
                                                                                action="{{ route('pegawai.krs-approve', ['id' => $krs->id]) }}"
                                                                                id="setujui-krs{{ $krs->id }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <a href="#" class="dropdown-item text-success"
                                                                                    id="btn-terima-krs{{ $krs->id }}">Setujui</a>
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('pegawai.krs-decline', ['id' => $krs->id]) }}"
                                                                                id="hapus-krs{{ $krs->id }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <a href="#" class="dropdown-item text-danger"
                                                                                    id="btn-tolak-krs{{ $krs->id }}">Tolak</a>
                                                                            </form>
                                                                            <script>
                                                                                $('#btn-tolak-krs{{ $krs->id }}').on('click', function() {
                                                                                    Swal.fire({
                                                                                        title: 'Menolak ?',
                                                                                        text: 'Apakah anda yakin ingin menolak matakuliah pada krs mahasiswa {{ $item->nim }}  ini?',
                                                                                        icon: 'question',
                                                                                        showCancelButton: true,
                                                                                        confirmButtonText: 'Yakin'
                                                                                    }).then(res => {
                                                                                        if (res.isConfirmed) {
                                                                                            $('#hapus-krs{{ $krs->id }}').submit()
                                                                                        }
                                                                                    })
                                                                                })
                                                                                $('#btn-terima-krs{{ $krs->id }}').on('click', function() {
                                                                                    Swal.fire({
                                                                                        title: 'Menyetujui ?',
                                                                                        text: 'Apakah anda yakin ingin menyetujui matakuliah pada krs mahasiswa {{ $item->nim }}  ini?',
                                                                                        icon: 'question',
                                                                                        showCancelButton: true,
                                                                                        confirmButtonText: 'Yakin'
                                                                                    }).then(res => {
                                                                                        if (res.isConfirmed) {
                                                                                            $('#setujui-krs{{ $krs->id }}').submit()
                                                                                        }
                                                                                    })
                                                                                })
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="10">Data Kosong</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{ route('pegawai.krs-approve-all', $krs->mahasiswa->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Setujui Semua</button>
                                            </form>
                                            <form action="{{ route('pegawai.krs-decline-all', $krs->mahasiswa->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Tolak Semua</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endpush
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
