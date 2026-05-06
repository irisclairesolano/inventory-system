@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-[#111827]">Products</h1>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn-primary">
                <span>+ Add Product</span>
            </a>
        @endif
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <x-alert type="success" :message="session('success')" class="mb-6" />
    @endif

    <!-- Table -->
    <div class="table-wrapper overflow-x-auto">
        <table class="w-full">
            <thead class="table-header">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Image</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Price</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-[#111827] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="table-row">
                        <td class="table-cell">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" width="50" height="50" alt="Product" class="rounded">
                            @else
                                <span class="text-[#6B7280]">—</span>
                            @endif
                        </td>
                        <td class="table-cell font-medium text-[#111827]">{{ $product->name }}</td>
                        <td class="table-cell text-[#6B7280]">{{ $product->sku ?? '—' }}</td>
                        <td class="table-cell text-[#6B7280]">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="table-cell font-medium">₱{{ number_format($product->price, 2) }}</td>
                        <td class="table-cell">
                            @php
                                $stock = $product->inventory?->quantity ?? 0;
                                $lowStockThreshold = 10;
                            @endphp
                            @if($stock == 0)
                                <x-badge type="danger" label="Out of Stock" />
                            @elseif($stock < $lowStockThreshold)
                                <x-badge type="warning" :label="$stock . ' Low'" />
                            @else
                                <x-badge type="success" :label="$stock . ' OK'" />
                            @endif
                        </td>
                        <td class="table-cell text-right">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('products.show', $product) }}" class="btn-sm btn-success text-xs">
                                    View
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('products.edit', $product) }}" class="btn-sm btn-primary text-xs">
                                        Edit
                                    </a>
                                    <x-delete-button
                                        :route="route('products.destroy', $product)"
                                        label="Delete"
                                        confirmMessage="Delete this product?"
                                    />
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="table-row">
                        <td colspan="7" class="table-cell text-center text-[#6B7280] py-8">
                            No products found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
