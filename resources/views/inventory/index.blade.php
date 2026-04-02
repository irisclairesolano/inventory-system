@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2>Inventory</h2>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add Stock</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr><th>Product</th><th>Quantity</th><th>Reorder Level</th><th>Location</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($inventory as $inv)
                    <tr>
                        <td>{{ $inv->product->name }}</td>
                        <td>{{ $inv->quantity }}</td>
                        <td>{{ $inv->reorder_level }}</td>
                        <td>{{ $inv->location ?? '-' }}</td>
                        <td>
                            <a href="{{ route('inventory.edit', $inv) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No inventory records</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $inventory->links() }}
</div>
@endsection
