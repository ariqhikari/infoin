    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - Info.In</title>
    <link rel="icon" href="{{ asset('assets/backend/icons/favicon.ico') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <livewire:styles></livewire:styles>
    <livewire:scripts></livewire:scripts>
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    @yield('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/select2.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset("assets/backend/css/admin.css") }}">
    <style>
        .box-chat{
            background-color: #6777ef;
            margin-top: 450px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: block;
            width:60px;
            border-radius: 50%;
            box-shadow: 0px 0px 5px 2px rgb(233, 233, 233);
            height: 60px;
        }

        .z-index{
            z-index: 1;
        }
    </style>
    </head>

    <body>
    <div id="app">
        <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto" method="POST" @yield('action-search')>
                @csrf
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                @yield('icon-search')
            </ul>
            @yield('search')
            </form>
            @if (Auth::user()->role_id == 3)
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg 
                        {{ (Auth::user()->adminNotification()->where('status_read', 0)->count() > 0) ? 'beep' : '' }}">
                            <i class="far fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Pemberitahuan
                            <div class="float-right">
                            <a href="{{ route("eo.readAllVerification") }}">Tandai semua telah dibaca</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            @foreach (Auth::user()->adminNotification() as $item)
                                <a href="{{ route("eo.showVerification",$item) }}" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        {{ $item->user->email }} meminta persetujuan admin
                                        <div class="time text-primary">{{ $item->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="{{ route("eo.indexVerification") }}">Lihat semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                        </div>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="{{ Auth::user()->name }}" src="
                        @if(Auth::user()->google_id)
                            {{ Auth::user()->avatar }}
                        @else
                            {{ Storage::url(Auth::user()->avatar) }}
                        @endif
                    "
                    height="30px" width="30px" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Terakhir login {{ Auth::user()->lastLogin()}}</div>
                        <a href="{{ route("profile.edit") }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Back to Home
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        @include('pages.dashboard.template_backend.sidebar')

        <!-- Main Content -->

        <div class="main-content">
            <section class="section">
            <div class="section-header">
                <h1>@yield('sub-title')</h1>
            </div>
            @yield('content')
            <a href="{{ route("contact-admin.index") }}">
                <div class="box-chat">
                    @if (Auth::user()->globalUnread() != 0)
                        <div style="width: 20px;height:20px;border-radius:50%;background-color:red;position:absolute">

                        </div>
                    @endif
                    <center>
                        <i class="fas fa-comments" style="color: #fff;font-size:25px;line-height:60px"></i>
                    </center>
                </div>
            </a>
            <div class="section-body">
            </div>
            </section>
        </div>
        @include('pages.dashboard.template_backend.footer')