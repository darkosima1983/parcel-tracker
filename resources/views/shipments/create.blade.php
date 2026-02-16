@extends('layouts.layout')

@section('title', 'Add Shipment')

@section('content')
<h2 class="mb-4">➕ Add New Shipment</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('shipments.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
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
        <input type="number" name="price" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="unassigned" selected>Unassigned</option>
            <option value="in_progress">In progress</option>
            <option value="completed">Completed</option>
            <option value="problem">Problem</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea name="details" class="form-control" rows="3"></textarea>
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
        Save Shipment
    </button>
</form>
@endsection