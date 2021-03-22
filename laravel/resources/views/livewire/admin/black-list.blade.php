@section('title')
    Daftar Blacklist
@endsection

@section('sub-title')
    Daftar Blacklist
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
            <label for="" class="section-title mt-0">Daftar Blacklist</label>
            <p class="section-lead">Ini adalah Daftar Akun yang di blacklist</p>
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
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Restore Blacklist</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item => $result)
                                        <tr>
                                            <td>{{ $item+$users->firstitem() }}</td>
                                            <td>
                                                <img 
                                                    src="
                                                    @if($result->google_id)
                                                        {{ $result->avatar }}
                                                    @else
                                                        {{ Storage::url($result->avatar) }}
                                                    @endif
                                                    "
                                                alt="{{ $result->name }}" class="img-thumbnail mt-3" width="100px">
                                            </td>
                                            <td>{{ $result->name }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-primary">
                                                    @if ($result->role_id == 1)
                                                        User
                                                    @elseif ($result->role_id == 2)
                                                        Event Organizer
                                                    @else
                                                        Admin
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if ($statusBlacklist == true)
                                                    @if ($idUser == $result->id)
                                                        <button wire:click.prevent="cancelBlacklist()" class="btn btn-warning" type="button"><i class="fas fa-times"></i></button>
                                                        <button wire:click.prevent="updateBlacklist()" class="btn btn-success" type="button"><i class="fas fa-check"></i></button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-success" wire:click.prevent="restoreBlacklist({{ $result->id }})" type="button">
                                                       <i class="fas fa-trash-restore"></i>
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
