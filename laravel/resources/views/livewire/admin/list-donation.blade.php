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
                <div class="card-body  table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Judul Donasi</th>
                                <th>EO</th>
                                <th>Max Dana</th>
                                <th>Dana Terkumpul</th>
                                <th>Batas Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $item => $result)
                            <tr>
                                <td>{{ $item+$donations->firstitem() }}</td>
                                <td>{{ $result->title }}
                                    <div>
                                        <li>
                                            <a href="{{ env('MAIN_DOMAIN') . 'donation/' . $result->slug }}" target="_blank">lihat tampilan</a>
                                        </li>
                                        <li>
                                            <a href="{{ route("donation.pendonasi",$result->id) }}" target="_blank">lihat pendonasi</a>
                                        </li>
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
            {{ $donations->links("components.custom-pagination-links-view") }}
        </div>
    </div>
</div>
