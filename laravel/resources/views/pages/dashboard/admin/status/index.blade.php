@extends('pages.dashboard.template_backend.home')

@section('title')
    Status
@endsection

@section('sub-title')
    Status
@endsection

@section('content')
    <livewire:admin.status.index></livewire:admin.status.index>
@endsection