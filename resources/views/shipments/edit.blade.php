@extends('layouts.layout')

@section('title', 'Edit Shipment')

@section('content')
<h2 class="mb-4">✏️ Edit Shipment</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('shipments.update', $shipment->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT') <!-- Laravel očekuje PUT ili PATCH za update -->

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $shipment->title) }}" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">From City</label>
            <input type="text" name="from_city" class="form-control" value="{{ old('from_city', $shipment->from_city) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">From State</label>
            <input type="text" name="from_state" class="form-control" value="{{ old('from_state', $shipment->from_state) }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">To City</label>
            <input type="text" name="to_city" class="form-control" value="{{ old('to_city', $shipment->to_city) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">To State</label>
            <input type="text" name="to_state" class="form-control" value="{{ old('to_state', $shipment->to_state) }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (€)</label>
        <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $shipment->price) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="unassigned" {{ old('status', $shipment->status) == 'unassigned' ? 'selected' : '' }}>Unassigned</option>
            <option value="in_progress" {{ old('status', $shipment->status) == 'in_progress' ? 'selected' : '' }}>In progress</option>
            <option value="completed" {{ old('status', $shipment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="problem" {{ old('status', $shipment->status) == 'problem' ? 'selected' : '' }}>Problem</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea name="details" class="form-control" rows="3">{{ old('details', $shipment->details) }}</textarea>
    </div>
 
   <div class="mb-3">
        <label class="form-label">Trucker ID</label>
        <input 
            type="number" 
            name="user_id" 
            class="form-control" 
            value="{{ old('user_id', $shipment->user_id) }}"
            min="1"
            required
        >
    </div>

     <div class="mb-3">
        <label class="form-label">Client ID</label>
        <input 
            type="number" 
            name="client_id" 
            class="form-control" 
            value="{{ old('client_id', $shipment->client_id) }}"
            min="1"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Documents</label>
        <input
            type="file"
            name="documents[]"
            class="form-control"
            multiple
            accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx"
        >
        <small class="text-muted">
            You can upload multiple documents (PDF, JPG, PNG, WebP, Word)
        </small>
    </div>

    <button type="submit" class="btn btn-success">
        Update Shipment
    </button>
    <a href="{{ route('shipments.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</form>
@endsection
