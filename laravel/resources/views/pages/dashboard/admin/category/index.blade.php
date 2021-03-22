@extends('pages.dashboard.template_backend.home')

@section('title')
   Daftar Kategori
@endsection

@section('sub-title')
   Daftar Kategori
@endsection

@section('content')
    <livewire:admin.categories.index></livewire:admin.categories.index>
@endsection