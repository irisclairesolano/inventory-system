@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Inventory: {{ $inventory->product->name }}</h2>
    <form method="POST" action="{{ route('inventory.update', $inventory) }}">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Quantity *</label>
                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $inventory->quantity) }}" min="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reorder Level *</label>
                    <input type="number" class="form-control" name="reorder_level" value="{{ old('reorder_level', $inventory->reorder_level) }}" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location', $inventory->location) }}">
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
