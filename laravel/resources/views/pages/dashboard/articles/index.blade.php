@extends('pages.dashboard.template_backend.home')

@section('title')
    Daftar Artikel
@endsection

@section('sub-title')
    Daftar Artikel
@endsection

@section('content')
    @php
        $null = null;
    @endphp
    @if (isset($articleEdit))
        <livewire:articles.index :articleEdit="$articleEdit"></livewire:articles.index>
    @else
        <livewire:articles.index :articleEdit="$null"></livewire:articles.index>
    @endif
@endsection