<x-app-layout>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#F7F4D5] mb-8">Edit Supplier</h1>

    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="card">
            <div class="space-y-6">
                <div>
                    <label for="name" class="form-label">Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $supplier->name) }}"
                        class="input-field @error('name') border-[#EF4444] @enderror"
                        required
                    >
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
                        class="input-field @error('email') border-[#EF4444] @enderror"
                    >
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="phone" class="form-label">Phone</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
                        class="input-field @error('phone') border-[#EF4444] @enderror"
                    >
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="address" class="form-label">Address</label>
                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="input-field @error('address') border-[#EF4444] @enderror"
                    >{{ old('address', $supplier->address) }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Update Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-app-layout>