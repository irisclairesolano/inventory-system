@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Suppliers</h2>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add Supplier</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr><th>Name</th><th>Email</th><th>Phone</th><th>Products</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($suppliers as $sup)
                    <tr>
                        <td>{{ $sup->name }}</td>
                        <td>{{ $sup->email ?? '-' }}</td>
                        <td>{{ $sup->phone ?? '-' }}</td>
                        <td>{{ $sup->products_count }}</td>
                        <td>
                            <a href="{{ route('suppliers.edit', $sup) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('suppliers.destroy', $sup) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No suppliers</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $suppliers->links() }}
</div>
@endsection
