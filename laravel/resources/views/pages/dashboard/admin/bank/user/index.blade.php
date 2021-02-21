@extends('pages.dashboard.template_backend.home')

@section('title')
    Daftar Rekening
@endsection

@section('sub-title')
    Daftar Rekening
@endsection

@section('content')
    <livewire:admin.banks.user.index></livewire:admin.banks.user.index>
@endsection