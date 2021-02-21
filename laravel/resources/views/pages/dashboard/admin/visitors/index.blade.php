@extends('pages.dashboard.template_backend.home')

@section('title')
    Daftar Pengunjung
@endsection

@section('sub-title')
    Daftar Pengunjung
@endsection

@section('content')
    <livewire:admin.visitors.index></livewire:admin.visitors.index>
@endsection