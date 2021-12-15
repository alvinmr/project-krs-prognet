@extends('layouts.app')

@section('title', 'Data KRS Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-body">
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
                                    <button class="btn btn-secondary dropdown-toggle"
                                        type="button" id="aksi_krs" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksi_krs">
                                        <a class="dropdown-item" ype="button" data-toggle="modal"
                                            data-target="#modal-krs{{ $loop->iteration }}">Lihat KRS</a>
                                        <form action="{{ route('pegawai.krs-store-delete', $item->id) }}" method="post">
                                            @csrf
                                            <a type="submit" class="dropdown-item text-danger">Hapus</a>
                                        </form>
                                    </div>
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
                                        <div class="modal-body">
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
                                                            <td>{{ $krs->status }}</td>
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
                                                                            <form action="{{ route('pegawai.krs-approve', ['id' => $krs->id]) }}" method="post"
                                                                                onsubmit="return confirm('Apakah Data ini ingin menyetujui matakuliah ini dalam KRS Mahasiswa NIM {{ $item->nim }}?')">
                                                                                @csrf
                                                                            <button type="submit" class="dropdown-item text-success">Setujui</button>
                                                                            </form>
                                                                            <form action="{{ route('pegawai.krs-decline', ['id' => $krs->id]) }}" method="post"
                                                                                onsubmit="return confirm('Apakah Data ini ingin menolak matakuliah ini dalam KRS Mahasiswa NIM {{ $item->nim }}?')">
                                                                                @csrf
                                                                            <button type="submit" class="dropdown-item text-danger">Tolak</button>
                                                                            </form>
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
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
