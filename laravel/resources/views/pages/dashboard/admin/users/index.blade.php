@extends('pages.dashboard.template_backend.home')

@section('content')
    @if ($role == 1 && $blacklist == 0)
        <livewire:admin.user-list></livewire:admin.user-list>
    @endif
    @if ($role == 2 && $blacklist == 0)
        <livewire:admin.eo-list></livewire:admin.eo-list>
    @endif
    @if ($role == 3 && $blacklist == 0)
        <livewire:admin.admin-list></livewire:admin.admin-list>
    @endif
    @if ($blacklist == 1)
        <livewire:admin.black-list></livewire:admin.black-list>
    @endif
@endsection