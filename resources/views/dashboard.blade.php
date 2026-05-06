@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-[#F7F4D5]">Dashboard</h1>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card">
                <div class="text-[#839958] text-sm font-medium">Total Products</div>
                <div class="text-4xl font-bold text-[#D3968C] mt-3">{{ $totalProducts ?? 0 }}</div>
            </div>

            <div class="card">
                <div class="text-[#839958] text-sm font-medium">Low Stock Items</div>
                <div class="text-4xl font-bold text-[#D3968C] mt-3">{{ $lowStockItems ?? 0 }}</div>
            </div>

            <div class="card">
                <div class="text-[#839958] text-sm font-medium">Recent Transactions</div>
                <div class="text-4xl font-bold text-[#839958] mt-3">{{ $recentTransactions->count() ?? 0 }}</div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card mb-8">
            <h3 class="text-lg font-semibold mb-6 text-[#0A3323]">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <a href="{{ route('products.index') }}" class="btn-primary text-center">
                    View Products
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="btn-primary text-center">
                        Add Product
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn-primary text-center">
                        Manage Categories
                    </a>
                    <a href="{{ route('reports.index') }}" class="btn-primary text-center">
                        View Reports
                    </a>
                @endif
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="card">
            <h3 class="text-lg font-semibold mb-6 text-[#111827]">Recent Transactions</h3>

            @if($recentTransactions && $recentTransactions->count() > 0)
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
                            @foreach($recentTransactions as $txn)
                            <tr class="table-row">
                                <td class="table-cell">{{ $txn->transaction_date->format('m/d/Y') }}</td>
                                <td class="table-cell font-medium">{{ $txn->product->name ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    @if($txn->type === 'in')
                                        <span class="badge-success">IN</span>
                                    @else
                                        <span class="badge-danger">OUT</span>
                                    @endif
                                </td>
                                <td class="table-cell font-medium">{{ $txn->quantity }}</td>
                                <td class="table-cell text-[#6B7280]">{{ $txn->user->name ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-[#6B7280] text-sm">No transactions yet. Start by adding products and inventory items.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
