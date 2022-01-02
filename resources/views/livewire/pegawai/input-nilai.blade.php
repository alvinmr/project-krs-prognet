<div>
    <select class="form-control" wire:model="nilai" wire:change="storeNilai({{ $transaksi_krs->id }})">
        @foreach ($dataNilai as $data)
            <option value="{{ $data }}">
                {{ $data }}</option>
        @endforeach
    </select>
</div>
