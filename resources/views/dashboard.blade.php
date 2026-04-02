@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-600 text-sm font-medium">Total Products</div>
                <div class="text-4xl font-bold text-blue-600 mt-3">{{ $totalProducts ?? 0 }}</div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-600 text-sm font-medium">Low Stock Items</div>
                <div class="text-4xl font-bold text-red-600 mt-3">{{ $lowStockItems ?? 0 }}</div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-600 text-sm font-medium">Recent Transactions</div>
                <div class="text-4xl font-bold text-green-600 mt-3">{{ $recentTransactions->count() ?? 0 }}</div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h3 class="text-xl font-semibold mb-6 text-gray-900">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <a href="{{ route('products.index') }}" class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-center font-medium">
                    View Products
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 text-center font-medium">
                        Add Product
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-4 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 text-center font-medium">
                        Manage Categories
                    </a>
                    <a href="{{ route('reports.index') }}" class="px-4 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 text-center font-medium">
                        View Reports
                    </a>
                @endif
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-6 text-gray-900">Recent Transactions</h3>

            @if($recentTransactions && $recentTransactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $txn)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $txn->transaction_date->format('m/d/Y') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $txn->product->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-3 py-1 rounded-full text-white text-xs font-semibold {{ $txn->type === 'in' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ strtoupper($txn->type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $txn->quantity }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $txn->user->name ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No transactions yet. Start by adding products and inventory items.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
