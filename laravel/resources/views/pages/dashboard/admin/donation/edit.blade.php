<div>
    <label for="" class="section-title mt-2">Edit Donation</label>
    <div class="card">
        <div class="card-header" >
            <h4 style="color: #797C7D">Edit {{ $donationEdit->title }} disini</h4>
        </div>
        <div class="card-body">
            <form action="{{ route("donation.update", $donationEdit) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Donation</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("title") is-invalid @enderror" type="text" placeholder="title" name="title" value="{{ $donationEdit->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                        <img src="{{ Storage::url($donationEdit->thumbnail) }}" class="img-thumbnail mb-3" alt="Thumbnail" width="50%">
                        <div class="alert alert-info" role="alert">
                            kosongkan jika tidak akan mengganti thumbnail
                        </div>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input @error("thumbnail") is-invalid @enderror" name="thumbnail" id="site-favicon">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <div class="form-text text-muted">Ukuran gambar tidak lebih dari 2mb | format : png, jpg, jpeg, svg</div>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="categori_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori : </label>
                    <div class="col-sm-12 col-md-7">
                        <select name="categori_id[]" class="js-example-basic-multiple form-control @error('categori_id') is-invalid @enderror" multiple="multiple">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" 
                                >{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('categori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                         <div class="alert alert-info my-3" role="alert">
                            kosongkan jika tidak akan mengganti Categories
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Minimal Donasi</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("min_dana") is-invalid @enderror" type="number" min="0" name="min_dana" value="{{ $donationEdit->min_dana }}">
                        @error('min_dana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Target Donasi</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("max_dana") is-invalid @enderror" type="number" min="0" name="max_dana" value="{{ $donationEdit->max_dana }}">
                        @error('max_dana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Batas Waktu</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("donation_end") is-invalid @enderror" type="datetime-local" name="donation_end" value="{{ date('Y-m-d\TH:i', strtotime($donationEdit->donation_end)) }}">
                        @error('donation_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea id="content" name="content" class="form-control @error("content") is-invalid @enderror">{{ $donationEdit->content }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                    <div class="col-sm-12 col-md-7">
                        <select name="status_id" id="status_id" class="form-control @error("status_id") is-invalid @enderror">
                            <option selected>Pilih Status</option>
                            @foreach ($status as $item)
                                @if ($item->name != "Sampah" && $item->name != "Blacklist" )
                                <option value="{{ $item->id }}" 
                                    @if ($donationEdit->status_id == $item->id)
                                        selected
                                    @endif
                                    >{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    <div class="col-sm-12 col-md-7">
                </div>
                <div class="form-group row mb-4 mt-4">
                    <div class="col-sm-12 col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-pen-alt"></i> Edit Donation</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" wire:click="cancelEdit()" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>