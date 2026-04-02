@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Inventory</h2>
    <form method="POST" action="{{ route('inventory.store') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Product *</label>
                    <select class="form-control @error('product_id') is-invalid @enderror" name="product_id" required>
                        <option>-- Select --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Quantity *</label>
                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity', 0) }}" min="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reorder Level *</label>
                    <input type="number" class="form-control" name="reorder_level" value="{{ old('reorder_level', 10) }}" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
