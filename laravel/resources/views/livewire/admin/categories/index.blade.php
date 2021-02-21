<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <label for="" class="section-title mt-0">Daftar Kategori</label>
            <p class="section-lead">Daftar Kategori yang akan dipakai di Donation dan Artikel</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <livewire:admin.categories.edit></livewire:admin.categories.edit>
                            @else
                                <livewire:admin.categories.create></livewire:admin.categories.create>
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
                                            @foreach ($categories as $item => $result)
                                                <tr>
                                                    <td>{{ $item+$categories->firstitem() }}</td>
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
                            {{ $categories->links("components.custom-pagination-links-view") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
