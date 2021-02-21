@extends('pages.dashboard.template_backend.home')

@section('title')
    Verification Account
@endsection

@section('sub-title')
    Verification Account
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Hai Admin</h5>
                    <p class="card-text">{{ $data->user->email }} memita verifikasi menjadi seorang event organizer.</p>
                    <br>
                    <center>
                        @if ($data->status == 0)
                            <a href="{{ route("eo.acceptVerification",$data) }}">
                                <button class="btn btn-primary" style="width: 100px" type="button"><i class="fas fa-check"></i>  Ijinkan</button>
                            </a>
                            <a href="{{ route("eo.declineVerification",$data) }}">
                                <button class="btn btn-danger" style="width: 100px" type="button"><i class="fas fa-times"></i> Tolak</button>
                            </a>
                        @else
                            @if ($data->status == 1)
                                <button class="btn btn-success" style="width: 110px" type="button"><i class="fas fa-check"></i> Terijinkan</button>
                            @endif
                            @if ($data->status == 2)
                                <button class="btn btn-danger" style="width: 100px" type="button"><i class="fas fa-times"></i> Tertolak</button>
                            @endif
                        @endif
                    </center>
                    <br><br>
                    <p>Semua keputusan tergantung anda</p>
                    <h6 style="margin-top: -15px">System</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="section-title" style="margin-top: 0px">Foto ktp</h6>
                    <a href="{{ Storage::url($data->ktp) }}">
                        <img src="{{ Storage::url($data->ktp) }}" width="100%" height="234px" alt="ktp">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection