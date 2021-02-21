@section('title')
    Daftar Event Organizer
@endsection

@section('sub-title')
    Daftar Event Organizer
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
            <label for="" class="section-title mt-0">Daftar Event Organizer</label>
            <p class="section-lead">Ini adalah Daftar Event Organizer</p>
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
                        <div class="col-md-12  table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>KTP</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Blacklist</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item => $result)
                                        <tr>
                                            <td>{{ $item+$users->firstitem() }}</td>
                                            <td>
                                                <a href="{{ Storage::url($result->ktp()) }}">
                                                    <img alt="{{ $result->name }}" src="{{ Storage::url($result->ktp()) }}" class="img-thumbnail mt-3" width="100px">
                                                </a>
                                            </td>
                                            <td>{{ $result->name }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-primary">Event Organizer</span>
                                            </td>
                                            <td>
                                                @if ($result->status == 1)
                                                    <span class="badge badge-pill badge-success">Online</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Offline</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($statusBlacklist == true)
                                                    @if ($idUser == $result->id)
                                                        <button wire:click.prevent="cancelBlacklist()" class="btn btn-warning" type="button"><i class="fas fa-times"></i></button>
                                                        <button wire:click.prevent="updateBlacklist()" class="btn btn-success" type="button"><i class="fas fa-check"></i></button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-danger" wire:click.prevent="deleteBlacklist({{ $result->id }})" type="button">
                                                        <i class="fas fa-user-times"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($statusDelete == true)
                                                    @if ($idUser == $result->id)
                                                        <button wire:click.prevent="cancel()" class="btn btn-warning" type="button"><i class="fas fa-times"></i></button>
                                                        <button wire:click.prevent="destroy()" class="btn btn-success" type="button"><i class="fas fa-check"></i></button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-danger" wire:click.prevent="delete({{ $result->id }})" type="button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
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
                    {{ $users->links("components.custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
</div>
