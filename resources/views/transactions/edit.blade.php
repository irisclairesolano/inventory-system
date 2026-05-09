<x-app-layout>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-[#F7F4D5]">Edit Transaction</h1>
        <p class="text-sm text-[#6B7280] mt-2">{{ $transaction->product->name }}</p>
    </div>

    <div class="card">
        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Product (Display only) -->
            <div>
                <label class="form-label">Product</label>
                <div class="input-field bg-[#F9FAFB] cursor-not-allowed text-[#6B7280]">
                    {{ $transaction->product->name }}
                </div>
                <p class="text-xs text-[#6B7280] mt-2">Cannot change product. Delete and create new transaction if needed.</p>
            </div>

            <!-- Transaction Type -->
            <div>
                <label for="type" class="form-label">Transaction Type <span class="text-[#EF4444]">*</span></label>
                <select name="type" id="type" class="input-field @error('type') border-[#EF4444] @enderror" required>
                    <option value="in" {{ old('type', $transaction->type) == 'in' ? 'selected' : '' }}>Stock In (Receiving/Restocking)</option>
                    <option value="out" {{ old('type', $transaction->type) == 'out' ? 'selected' : '' }}>Stock Out (Sale/Transfer)</option>
                </select>
                @error('type')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="form-label">Quantity <span class="text-[#EF4444]">*</span></label>
                <input type="number" name="quantity" id="quantity" class="input-field @error('quantity') border-[#EF4444] @enderror"
                    min="1" value="{{ old('quantity', $transaction->quantity) }}" required>
                @error('quantity')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Date -->
            <div>
                <label for="transaction_date" class="form-label">Transaction Date <span class="text-[#EF4444]">*</span></label>
                <input type="date" name="transaction_date" id="transaction_date" class="input-field @error('transaction_date') border-[#EF4444] @enderror"
                    value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required>
                @error('transaction_date')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="input-field" placeholder="Add any details about this transaction">{{ old('notes', $transaction->notes) }}</textarea>
                @error('notes')
                    <p class="text-[#EF4444] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-[#E5E7EB]">
                <button type="submit" class="btn-primary">
                    Update Transaction
                </button>
                <a href="{{ route('transactions.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>