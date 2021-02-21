<div>
    <label for="" class="section-title mt-2">Donation</label>
    <div class="card">
        <div class="card-header" >
            <h4 style="color: #797C7D">Buat Donation disini</h4>
        </div>
        <div class="card-body">
            <form action="{{ route("donation.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Donation</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("title") is-invalid @enderror" type="text" placeholder="title" name="title" value="{{ old("title") }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
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
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Minimal Donasi</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("min_dana") is-invalid @enderror" type="number" value="0" min="0" name="min_dana" value="{{ old("min_dana") }}">
                        @error('min_dana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Target Donasi</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("max_dana") is-invalid @enderror" type="number" value="0" min="0" name="max_dana" value="{{ old("max_dana") }}">
                        @error('max_dana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Batas Waktu</label>
                    <div class="col-sm-12 col-md-7">
                        <input id="my-input" class="form-control @error("donation_end") is-invalid @enderror" type="datetime-local" name="donation_end" value="{{ old("donation_end") }}">
                        @error('donation_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea id="content" name="content" class="form-control @error("content") is-invalid @enderror">{{ old("content") }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric @error("status_id") is-invalid @enderror" name="status_id">
                            <option selected disabled>Pilih status</option>
                            @foreach ($status as $item)
                                @if ($item->name != "Sampah" && $item->name != "Blacklist" )
                                    <option value="{{ $item->id }}" {{ old('status_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4 row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-pen-alt"></i> Buat Donation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>