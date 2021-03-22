<div>
    <label for="" class="section-title mt-0">Adakan Event</label>
    <p class="section-lead">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum quaerat obcaecati distinctio dicta? Enim,
    </p>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="">Name</label>
                    <input id="" class="form-control @error('name') is-invalid @enderror" type="text" name="" wire:model="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Provinsi</label>
                    <select id="" class="custom-select @error('province_id') is-invalid @enderror" name="" wire:model="province_id">
                        <option>Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Kota</label>
                    <select id="" class="custom-select @error('regency_id') is-invalid @enderror" name="" wire:model="regency_id">
                    <option>Pilih Kota</option>
                    @if ($province_id != null)
                        @foreach ($regencies as $regency)
                            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    @error('regency_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input id="" class="form-control @error('alamat') is-invalid @enderror" type="text" name="" wire:model="alamat">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Mulai</label>
                        <input id="" class="form-control @error('date_start') is-invalid @enderror" type="datetime-local" name="" wire:model="date_start">
                        @error('date_start')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Berakhir</label>
                        <input id="" class="form-control @error('date_end') is-invalid @enderror" type="datetime-local" name="" wire:model="date_end">
                        @error('date_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="my-textarea">Deksripsi</label>
                    <textarea name="content" wire:model="desc" class="form-control @error('desc') is-invalid @enderror" style="height: 200px"></textarea>
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Screenshot Map</label>
                    <input id="" wire:model="map" class="form-control-file @error('map') is-invalid @enderror" type="file" name="">
                    @error('map')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input id="" wire:model="thumbnail" class="form-control-file @error('thumbnail') is-invalid @enderror" type="file" name="">
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if ($regency_id != null)
                    <button type="submit" class="btn btn-primary btn-block">Buat Event</button>
                @endif
            </form>
        </div>
    </div>
</div>