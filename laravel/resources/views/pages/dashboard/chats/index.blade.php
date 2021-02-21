@extends('pages.dashboard.template_backend.home')

@if (Auth::user()->role_id != 3)
    @section('title')
        Hubungi Admin
    @endsection

    @section('sub-title')
        Hubungi Admin
    @endsection
@else
    @section('title')
        Laporan User & Event Organizer
    @endsection

    @section('sub-title')
        Laporan User & Event Organizer
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col">
            @if (Auth::user()->role_id != 3)
                <label for="" class="section-title mt-0">
                    Hubungi Admin
                </label>
                <p class="section-lead">Terdapat kendala atau bug? Segera hubungi Admin!</p>
            @else
                <label for="" class="section-title mt-0">
                    Laporan User & Event Organizer
                </label>
                <p class="section-lead">Laporan bug atau kendala User & Event Organizer</p>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 col-lgs-3">
            <livewire:chats.contacts></livewire:chats.contacts>
        </div>
        <div class="col-md-8 col-lgs-9">
            <livewire:chats.send></livewire:chats.send>
        </div>
    </div>
@endsection