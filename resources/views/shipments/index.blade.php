@extends('layouts.layout')

@section('title', 'All Shipments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📦 All Shipments</h2>
    @can('showCreate', App\Models\Shipment::class)
        <a href="{{ route('shipments.create') }}" class="btn btn-primary">
            + Add Shipment
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($shipments->isEmpty())
    <div class="alert alert-info">
        No shipments found.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Price (€)</th>
                    <th>Aktionen</th> 
                    <th>Sendung zuweisen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipments as $shipment)
                    <tr>
                        <td>{{ $shipment->title }}</td>
                        <td>{{ $shipment->from_city }}, {{ $shipment->from_state }}</td>
                        <td>{{ $shipment->to_city }}, {{ $shipment->to_state }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $shipment->status }}
                            </span>
                        </td>
                        <td>{{ $shipment->price }}</td>
                        <td>
                            <a href="{{ route('shipments.show', $shipment->id) }}" class="btn btn-sm btn-info">
                                Details
                            </a>
                            <a href="{{ route('shipments.edit', $shipment->id) }}" class="btn btn-sm btn-warning">
                                Bearbeiten
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('shipments.assignUser', $shipment->id) }}">
                                @csrf
                                <select name="user_id" class="form-select form-select-sm mb-2">
                                    <option selected disabled>None</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Zuweisen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@livewire('shipment-assigned-list')
@endsection
