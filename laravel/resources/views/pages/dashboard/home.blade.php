@extends('pages.dashboard.template_backend.home')

@section('title')
    @if (Auth::user()->role->name == 'user')
        Dashboard User
    @endif
    @if (Auth::user()->role->name == 'eo')
        Dashboard Event Organizer
    @endif
    @if (Auth::user()->role->name == 'admin')
        Dashboard Admin
    @endif
@endsection

@section('sub-title')
    @if (Auth::user()->role->name == 'user')
        Dashboard User
    @endif
    @if (Auth::user()->role->name == 'eo')
        Dashboard Event Organizer
    @endif
    @if (Auth::user()->role->name == 'admin')
        Dashboard Admin
    @endif
@endsection

@section('content')
<div class="container">
    @include('pages.dashboard.dashboard')
</div>
@endsection
