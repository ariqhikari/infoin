@section('title')
    Detail Donatur
@endsection

@section('sub-title')
    Detail Donatur
@endsection

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
    <div class="row">
        <div class="col">
            <label for="" class="section-title mt-0">Detail Donatur</label>
            <p class="section-lead">Daftar donatur <strong>{{ $title }}</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="float-left">
                                <div class="card-header-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" style="border-radius:25px 0px 0px 25px" wire:model="search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" style="height:42px;border-radius:0px 25px 25px 0px;width:50px"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <select wire:model="paginate" id="my-select" class="form-control paginate-index" name="">
                                        <option>1</option>
                                        <option>5</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Donasi</th>
                                        <th>Nama Pendonasi</th>
                                        <th>Jumlah Donasi</th>
                                        <th>Nama Rekening</th>
                                        <th>Bukti Pembayaran</th>
                                        @if (Auth::user()->role_id == 3)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donationDetails as $item => $result)
                                        <tr>
                                            <td>{{ $item+$donationDetails->firstitem() }}</td>
                                            <td>{{ $result->donation->title }}</td>
                                            <td>{{ $result->user->name }}</td>
                                            <td class="text-primary font-weight-bolder">{{ $result->donasi }}</td>
                                            <td>{{ $result->nama_rekening }}</td>
                                            <td>
                                                <img 
                                                    src="{{ Storage::url($result->bukti_pembayaran) }}"
                                                alt="Bukti Pembayaran" class="img-thumbnail mt-3" width="250px">
                                            </td>
                                            @if (Auth::user()->role_id == 3)
                                            <td>
                                                @if ($statusDelete == true)
                                                    @if ($idDonationDetail == $result->id)
                                                        <button wire:click.prevent="cancel()" class="btn btn-warning" type="button"><i class="fas fa-times"></i></button>
                                                        <button wire:click.prevent="destroy()" class="btn btn-success" type="button"><i class="fas fa-check"></i></button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-danger" wire:click.prevent="delete({{ $result->id }})" type="button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    {{ $donationDetails->links("components.custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
</div>
