<x-app-layout>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#F7F4D5] mb-8">
        Add New Product
    </h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card">
            <div class="space-y-6">

                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#0A3323] mb-2">
                        Product Name *
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="input-field @error('name') border-[#EF4444] @enderror"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-[#0A3323] mb-2">
                        SKU
                    </label>

                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value="{{ old('sku') }}"
                        class="input-field @error('sku') border-[#EF4444] @enderror"
                    >

                    @error('sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category + Supplier -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-[#0A3323] mb-2">
                            Category *
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="input-field @error('category_id') border-[#EF4444] @enderror"
                            required
                        >
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-[#0A3323] mb-2">
                            Supplier *
                        </label>

                        <select
                            id="supplier_id"
                            name="supplier_id"
                            class="input-field @error('supplier_id') border-[#EF4444] @enderror"
                            required
                        >
                            <option value="">Select Supplier</option>

                            @foreach($suppliers as $supplier)
                                <option
                                    value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                                >
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-[#0A3323] mb-2">
                        Price (₱) *
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0"
                        class="input-field @error('price') border-[#EF4444] @enderror"
                        required
                    >

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Stock + Reorder -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="quantity" class="block text-sm font-medium text-[#0A3323] mb-2">
                            Initial Stock
                        </label>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="{{ old('quantity', 0) }}"
                            min="0"
                            class="input-field @error('quantity') border-[#EF4444] @enderror"
                        >

                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="reorder_level" class="block text-sm font-medium text-[#0A3323] mb-2">
                            Reorder Level
                        </label>

                        <input
                            type="number"
                            id="reorder_level"
                            name="reorder_level"
                            value="{{ old('reorder_level', 10) }}"
                            min="0"
                            class="input-field @error('reorder_level') border-[#EF4444] @enderror"
                        >

                        @error('reorder_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Product Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-[#0A3323] mb-2">
                        Product Image
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="
                            input-field
                            @error('image') border-[#EF4444] @enderror

                            file:mr-4
                            file:px-4
                            file:py-2
                            file:rounded-lg
                            file:border-0
                            file:bg-[#839958]
                            file:text-white
                            file:text-sm
                            file:font-medium
                            file:cursor-pointer
                            file:transition-all
                            file:duration-150
                            hover:file:bg-[#6B7A4A]
                        "
                    >

                    <p class="text-xs text-[#6B7280] mt-2">
                        Recommended size: 500x500px, Max 2MB
                    </p>

                    @error('image')
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
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Save Product
            </button>

            <a href="{{ route('products.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-app-layout>