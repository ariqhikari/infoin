<div>
    <label for="" class="section-title mt-2">Tulis Artikel</label>
    <div class="card">
        <div class="card-header" >
            <h4 style="color: #797C7D">Tulis artikelmu disini</h4>
        </div>
        <div class="card-body">
            <form action="{{ route("articles.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="title" class="form-control @error("title") is-invalid @enderror" value="{{ old("title") }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Min Read</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="number" name="min_read" class="form-control @error("min_read") is-invalid @enderror" value="{{ old("min_read") }}" min="0">
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
                                    @if (old("categori_id") == $item->id)
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
                        <textarea id="content" name="content" class="form-control @error("content") is-invalid @enderror">{{ old("content") }}</textarea>
                        @error('content')
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
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-pen-alt"></i> Buat Artikel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
@include('components.summernote')
@endsection