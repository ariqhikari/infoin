@extends('pages.dashboard.template_backend.home')

@section('title')
    Daftar Bank
@endsection

@section('sub-title')
    Daftar Bank
@endsection

@section('content')
    <livewire:admin.banks.index></livewire:admin.banks.index>
@endsection