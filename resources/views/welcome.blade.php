@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')
<div class="text-center py-5">
    <h1 class="display-5 fw-bold">📦 Parcel Tracker</h1>
    <p class="lead mt-3">
        Track and manage your shipments easily with Laravel & Redis.
    </p>

    <div class="mt-4">
        <a href="{{ route('shipments.index') }}" class="btn btn-primary btn-lg me-2">
            View Shipments
        </a>

        <a href="{{ route('shipments.create') }}" class="btn btn-outline-secondary btn-lg">
            Add Shipment
        </a>
    </div>
</div>
@endsection
