@extends('pages.dashboard.template_backend.home')

@section('title')
    Donation
@endsection

@section('sub-title')
    Donation
@endsection

@section('content')
    @php
        $null = null;
    @endphp
    @if (isset($donationEdit))
        <livewire:admin.donation.index :donationEdit="$donationEdit" :categories="$categories"></livewire:admin.donation.index>
    @elseif($userBanks->isEmpty())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4>Harap Buat Rekening Terlebih Dahulu</h4>
                    <p>Atau Klik <a href="{{ route('admin.bank.user.list') }}">link</a> ini</p>
                </div>
            </div>
        </div>
    @else
        <livewire:admin.donation.index :donationEdit="null" :categories="$categories"></livewire:admin.donation.index>
    @endif
@endsection