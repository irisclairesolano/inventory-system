<x-app-layout>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-start mb-8">
        <h1 class="text-3xl font-semibold text-[#111827]">{{ $product->name }}</h1>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('products.edit', $product) }}" class="btn-primary">
                Edit Product
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Image -->
        <div class="md:col-span-1">
            <div class="card">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="w-full rounded-t-[12px]" alt="Product">
                @else
                    <div class="bg-[#F9FAFB] p-12 text-center rounded-t-[12px]">
                        <p class="text-[#6B7280]">No image available</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Details -->
        <div class="md:col-span-2">
            <div class="card">
                <h3 class="text-lg font-semibold text-[#111827] mb-6 pb-4 border-b border-[#E5E7EB]">Product Details</h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-1">SKU</p>
                            <p class="text-sm font-medium text-[#111827]">{{ $product->sku ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-1">Category</p>
                            <p class="text-sm font-medium text-[#111827]">{{ $product->category->name }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-1">Supplier</p>
                            <p class="text-sm font-medium text-[#111827]">{{ $product->supplier->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-1">Price</p>
                            <p class="text-lg font-bold text-[#4F46E5]">₱{{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 p-4 bg-[#F9FAFB] rounded-lg mt-4">
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Stock</p>
                            @php
                                $stock = $product->inventory?->quantity ?? 0;
                            @endphp
                            @if($stock == 0)
                                <span class="badge-danger">Out of Stock</span>
                            @elseif($stock < 10)
                                <span class="badge-warning">{{ $stock }} units</span>
                            @else
                                <span class="badge-success">{{ $stock }} units</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Reorder Level</p>
                            <p class="text-sm font-medium text-[#111827]">{{ $product->inventory?->reorder_level ?? '0' }} units</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Location</p>
                            <p class="text-sm font-medium text-[#111827]">{{ $product->inventory?->location ?? '—' }}</p>
                        </div>
                    </div>

                    @if($product->description)
                        <div class="mt-6 pt-6 border-t border-[#E5E7EB]">
                            <p class="text-xs font-semibold text-[#6B7280] uppercase tracking-wider mb-2">Description</p>
                            <p class="text-sm text-[#111827] leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Back to Products
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
