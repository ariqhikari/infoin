@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .modal-backdrop{
            position: relative !important;
        }

        h6{
            cursor: pointer;
            font-weight: normal;
            font-size: 15px
        }

        ul{
            margin-top: 5px
        }

        li{
            display: inline;
            list-style: none;
            cursor: pointer;
            color: #6777ef
        }
    </style>
@endsection
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <label for="" class="section-title mt-0">Artikel</label>
                    <p class="section-lead">
                        Ini adalah Dafrar Artikel anda.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <h6 
                                    class="nav-link {{ ($active == null) ? 'active' : '' }}"
                                    wire:click="nonActive()">Semua <span class="badge badge-primary">{{ $all->count() }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                    class="nav-link {{ ($active == 2) ? 'active' : '' }}"
                                    wire:click="active({{ 2 }})">Draft <span class="badge badge-primary">{{ $draft }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                    class="nav-link {{ ($active == 3) ? 'active' : '' }}"
                                    wire:click="active({{ 3 }})">Sampah <span class="badge badge-primary">{{ $trash }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                    class="nav-link {{ ($active == 1) ? 'active' : '' }}"
                                    wire:click="active({{ 1 }})">Publish <span class="badge badge-primary">{{ $publish }}</span></h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if (session("successArticle"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("successArticle") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session("errorArticle"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session("errorArticle") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-left mb-3">
                                        <div class="card-header-form">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search" style="border-radius:25px 0px 0px 25px" wire:model="search" wire:model="search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" style="height:42px;border-radius:0px 25px 25px 0px;width:50px"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th class="text-center pt-2">
                                                #
                                                </th>
                                                <th>Judul</th>
                                                <th>Min Read</th>
                                                <th>Kategori</th>
                                                <th>Penulis</th>
                                                <th>Waktu</th>
                                                <th>Status</th>
                                            </tr>
                                            @foreach ($articles as $item => $result)
                                                <tr>
                                                    <td>
                                                        {{ $item+$articles->firstitem() }}
                                                    </td>
                                                    <td>{{ $result->title }}
                                                       <div class="mt-1">
                                                            @if ($result->status_id == 1)
                                                                <li style="margin-right: 10px">
                                                                    <a href="{{ env('MAIN_DOMAIN') . 'article/' . $result->slug }}" target="_blank">
                                                                        lihat tampilan
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li style="margin-right: 10px">
                                                                <a href="{{ route("articles.comment",$result->id) }}">
                                                                    lihat komentar
                                                                </a>
                                                            </li>
                                                            @if ($result->status_id != 3)
                                                                <li style="margin-right: 10px">
                                                                    <a href="{{ route("articles.edit",$result) }}">
                                                                        ubah
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($articleEdit == null)
                                                                @if ($result->deleted_at != null)
                                                                    <li wire:click="destroy({{ $result->id }})" class="text-danger" style="margin-right: 10px">
                                                                        hapus
                                                                    </li>
                                                                @else
                                                                    <li wire:click="toTrash({{ $result->id }})" class="text-danger" style="margin-right: 10px">
                                                                        sampah
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            @if ($result->deleted_at != null)
                                                                <li wire:click="restore({{ $result->id }})" class="text-success" style="margin-right: 10px">
                                                                    pulihkan
                                                                </li>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $result->min_read }} Min
                                                    </td>
                                                    <td>
                                                        {{ $result->categori->name }}
                                                    </td>
                                                    <td>
                                                        <img alt="image" 
                                                            src="
                                                            @if($result->user->google_id)
                                                                {{ $result->user->avatar }}
                                                            @else
                                                                {{ Storage::url($result->user->avatar) }}
                                                            @endif
                                                            "
                                                        class="rounded-circle" width="35" data-toggle="title" height="35" title="{{ $result->user->name }}">
                                                    </td>
                                                    <td>{{ $result->created_at->format("d M Y") }}</td>
                                                    <td>
                                                        @if ($result->status_id == 1)
                                                            <div class="badge badge-primary">Publish</div>
                                                        @endif
                                                        @if ($result->status_id == 2)
                                                            <div class="badge badge-warning">Draft</div>
                                                        @endif
                                                        @if ($result->status_id == 3)
                                                            <div class="badge badge-danger">Sampah</div>
                                                        @endif
                                                        @if ($result->status_id == 4)
                                                            <div class="badge badge-dark">Blacklist</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    {{ $articles->links("components.custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" wire:ignore>
            @if ($articleEdit !=null)
                @include('pages.dashboard.articles.edit')
            @else
                @include('pages.dashboard.articles.create')
            @endif
        </div>
    </div>
</div>
