<div>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="form-group">
            <label class="section-title mt-0">Nama User</label>
            @if (Auth::user()->role_id == 3)
                <select name="user_id" id="user_id" class="form-control @error("user_id") is-invalid @enderror" wire:model="user_id">
                <option selected>Pilih User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            @else
                <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
            @endif
        </div>
        <div class="form-group">
            <label class="section-title mt-0">Nama Bank</label>
            <select name="bank_id" id="bank_id" class="form-control @error("bank_id") is-invalid @enderror" wire:model="bank_id">
                <option selected>Pilih Bank</option>
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select>
            @error('bank_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="section-title mt-0">No Rekening</label>
            <input type="number" class="form-control @error("no_rekening") is-invalid @enderror" min="0" name="no_rekening" wire:model="no_rekening">
            @error('no_rekening')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="section-title mt-0">Nama Penerima / Rekening</label>
            <input type="text" class="form-control @error("nama_rekening") is-invalid @enderror" min="0" name="nama_rekening" wire:model="nama_rekening">
            @error('nama_rekening')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:-10px"><i class="fas fa-pen-alt"></i> Ubah User Bank</button>
    </form>
</div>
