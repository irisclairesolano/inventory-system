<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-semibold text-[#F7F4D5]">Transactions</h1>
            <p class="text-sm text-[#6B7280] mt-2">Log and track all inventory movements</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn-primary">
            + Record Transaction
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-6">
            {{ session('success') }}
            <button type="button" class="absolute right-4 top-4 text-[#6B7280] hover:text-[#111827]"
                onclick="this.parentElement.style.display='none';">
                ×
            </button>
        </div>
    @endif

    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Recorded By</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Notes</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $txn)
                        <tr class="table-row">
                            <td class="table-cell text-sm">{{ $txn->transaction_date->format('m/d/Y') }}</td>
                            <td class="table-cell font-medium">{{ $txn->product->name }}</td>
                            <td class="table-cell">
                                @if($txn->type === 'in')
                                    <span class="badge-success">IN</span>
                                @else
                                    <span class="badge-danger">OUT</span>
                                @endif
                            </td>
                            <td class="table-cell font-semibold text-[#111827]">{{ $txn->quantity }}</td>
                            <td class="table-cell text-[#6B7280]">{{ $txn->user->name }}</td>
                            <td class="table-cell text-[#6B7280] text-sm">{{ $txn->notes ?? '-' }}</td>
                            <td class="table-cell">
                                <div class="flex gap-3">
                                    <a href="{{ route('transactions.edit', $txn) }}" class="text-[#4F46E5] hover:text-[#4338CA] font-medium text-sm">Edit</a>
                                    <form action="{{ route('transactions.destroy', $txn) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this transaction?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#EF4444] hover:text-[#DC2626] font-medium text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-row">
                            <td colspan="7" class="table-cell text-center text-[#6B7280] py-8">
                                No transactions recorded yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($transactions->hasPages())
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
</x-app-layout>