<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-[#F7F4D5]">Inventory</h1>
        <a href="{{ route('inventory.create') }}" class="btn-primary">
            <span>+ Add Stock</span>
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
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Product</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Reorder Level</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Location</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-[#111827] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $inv)
                    <tr class="table-row">
                        <td class="table-cell font-medium text-[#111827]">{{ $inv->product->name }}</td>
                        <td class="table-cell">
                            @if($inv->quantity < $inv->reorder_level)
                                <span class="badge-warning">{{ $inv->quantity }}</span>
                            @elseif($inv->quantity == 0)
                                <span class="badge-danger">{{ $inv->quantity }}</span>
                            @else
                                <span class="badge-success">{{ $inv->quantity }}</span>
                            @endif
                        </td>
                        <td class="table-cell text-[#6B7280]">{{ $inv->reorder_level }}</td>
                        <td class="table-cell text-[#6B7280]">{{ $inv->location ?? '—' }}</td>
                        <td class="table-cell text-right">
                            <a href="{{ route('inventory.edit', $inv) }}" class="btn-sm btn-primary text-xs">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="table-row">
                        <td colspan="5" class="table-cell text-center text-[#6B7280] py-8">
                            No inventory records
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $inventory->links() }}
    </div>
</div>
</x-app-layout>