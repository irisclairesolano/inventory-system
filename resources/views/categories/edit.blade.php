<x-app-layout>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-3xl font-semibold text-[#F7F4D5] mb-8">
        Edit Category
    </h1>

    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="space-y-6">

                <!-- Category Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#0A3323] mb-2">
                        Category Name *
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="input-field @error('name') border-[#EF4444] @enderror"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-[#0A3323] mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="input-field @error('description') border-[#EF4444] @enderror"
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Update Category
            </button>

            <a href="{{ route('categories.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>

    </form>
</div>

</x-app-layout>