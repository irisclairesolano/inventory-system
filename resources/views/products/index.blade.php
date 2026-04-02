@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Products</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" width="50" alt="Product">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku ?? '-' }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>₱{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->inventory?->quantity ?? 0 }}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">View</a>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
</div>
@endsection
