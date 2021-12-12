@extends('layouts.app')

@section('title', 'Membuat KRS')

@section('content')


    <div class="card">
        <div class="card-body">
            @if (session('status'))
                <h6 class="alert alert-success alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </h6>
            @endif
            <div class="mb-3">
                <label for="search_matakuliah" class="form-label">Cari Matakuliah</label>
                <input type="text" class="form-control" id="search_matakuliah" placeholder="Kode Matakuliah">
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col">Matakuliah</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Jam-Mulai</th>
                        <th scope="col">Jam-Selesai</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMataKuliahs as $listMataKuliah)
                        <tr>
                            <td>{{$listMataKuliah->kode}}</td>
                            <td>{{$listMataKuliah->nama_matakuliah}}</td>
                            <td>{{$listMataKuliah->semester}}</td>
                            <td>{{$listMataKuliah->jam_mulai}}</td>
                            <td>{{$listMataKuliah->jam_selesai}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed style example">
                                    <a href="{{ route('mahasiswa.krs-detail', ['id' => $listMataKuliah->id]) }}" type="button"
                                        class="btn btn-success">Detail</a>
                                    <form action="{{ route('mahasiswa.krs-store', ['id' => $listMataKuliah->id]) }}" method="POST"
                                        onsubmit="return confirm('Apakah Data ini ingin menambah Matakuliah ini kedalam KRS?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                    <a href="{{ route('mahasiswa.krs-index') }}" type="button"
                        class="btn btn-success">Kembali</a>
        </div>
    </div>

    <script type="text/javascript">
        $('#search').on('keyup',function()
        {
            $value=$(this).val();
            $.ajax(
            {
                type    : 'get',
                url     : '{{URL::to('search')}}',
                data    : {'search':$value},
                success : function(data){$('tbody').html(data);}
            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}'} });
    </script>
@endsection
