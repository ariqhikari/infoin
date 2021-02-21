<div>
    @php
        $opened = [];
        $closed = [];
        foreach ($data as $key => $value) {
            if ($value->status_read == 1) {
                $opened[] = $value;
            } else{
                $closed[] = $value;
            }
        }
    @endphp

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <h6 class="section-title">Terbaca</h6>
                </div>
                @foreach ($opened as $item)
                    <a href="{{ route("eo.showVerification",$item) }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="height: 100px">
                                    <div class="card-body">
                                        <img 
                                            src="
                                            @if($item->user->google_id)
                                                {{ $item->user->avatar }}
                                            @else
                                                {{ Storage::url($item->user->avatar) }}
                                            @endif
                                            "
                                        alt="{{ $item->user->name }}" width="50px" height="50px" class="float-left rounded-circle">
                                        <div class="float-left ml-3">
                                            <h6 style="color: #616161">{{ $item->user->email }} </h6>
                                            <p style="margin-top: -12px;color:#707070">
                                                @if ($item->status == 0)
                                                    meminta persetujuan admin
                                                @endif
                                                @if ($item->status == 1)
                                                    Telah terverifikasi menjadi eo
                                                @endif
                                                @if ($item->status == 2)
                                                    Permintaan tertolak
                                                @endif
                                            </p>
                                            <h6 style="margin-top: -13px;font-size:13px;color:#6777ef">{{ $item->created_at->diffForHumans() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h6 class="section-title">Belum Terbaca</h6>
                </div>
                @foreach ($closed as $item)
                    <a href="{{ route("eo.showVerification",$item) }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="height: 100px">
                                    <div class="card-body">
                                        <img 
                                            src="{{ Storage::url($item->user->avatar) }}"
                                        alt="{{ $item->user->name }}" width="50px" height="50px" class="float-left rounded-circle">
                                        <div class="float-left ml-3">
                                            <h6 style="color: #616161">{{ $item->user->email }} </h6>
                                            <p style="margin-top: -12px;color:#707070">meminta persetujuan admin</p>
                                            <h6 style="margin-top: -13px;font-size:13px;color:#6777ef">{{ $item->created_at->diffForHumans() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                {{ $data->links("components.custom-pagination-links-view") }}
            </div>
        </div>
    </div>
</div>
