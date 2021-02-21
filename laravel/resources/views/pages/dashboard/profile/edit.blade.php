@extends('pages.dashboard.template_backend.home')

@section('title')
    Profil {{ Auth::user()->name }}
@endsection

@section('sub-title')
    Profil {{ Auth::user()->name }}
@endsection

@section('script')
    <link rel="stylesheet" href="{{ asset("resources/css/profile.css") }}">
@endsection

@section('content')
<livewire:profile.index></livewire:profile.index>
@endsection