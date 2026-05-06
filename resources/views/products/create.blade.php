@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#111827] mb-8">Add New Product</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card">
            <div class="space-y-6">
                <x-form-input
                    label="Product Name"
                    name="name"
                    required
                />

                <x-form-input
                    label="SKU"
                    name="sku"
                />

                <div class="grid grid-cols-2 gap-6">
                    <x-form-select
                        label="Category"
                        name="category_id"
                        :options="$categories->pluck('name', 'id')"
                        required
                    />

                    <x-form-select
                        label="Supplier"
                        name="supplier_id"
                        :options="$suppliers->pluck('name', 'id')"
                        required
                    />
                </div>

                <x-form-input
                    label="Price (₱)"
                    name="price"
                    type="number"
                    step="0.01"
                    min="0"
                    required
                />

                <div class="grid grid-cols-2 gap-6">
                    <x-form-input
                        label="Initial Stock"
                        name="quantity"
                        type="number"
                        min="0"
                        value="0"
                    />

                    <x-form-input
                        label="Reorder Level"
                        name="reorder_level"
                        type="number"
                        min="0"
                        value="10"
                    />
                </div>

                <x-form-input
                    label="Product Image"
                    name="image"
                    type="file"
                    accept="image/*"
                />
                <p class="text-xs text-[#6B7280] -mt-4">Recommended size: 500x500px, Max 2MB</p>

                <x-form-textarea
                    label="Description"
                    name="description"
                    rows="4"
                />
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
@endsection
