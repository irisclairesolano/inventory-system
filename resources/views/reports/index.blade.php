@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-semibold text-[#111827]">Inventory Report</h1>
            <p class="text-sm text-[#6B7280] mt-2">Generated on: {{ now()->format('F d, Y h:i A') }}</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card">
            <div class="text-[#6B7280] text-sm font-medium">Total Products</div>
            <div class="text-4xl font-bold text-[#4F46E5] mt-3">{{ $totalProducts }}</div>
        </div>

        <div class="card">
            <div class="text-[#6B7280] text-sm font-medium">Total Inventory Value</div>
            <div class="text-4xl font-bold text-[#10B981] mt-3">₱{{ number_format($totalValue, 2) }}</div>
        </div>

        <div class="card">
            <div class="text-[#6B7280] text-sm font-medium">Low Stock Items</div>
            <div class="text-4xl font-bold text-[#EF4444] mt-3">{{ $lowStockItems->count() }}</div>
        </div>
    </div>

    <!-- Low Stock Items -->
    <div class="card mb-8">
        <h3 class="text-lg font-semibold text-[#111827] mb-6 pb-4 border-b border-[#E5E7EB]">Low Stock Items</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Current Stock</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Reorder Level</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockItems as $item)
                        <tr class="table-row">
                            <td class="table-cell font-medium text-[#111827]">{{ $item->product->name }}</td>
                            <td class="table-cell">
                                <span class="badge-warning">{{ $item->quantity }} units</span>
                            </td>
                            <td class="table-cell text-[#6B7280]">{{ $item->reorder_level }} units</td>
                        </tr>
                    @empty
                        <tr class="table-row">
                            <td colspan="3" class="table-cell text-center text-[#6B7280] py-8">
                                No low stock items
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card">
        <h3 class="text-lg font-semibold text-[#111827] mb-6 pb-4 border-b border-[#E5E7EB]">Recent Transactions</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#111827] uppercase tracking-wider">By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $txn)
                        <tr class="table-row">
                            <td class="table-cell">{{ $txn->transaction_date->format('m/d/Y') }}</td>
                            <td class="table-cell font-medium">{{ $txn->product->name }}</td>
                            <td class="table-cell">
                                @if($txn->type === 'in')
                                    <span class="badge-success">IN</span>
                                @else
                                    <span class="badge-danger">OUT</span>
                                @endif
                            </td>
                            <td class="table-cell font-medium">{{ $txn->quantity }}</td>
                            <td class="table-cell text-[#6B7280]\">{{ $txn->user->name }}</td>
                        </tr>
                    @empty
                        <tr class="table-row">
                            <td colspan="5" class="table-cell text-center text-[#6B7280] py-8">
                                No transactions
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
