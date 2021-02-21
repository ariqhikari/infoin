@extends('pages.dashboard.template_backend.home')

@section('content')
    <livewire:articles.comments :articleEdit="$articleEdit"></livewire:articles.comments>
@endsection