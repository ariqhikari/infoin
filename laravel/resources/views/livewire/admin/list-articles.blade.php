@section('css')
    <style>
        li{
            display: inline;
            margin-right: 10px;
            cursor: pointer;
            color: #6777ef
        }
    </style>
@endsection
<div>
    @if (session("success"))
        <script>
            swal("System Says", "{{ session("success") }}", "success");
        </script>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body table-responsive ">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Min Read</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item => $result)
                            <tr>
                                <td>{{ $item+$articles->firstitem() }}</td>
                                <td>{{ $result->title }}
                                    <div>
                                        <li>
                                            <a href="{{ env('MAIN_DOMAIN') . 'article/'. $result->slug }}" target="_blank">lihat</a>
                                        </li>
                                        <li class="text-danger" wire:click="unpublish({{ $result->id }})">unpublish</li>
                                    </div>
                                </td>
                                <td>
                                    {{ $result->min_read }} Min
                                </td>
                                <td>
                                    {{ $result->categori->name }}
                                </td>
                                <td>
                                    <img 
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
                        </tbody>
                    </table>
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
