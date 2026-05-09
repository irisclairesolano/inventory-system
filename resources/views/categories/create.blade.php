<x-app-layout>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#111827] mb-8">Add Category</h1>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
        @csrf
        <div class="card">
            <div class="space-y-6">
                <div>
                    <label for="name" class="form-label">Category Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="input-field @error('name') border-[#EF4444] @enderror"
                        required
                    >
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="input-field @error('description') border-[#EF4444] @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Save Category
            </button>
            <a href="{{ route('categories.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-app-layout>
