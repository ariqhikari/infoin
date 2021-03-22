@extends('pages.dashboard.template_backend.home')

@section('title')
    List Verifications
@endsection

@section('sub-title')
    List Verifications
@endsection

@section('content')
    <livewire:admin.verification-list></livewire:admin.verification-list>
@endsection