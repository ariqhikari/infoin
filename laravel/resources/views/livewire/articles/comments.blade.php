@section('title')
    Komentar Artikel
@endsection

@section('sub-title')
    Komentar Artikel
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
            <label for="" class="section-title mt-0">Komentar Artikel</label>
            <p class="section-lead">Daftar komentar artikel <strong>{{ $title }}</strong></p>
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
                                        <th>Nama User</th>
                                        <th>Komentar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articleEdits as $item => $result)
                                        <tr>
                                            <td>{{ $item+$articleEdits->firstitem() }}</td>
                                            <td>{{ $result->user->name }}</td>
                                            <td>{{ $result->comment }}</td>
                                            <td>
                                                @if ($statusDelete == true)
                                                    @if ($idArticleEdit == $result->id)
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
                    {{ $articleEdits->links("components.custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
</div>
