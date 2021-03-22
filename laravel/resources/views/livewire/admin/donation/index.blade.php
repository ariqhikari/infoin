@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
                    <label for="" class="section-title mt-0">Donation</label>
                    <p class="section-lead">
                        Ini adalah Daftar Donation anda.
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
            @if (session("successDonation"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("successDonation") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session("errorDonation"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session("errorDonation") }}</strong>
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
                                                <th>Judul Donation</th>
                                                <th>EO</th>
                                                <th>Target Donasi</th>
                                                <th>Dana Terkumpul</th>
                                                <th>Batas Waktu</th>
                                                <th>Status</th>
                                            </tr>
                                            @foreach ($donations as $item => $result)
                                                <tr>
                                                    <td>
                                                        {{ $item+$donations->firstitem() }}
                                                    </td>
                                                    <td>{{ $result->title }}
                                                        <div class="mt-1">
                                                            @if ($result->status_id == 1)
                                                                <li style="margin-right: 10px">
                                                                    <a href="{{ env('MAIN_DOMAIN') . 'donation/' . $result->slug }}" target="_blank">
                                                                        lihat tampilan
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li style="margin-right: 10px">
                                                                <a href="{{ route("donation.pendonasi",$result->id) }}">
                                                                    lihat pendonasi
                                                                </a>
                                                            </li>
                                                            @if ($result->status_id != 3)
                                                                <li style="margin-right: 10px">
                                                                    <a href="{{ route("donation.edit",$result) }}">
                                                                        ubah
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($donationEdit == null)
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
                                                    <td>
                                                        {{ number_format($result->max_dana, 2) }} 
                                                    </td>
                                                    <td>
                                                        {{ number_format($result->donation_details->sum('donasi'), 2) }} 
                                                    </td>
                                                    <td>{{ date('d M Y',strtotime($result->donation_end)) }}</td>
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
                    {{ $donations->links("components.custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" wire:ignore> 
            @if ($donationEdit !=null)
                @include('pages.dashboard.admin.donation.edit')
            @else
                @include('pages.dashboard.admin.donation.create')
            @endif
        </div>
    </div>
</div>

@section('script')
@include('components.summernote')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Select a categories",
            allowClear: true
        });
    });
</script>
@endsection
