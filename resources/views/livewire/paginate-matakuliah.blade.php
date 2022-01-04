<div>
    <div class="d-flex align-items-center ml-4">
        <label for="paginate" class="text-nowrap mr-2 mb-0">Tahun Ajaran</label>
        <select class="form-control form-control-sh">
            <option value="">Tahun Ajaran</option>
            @foreach ($tahun_ajaran as $item)
                <option value="$item->id">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
</div>
