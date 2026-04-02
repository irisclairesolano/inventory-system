@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr>
                        <td>{{ $cat->name }}</td>
                        <td>{{ Str::limit($cat->description, 100) ?? '-' }}</td>
                        <td>{{ $cat->products_count }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('categories.destroy', $cat) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No categories</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
</div>
@endsection
