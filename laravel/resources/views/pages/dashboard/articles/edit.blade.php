<div>
    <label for="" class="section-title mt-2">Edit Artikel</label>
    <div class="card">
        <div class="card-header" >
            <h4 style="color: #797C7D">Edit {{ $articleEdit->title }} disini</h4>
        </div>
        <div class="card-body">
            <form action="{{ route("articles.update", $articleEdit) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="title" class="form-control @error("title") is-invalid @enderror" value="{{ $articleEdit->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Min Read</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="number" name="min_read" class="form-control @error("min_read") is-invalid @enderror" value="{{ $articleEdit->min_read }}" min="1">
                        @error('min_read')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric @error("categori_id") is-invalid @enderror" name="categori_id">
                            <option selected disabled>Pilih kategori</option>
                            @foreach ($categori as $item)
                                <option value="{{ $item->id }}" 
                                    @if ($articleEdit->categori_id == $item->id)
                                        selected
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('categori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konten</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea id="content" name="content" class="form-control @error("content") is-invalid @enderror">{{ $articleEdit->content }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                        <img src="{{ Storage::url($articleEdit->thumbnail) }}" class="img-thumbnail mb-3" alt="Thumbnail" width="50%">
                        <div class="alert alert-info" role="alert">
                            kosongkan jika tidak akan mengganti thumbnail
                        </div>
                        <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input @error("thumbnail") is-invalid @enderror" name="thumbnail" id="site-favicon">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <div class="form-text text-muted">ukuran gambar tidak lebih dari 2mb | format : png, jpg, jpeg</div>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric @error("status_id") is-invalid @enderror" name="status_id">
                            <option selected disabled>Pilih status artikel</option>
                            @foreach ($status as $item)
                                @if ($item->name != "Sampah" && $item->name != "Blacklist" )
                                    <option value="{{ $item->id }}" 
                                        @if ($articleEdit->status_id == $item->id)
                                            selected
                                        @endif
                                        >{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-pen-alt"></i> Edit Artikel</button>
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

@section('script')
@include('components.summernote')
@endsection