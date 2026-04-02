@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $product->name }}</h2>

    <div class="row">
        <div class="col-md-4">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" class="img-fluid" alt="Product">
            @else
                <div class="bg-light p-5 text-center">No image</div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <ul class="list-unstyled">
                        <li><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</li>
                        <li><strong>Category:</strong> {{ $product->category->name }}</li>
                        <li><strong>Supplier:</strong> {{ $product->supplier->name }}</li>
                        <li><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</li>
                        <li><strong>Stock:</strong> {{ $product->inventory?->quantity ?? 0 }} units</li>
                        <li><strong>Reorder Level:</strong> {{ $product->inventory?->reorder_level ?? 0 }}</li>
                        <li><strong>Location:</strong> {{ $product->inventory?->location ?? 'N/A' }}</li>
                    </ul>

                    @if($product->description)
                        <div class="mt-3">
                            <strong>Description:</strong>
                            <p>{{ $product->description }}</p>
                        </div>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <div class="mt-3">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    @else
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
