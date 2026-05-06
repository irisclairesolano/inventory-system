@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#111827] mb-8">Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="card">
            <div class="space-y-6">
                <div>
                    <label for="name" class="form-label">Product Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="input-field @error('name') border-[#EF4444] @enderror"
                        required
                    >
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="sku" class="form-label">SKU</label>
                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value="{{ old('sku', $product->sku) }}"
                        class="input-field @error('sku') border-[#EF4444] @enderror"
                    >
                    @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="form-label">Category *</label>
                        <select
                            id="category_id"
                            name="category_id"
                            class="input-field @error('category_id') border-[#EF4444] @enderror"
                            required
                        >
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="supplier_id" class="form-label">Supplier *</label>
                        <select
                            id="supplier_id"
                            name="supplier_id"
                            class="input-field @error('supplier_id') border-[#EF4444] @enderror"
                            required
                        >
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ old('supplier_id', $product->supplier_id) == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div>
                    <label for="price" class="form-label">Price (₱) *</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        min="0"
                        class="input-field @error('price') border-[#EF4444] @enderror"
                        required
                    >
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="image" class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($product->image) }}" width="120" height="120" alt="Current image" class="rounded border border-[#E5E7EB]">
                            <div class="mt-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="remove_image" value="1" class="w-4 h-4 text-[#EF4444] border-gray-300 rounded focus:ring-[#EF4444]">
                                    <span class="text-sm text-[#EF4444]">Remove current image</span>
                                </label>
                            </div>
                            <p class="text-xs text-[#6B7280] mt-2">Or upload a new image to replace the current one</p>
                        </div>
                    @endif
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="input-field @error('image') border-[#EF4444] @enderror"
                    >
                    <p class="text-xs text-[#6B7280] mt-2">Recommended size: 500x500px, Max 2MB</p>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="input-field @error('description') border-[#EF4444] @enderror"
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                Update Product
            </button>
            <a href="{{ route('products.index') }}" class="btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
