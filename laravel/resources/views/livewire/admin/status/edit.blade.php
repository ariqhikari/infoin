<div>
    <form wire:submit.prevent="updateStatus">
        <div class="form-group">
            <label class="section-title mt-0">Ubah Status</label>
            <input id="my-input" class="form-control @error("name") is-invalid @enderror" type="text" placeholder="nama" name="name" wire:model="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:-10px"><i class="fas fa-plus"></i> Ubah Status</button>
    </form>
</div>
