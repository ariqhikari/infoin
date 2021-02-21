<div>
    @if (session("success"))
    <script>
        swal("System Says", "{{ session("success") }}", "success");
    </script>
    @endif

    @if (session("error"))
        <script>
            swal("System Says", "{{ session("error") }}", "error");
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
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
                                            <input class="form-control" type="text" readonly name="" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="section-title">Email</label>
                                            <input class="form-control" readonly type="email" name="" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <label for="" class="section-title">No telepon</label>
                                            <input class="form-control" type="text" readonly name=""
                                            @if (Auth::user()->phone == null)
                                                value="belum di update"
                                            @else
                                                value="{{ Auth::user()->phone }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="section-title">Role</label>
                                            <input class="form-control" readonly type="text" name=""
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
                            <button wire:click="update({{ Auth::user()->id }})" class="btn btn-primary mt-4 btn-block" type="button"><i class="fas fa-edit"></i> Ubah Profil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
