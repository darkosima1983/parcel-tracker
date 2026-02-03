@extends('layouts.layout')

@section('title', 'Add Shipment')

@section('content')
<h2 class="mb-4">➕ Add New Shipment</h2>

<form method="POST" action="{{ route('shipments.store') }}" class="bg-white p-4 rounded shadow-sm">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">From City</label>
            <input type="text" name="from_city" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">From State</label>
            <input type="text" name="from_state" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">To City</label>
            <input type="text" name="to_city" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">To State</label>
            <input type="text" name="to_state" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (€)</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea name="details" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        Save Shipment
    </button>
</form>
@endsection
