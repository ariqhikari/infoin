@extends('pages.dashboard.template_backend.home')

@section('title')
    Daftar Event
@endsection

@section('sub-title')
    Daftar Event
@endsection

@section('content')
    <livewire:events.index></livewire:events.index>
@endsection