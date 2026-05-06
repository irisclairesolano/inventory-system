@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-[#111827]">Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn-primary">
            <span>+ Add Category</span>
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success mb-6 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.style.display='none'" class="text-emerald-800 hover:text-emerald-900">
                ✕
            </button>
        </div>
    @endif

    <!-- Table -->
    <div class="table-wrapper overflow-x-auto">
        <table class="w-full">
            <thead class="table-header">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Products</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-[#111827] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr class="table-row">
                        <td class="table-cell font-medium text-[#111827]">{{ $cat->name }}</td>
                        <td class="table-cell text-[#6B7280]">{{ Str::limit($cat->description, 100) ?? '—' }}</td>
                        <td class="table-cell">
                            <span class="badge-success">{{ $cat->products_count }}</span>
                        </td>
                        <td class="table-cell text-right">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('categories.edit', $cat) }}" class="btn-sm btn-primary text-xs">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('categories.destroy', $cat) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="if(confirm('Delete this category?')) this.closest('form').submit();" class="btn-sm btn-danger text-xs">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="table-row">
                        <td colspan="4" class="table-cell text-center text-[#6B7280] py-8">
                            No categories found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $categories->links() }}
    </div>
</div>
@endsection
