<div>
    <div class="row md-4 mb-4">
        <div class="col-md-2">
            <label for="">Tahun Ajaran</label>
            <select wire:model="byTahunAjaran" class="form-control">
                <option value="">Tahun Ajaran</option>
                @foreach ($tahun_ajaran as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
