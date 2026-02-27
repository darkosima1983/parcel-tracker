
<div>
    <h2 class="mb-4">➕ Add New Shipment</h2>
    <form wire:submit="submit" enctype="multipart/form-data">

        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" wire:model.live.debounce.500ms="title" class="form-control" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="from_city" class="form-label">From City</label>
            <input type="text" wire:model.live.debounce.500ms="from_city" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="from_state"  class="form-label">From State</label>
            <input type="text" wire:model.live.debounce.500ms="from_state" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="to_city" class="form-label">To City</label>
            <input type="text" wire:model.live.debounce.500ms="to_city" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="to_state" class="form-label">To State</label>
            <input type="text" wire:model.live.debounce.500ms="to_state" class="form-control" required>
        </div>
    </div>

     <div class="mb-3">
        <label for="price" class="form-label">Price (€)</label>
        <input type="number" wire:model.live.debounce.500ms="price" class="form-control" step="0.01" required>
    </div>

      <div class="mb-3">
        <label for="client_id" class="form-label">Client ID</label>
        @error('client_id') <p class="text-danger">{{ $message }}</p> @enderror
        <p>{{ $clientError}}</p>
        <input type="number" wire:blur="validateClient" wire:model.live.debounce.500ms="client_id" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select wire:model="status" class="form-control">
           @foreach($statuses as $key => $value)
           <option value="{{ $key }}" >{{ $value }}</option>
           @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Documents</label>
        <input
            type="file"
            wire:model="documents"
            class="form-control"
            multiple
            accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx"
        >
        <small class="text-muted">
            You can upload multiple documents (PDF, JPG, PNG, WebP, Word)
        </small>
    </div>

    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea wire:model="details" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">
        Save Shipment
    </button>
    </form>
</div>