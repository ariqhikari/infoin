<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <label for="" class="section-title mt-0">Daftar Rekening</label>
            <p class="section-lead">Ini adalah Daftar Rekening yang akan ditampilkan saat transaksi donation</p>
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
                                <livewire:admin.banks.user.edit></livewire:admin.banks.user.edit>
                            @else
                                <livewire:admin.banks.user.create></livewire:admin.banks.user.create>
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
                                                <th>Bank</th>
                                                <th>No Rekening</th>
                                                <th>Nama Penerima / Rekening</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userBanks as $item => $result)
                                                <tr>
                                                    <td>{{ $item+$userBanks->firstitem() }}</td>
                                                    <td>{{ $result->user->name }}</td>
                                                    <td>{{ $result->bank->name }}</td>
                                                    <td>{{ $result->no_rekening }}</td>
                                                    <td>{{ $result->nama_rekening }}</td>
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
                            {{ $userBanks->links("components.custom-pagination-links-view") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
