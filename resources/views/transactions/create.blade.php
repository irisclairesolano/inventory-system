@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-[#111827]">Record Transaction</h1>
        <p class="text-sm text-[#6B7280] mt-2">Log a new stock movement</p>
    </div>

    <div class="card">
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Product Selection -->
            <div>
                <label for="product_id" class="form-label">Product <span class="text-[#EF4444]">*</span></label>
                <select name="product_id" id="product_id" class="input-field @error('product_id') border-[#EF4444] @enderror" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Type -->
            <div>
                <label for="type" class="form-label">Transaction Type <span class="text-[#EF4444]">*</span></label>
                <select name="type" id="type" class="input-field @error('type') border-[#EF4444] @enderror" required>
                    <option value="">-- Select Type --</option>
                    <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Stock In (Receiving/Restocking)</option>
                    <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Stock Out (Sale/Transfer)</option>
                </select>
                @error('type')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="form-label">Quantity <span class="text-[#EF4444]">*</span></label>
                <input type="number" name="quantity" id="quantity" class="input-field @error('quantity') border-[#EF4444] @enderror"
                    min="1" value="{{ old('quantity') }}" required>
                @error('quantity')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Date -->
            <div>
                <label for="transaction_date" class="form-label">Transaction Date <span class="text-[#EF4444]">*</span></label>
                <input type="date" name="transaction_date" id="transaction_date" class="input-field @error('transaction_date') border-[#EF4444] @enderror"
                    value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                @error('transaction_date')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="input-field" placeholder="Add any details about this transaction">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-[#E5E7EB]">
                <button type="submit" class="btn-primary">
                    Record Transaction
                </button>
                <a href="{{ route('transactions.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
