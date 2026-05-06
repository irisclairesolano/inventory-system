@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#111827] mb-2">Edit Inventory</h1>
    <p class="text-sm text-[#6B7280] mb-8">{{ $inventory->product->name }}</p>

    <form method="POST" action="{{ route('inventory.update', $inventory) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="card">
            <div class="space-y-6">
                <div>
                    <label for="quantity" class="form-label">Quantity *</label>
                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        value="{{ old('quantity', $inventory->quantity) }}"
                        min="0"
                        class="input-field @error('quantity') border-[#EF4444] @enderror"
                        required
                    >
                    @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="reorder_level" class="form-label">Reorder Level *</label>
                    <input
                        type="number"
                        id="reorder_level"
                        name="reorder_level"
                        value="{{ old('reorder_level', $inventory->reorder_level) }}"
                        min="1"
                        class="input-field @error('reorder_level') border-[#EF4444] @enderror"
                        required
                    >
                    @error('reorder_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="location" class="form-label">Location</label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location', $inventory->location) }}"
                        class="input-field @error('location') border-[#EF4444] @enderror"
                    >
                    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Update Inventory
            </button>
            <a href="{{ route('inventory.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
