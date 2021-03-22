@extends('pages.dashboard.template_backend.home')

@section('content')
    <livewire:admin.donation.detail :donationDetail="$donationDetail"></livewire:admin.donation.detail>
@endsection