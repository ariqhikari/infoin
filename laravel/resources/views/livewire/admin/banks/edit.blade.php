<div>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="form-group">
            <label class="section-title mt-0">Nama Bank</label>
            <input id="my-input" class="form-control @error("name") is-invalid @enderror" type="text" placeholder="nama" name="name" wire:model="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="section-title mt-0">Logo</label>
            <div class="custom-file">
                <input type="file" name="logo" class="custom-file-input @error("logo") is-invalid @enderror" name="logo" id="site-favicon"  wire:model="logo">
                <label class="custom-file-label">Pilih File</label>
            </div>
            <div class="form-text text-muted">Ukuran gambar tidak lebih dari 2mb | format : png, jpg, jpeg, svg</div>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="margin-top:-10px"><i class="fas fa-pen-alt"></i> Ubah Bank</button>
    </form>
</div>
