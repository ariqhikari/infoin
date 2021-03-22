<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Selamat datang, {{ Auth::user()->name }}</h2>
                        <p class="lead">Ini adalah dashboard anda!</p>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->role->name == 'admin')
        <div class="row mt-4">
            <div class="col-md-4 col-lg-3">
                <livewire:online-list></livewire:online-list>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <a href="{{ route('admin.admin.list') }}" class="text-decoration-none">
                            <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                    <h4>Total Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $admin->count() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <a href="{{ route('admin.eo.list') }}" class="text-decoration-none">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                    <h4>Total EO</h4>
                                    </div>
                                    <div class="card-body">
                                    {{ $eo->count() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <a href="{{ route('admin.user.list') }}" class="text-decoration-none">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                    <h4>Total User</h4>
                                    </div>
                                    <div class="card-body">
                                    {{ $user->count() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <livewire:admin.list-articles></livewire:admin.list-articles>
            </div>
        </div>
        @endif
        @if (Auth::user()->role_id == 2)
        <div class="row mt-4">
            <div class="col-md-12">
                <livewire:admin.list-donation></livewire:admin.list-donation>
            </div>
        </div>
        @endif
        @if (Auth::user()->role_id == 1)
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            Jika kalian tertarik menjadi seorang event organizer, dimana ketika kalian menjadi seorang event oraganizer, kalian bisa mepublikasikan acara amal kalian sendiri, tentunya dengan persetujuan admin. 
                        </div>
                        @if (Auth::user()->verifications())
                            @if (Auth::user()->verifications()->status == 0)
                                <button class="btn btn-warning btn-block" type="button"><i class="fas fa-user-clock"></i> Menunggu Verifikasi</button>
                            @else
                                <a href="{{ route("eo.verification") }}">
                                    <button class="btn btn-primary btn-block" type="button"><i class="fas fa-user-check"></i> Verifikasi</button>
                                </a>
                            @endif
                        @else
                            <a href="{{ route("eo.verification") }}">
                                <button class="btn btn-primary btn-block" type="button"><i class="fas fa-user-check"></i> Verifikasi</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->verifications())
                            <h5 class="section-title" style="margin-top:0px;margin-bottom:20px">Riwayat Verifikasi</h5>
                            <div>
                                <h6 class="float-left">Waktu : {{ Auth::user()->verifications()->created_at->diffForHumans() }}</h6>
                                @if (Auth::user()->verifications()->status == 0)
                                    <span class="badge badge-pill badge-warning float-right">Menunggu</span>
                                @endif
                                @if (Auth::user()->verifications()->status == 1)
                                    <span class="badge badge-pill badge-success float-right">Diijinkan</span>
                                @endif
                                @if (Auth::user()->verifications()->status == 2)
                                    <span class="badge badge-pill badge-danger float-right">Ditolak</span>
                                @endif
                            </div>
                        @else
                            <h6 class="text-center">Belum ada riwayat verifikasi</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>