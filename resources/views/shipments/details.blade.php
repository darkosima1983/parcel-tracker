@extends('layouts.layout')

@section('title', 'Shipment Details')

@section('content')
<h2 class="mb-4">📦 Shipment Details</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="card-title">{{ $shipment->title }}</h5>

        <p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $shipment->status)) }}</p>
        <p><strong>Price:</strong> €{{ $shipment->price }}</p>

        <hr>

        <p><strong>From:</strong><br>
            {{ $shipment->from_city }}, {{ $shipment->from_state }}
        </p>

        <p><strong>To:</strong><br>
            {{ $shipment->to_city }}, {{ $shipment->to_state }}
        </p>

        <p><strong>User ID:</strong> {{ $shipment->user_id }}</p>

        @if($shipment->details)
            <hr>
            <p><strong>Details:</strong><br>
                {{ $shipment->details }}
            </p>
        @endif

        <a href="{{ route('shipments.index') }}" class="btn btn-secondary mt-3">
            ← Back to Shipments
        </a>
    </div>
</div>
@endsection
