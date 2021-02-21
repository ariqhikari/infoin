<div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <form action="" wire:submit.prevent="storeUpdate">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <center>
                                            <img 
                                                src="
                                                @if(Auth::user()->google_id)
                                                    {{ Auth::user()->avatar }}
                                                @else
                                                    {{ Storage::url(Auth::user()->avatar) }}
                                                @endif
                                                "
                                        alt="{{ Auth::user()->name }}" width="110px" height="110px" class="rounded-circle">
                                        </center>
                                    </div>
                                    <div class="col-md">
                                        <h4 id="title-name">{{ Auth::user()->name }}</h4>
                                        <h6 id="title-created">{{ Auth::user()->created_at->format("d M Y") }}</h6>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <label for="" class="section-title">Nama</label>
                                                <input class="form-control @error("name") is-invalid @enderror" type="text" name="name" wire:model="name">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="section-title">Email</label>
                                                <input class="form-control" type="email" name="email" readonly wire:model="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <label for="" class="section-title">Nomer telepon</label>
                                                <input class="form-control @error("phone") is-invalid @enderror" type="text" name="phone" wire:model="phone">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="section-title">Role</label>
                                                <input class="form-control" type="text" name="" readonly
                                                    @if (Auth::user()->role->name == 'user')
                                                        value="User"
                                                    @elseif(Auth::user()->role->name == 'eo')
                                                        value="Event Organizer"
                                                    @else
                                                        value="Admin"
                                                    @endif
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning" role="alert">
                                                    kosongkan jika tidak akan mengganti password
                                                </div>
                                                <label for="" class="section-title" style="margin-top: -50px">Password</label>
                                                <input class="form-control" type="password" wire:model="password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning" role="alert">
                                                    kosongkan jika tidak akan mengganti avatar
                                                </div>
                                                <label for="" class="section-title" style="margin-top: -50px">Avatar</label>
                                                <div class="custom-file">
                                                    <input type="file" wire:model="avatar" name="site_favicon" class="custom-file-input" id="site-favicon">
                                                    <label class="custom-file-label">Pilih File</label>
                                                </div>
                                                <div class="form-text text-muted">ukuran gambar tidak lebih dari 2mb</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary mt-4 btn-block" type="submit"><i class="fas fa-edit"></i> Perbarui Profil</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger mt-4 btn-block" type="button" wire:click.prevent="cancel()"><i class="fas fa-times"></i> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (Auth::user()->role_id == 1)
            <div class="col-md-5">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">
                                    Jika kalian tertarik menjadi seorang event organizer, dimana ketika kalian menjadi seorang event oraganizer, kalian bisa mepublikasikan acara amal kalian sendiri, tentunya dengan persetujuan admin. 
                                </div>
                                @if (Auth::user()->verifications())
                                    @if (Auth::user()->verifications()->status == 0)
                                        <button class="btn btn-warning btn-block" type="button"><i class="fas fa-user-clock"></i> Menunggu Verifikasi</button>
                                    @else
                                        <a href="{{ route("eo.verification") }}">
                                            <button class="btn btn-primary btn-block" type="button"><i class="fas fa-user-check"></i> Verifikasi</button>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route("eo.verification") }}">
                                        <button class="btn btn-primary btn-block" type="button"><i class="fas fa-user-check"></i> Verifikasi</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                @if (Auth::user()->verifications())
                                    <h5 class="section-title" style="margin-top:0px;margin-bottom:20px">Riwayat Verifikasi</h5>
                                    <div>
                                        <h6 class="float-left">Waktu : {{ Auth::user()->verifications()->created_at->diffForHumans() }}</h6>
                                        @if (Auth::user()->verifications()->status == 0)
                                            <span class="badge badge-pill badge-warning float-right">Menunggu</span>
                                        @endif
                                        @if (Auth::user()->verifications()->status == 1)
                                            <span class="badge badge-pill badge-success float-right">Diijinkan</span>
                                        @endif
                                        @if (Auth::user()->verifications()->status == 2)
                                            <span class="badge badge-pill badge-danger float-right">Ditolak</span>
                                        @endif
                                    </div>
                                @else
                                    <h6 class="text-center">Belum ada riwayat verifikasi</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
