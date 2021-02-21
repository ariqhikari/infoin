<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <label for="" class="section-title mt-0">Status</label>
            <p class="section-lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi iure, deserunt exercitationem ad quidem, est quam nemo molestiae eveniet repellat id.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session("success"))    
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session("success") }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            @if (session("error"))    
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session("error") }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($statusUpdate == true)
                                <livewire:admin.status.edit></livewire:admin.status.edit>
                            @else
                                <livewire:admin.status.create></livewire:admin.status.create>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($status as $item => $result)
                                                <tr>
                                                    <td>{{ $item+$status->firstitem() }}</td>
                                                    <td>{{ $result->name }}</td>
                                                    <td>
                                                        <button class="btn btn-warning" type="button" wire:click="edit({{ $result->id }})">
                                                            <i class="fas fa-pen-alt"></i>
                                                        </button>
                                                        <button class="btn btn-danger" type="button" wire:click="delete({{ $result->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
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
                        <div class="col-md-5">
                            {{ $status->links("components.custom-pagination-links-view") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
