<div>
    @php
        use Carbon\Carbon;
        use App\Models\Province;
        use App\Models\Regency;
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label for="" class="section-title mt-0">Event</label>
                <p class="section-lead">
                    Ini adalah Daftar Event anda.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                            <a class="nav-link {{ ($filter == 3) ? "active" : ''  }}" style="cursor: pointer" wire:click="filter({{ 3 }})" >All <span class="badge badge-white">{{ $all->count() }}</span></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ ($filter == 1) ? "active" : ''  }}" style="cursor: pointer" wire:click="filter({{ 1 }})" >Dimulai <span class="badge badge-primary">{{ $started->count() }}</span></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ ($filter == 0) ? "active" : ''  }}" style="cursor: pointer" wire:click="filter({{ 0 }})" >Belum Dimulai<span class="badge badge-primary">{{ $notStart->count() }}</span></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ ($filter == 2) ? "active" : ''  }}" style="cursor: pointer" wire:click="filter({{ 2 }})" >Selesai <span class="badge badge-primary">{{ $expired->count() }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" wire:model="search" class="form-control" placeholder="Search">
                            <div class="input-group-append">                                            
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row {{ ($events->count() == null) ? 'justify-content-center' : '' }}">
            @if ($events->count() != null)
                    @php
                    $row = 0;
                @endphp
                @foreach ($events as $item)
                @php
                    $row += 1;
                @endphp
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                    <ul class="nav nav-pills flex-column" id="myTab{{ $row }}" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link active" id="home-tab{{ $row }}" data-toggle="tab" href="#home{{ $row }}" role="tab" aria-controls="home" aria-selected="true">Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="desc-tab{{ $row }}" data-toggle="tab" href="#desc{{ $row }}" role="tab" aria-controls="desc" aria-selected="true">Description</a>
                                            </li>
                                        <li class="nav-item">
                                        <a class="nav-link" id="profile-tab{{ $row }}" data-toggle="tab" href="#profile{{ $row }}" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" id="contact-tab{{ $row }}" data-toggle="tab" href="#contact{{ $row }}" role="tab" aria-controls="contact" aria-selected="false">Map & Thumbnail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="status-tab{{ $row }}" data-toggle="tab" href="#status{{ $row }}" role="tab" aria-controls="status" aria-selected="false">Status</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="action-tab{{ $row }}" data-toggle="tab" href="#action{{ $row }}" role="tab" aria-controls="action" aria-selected="false">Action</a>
                                        </li>
                                    </ul>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <div class="tab-content no-padding" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="home{{ $row }}" role="tabpanel" aria-labelledby="home-tab{{ $row }}">
                                                <label for="" class="section-title mt-0">Name</label>
                                                <p class="section-lead">{{ $item->name }}</p>
                                                @php
                                                    $province = Province::where('id', $item->province_id)->first();
                                                    $regency =  Regency::where('id', $item->regency_id)->first();
                                                @endphp
                                                <label for="" class="section-title mt-0">Provinsi & Kota</label>
                                                <p class="section-lead">{{ $province->name }} - {{ $regency->name }}</p>
                                                <label for="" class="section-title mt-0">Tanggal Mulai</label>
                                              <p class="section-lead">{{ Carbon::createFromFormat('Y-m-d H:i:s', $item->date_start)->format('d M Y H:i') }}</p>
                                                <label for="" class="section-title mt-0">Tanggal Selesai</label>
                                                <p class="section-lead">{{ Carbon::createFromFormat('Y-m-d H:i:s', $item->date_end)->format('d M Y H:i') }}</p>
                                                <label for="" class="section-title mt-0">Alamat</label>
                                                <p class="section-lead">{{  $item->address  }}</p>
                                            </div>
                                            <div class="tab-pane fade show" id="desc{{ $row }}" role="tabpanel" aria-labelledby="desc-tab{{ $row }}">
                                                <label for="" class="section-title mt-0">Description</label> <br>
                                                {!! $item->desc !!}
                                            </div>
                                            <div class="tab-pane fade" id="profile{{ $row }}" role="tabpanel" aria-labelledby="profile-tab{{ $row }}">
                                                <center>
                                                    <img src="
                                                        @if($item->user->google_id)
                                                            {{ $item->user->avatar }}
                                                        @else
                                                            {{ Storage::url($item->user->avatar) }}
                                                        @endif
                                                    " width="100px" height="100px" class="rounded-circle" alt="">

                                                    <h5 class="mt-2">{{ $item->user->name }}</h5>
                                                    <span class="badge badge-primary">
                                                        {{ $item->user->role->name }}
                                                    </span>
                                                </center>
                                            </div>  
                                            <div class="tab-pane fade" id="contact{{ $row }}" role="tabpanel" aria-labelledby="contact-tab{{ $row }}">
                                                <label for="" class="section-title mt-0">Maps</label>
                                                <img src="{{ Storage::url($item->maps) }}" class="img-thumbnail" alt="">
                                                <label for="" class="section-title">Thumbnail</label>
                                                @if ($item->thumbnail != null)
                                                    <img src="{{ Storage::url($item->thumbnail) }}" class="img-thumbnail" alt="">
                                                @else
                                                    <div style="width: 100%;height:150px;border-radius:2px;background:#6777ef">
                                                        <center>
                                                            <i style="line-height:150px;color:white;font-size:40px" class="fas fa-image"></i>
                                                        </center>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade show" id="status{{ $row }}" role="tabpanel" aria-labelledby="status-tab{{ $row }}">
                                                <label for="" class="section-title mt-0">Status</label>
                                                <p class="section-lead">Lorem ipsum dolor sit amet consectetur </p>
                                                <center>
                                                    @if ($item->date_start <= Carbon::now()->format('Y-m-d\TH:i') && $item->date_end >= Carbon::now()->format('Y-m-d\TH:i'))
                                                        <span class="badge badge-success">Dimulai</span>
                                                    @elseif($item->date_start > Carbon::now()->format('Y-m-d\TH:i') && $item->date_end > Carbon::now()->format('Y-m-d\TH:i'))
                                                        <span class="badge badge-danger">Belum Dimulai</span>
                                                    @elseif($item->date_start < Carbon::now()->format('Y-m-d\TH:i') && $item->date_end < Carbon::now()->format('Y-m-d\TH:i'))
                                                        <span class="badge badge-light">Selesai</span>
                                                    @endif
                                                </center>
                                            </div>
                                            <div class="tab-pane fade show" id="action{{ $row }}" role="tabpanel" aria-labelledby="action-tab{{ $row }}">
                                                <label for="" class="section-title mt-0">Edit</label>
                                                <br>
                                                <button wire:click="edit({{ $item->id }})" class="btn btn-warning btn-block" type="button">
                                                    <i class="fas fa-pen-alt"></i> Edit Event
                                                </button>
                                                <br>
                                                @if ($statusEdit == false)
                                                    <label for="" class="section-title mt-3">Trash</label>
                                                    <br>
                                                    <button class="btn btn-danger btn-block" wire:click="delete({{ $item->id }})" type="button">
                                                        <i class="fas fa-trash"></i> Hapus Event
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            @else
                <div class="col-md-3 mb-4">
                    <button class="btn btn-primary" type="button">
                        Tidak ada events
                    </button>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($statusEdit == true)
                            <livewire:events.edit></livewire:events.edit>
                        @else
                            <livewire:events.create></livewire:events.create>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>