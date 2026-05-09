<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-[#F7F4D5]">Dashboard</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card flex items-center justify-between">
                <div>
                    <div class="text-[#839958] text-sm font-semibold uppercase tracking-wider">Total Products</div>
                    <div class="text-4xl font-bold text-[#0A3323] mt-2">{{ $totalProducts ?? 0 }}</div>
                </div>
                <div class="p-3 bg-[#839958] bg-opacity-10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#839958]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                </div>
            </div>

            <div class="card flex items-center justify-between">
                <div>
                    <div class="text-[#839958] text-sm font-semibold uppercase tracking-wider">Low Stock Items</div>
                    <div class="text-4xl font-bold text-[#D3968C] mt-2">{{ $lowStockItems ?? 0 }}</div>
                </div>
                <div class="p-3 bg-[#D3968C] bg-opacity-10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#D3968C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                </div>
            </div>

            <div class="card flex items-center justify-between">
                <div>
                    <div class="text-[#839958] text-sm font-semibold uppercase tracking-wider">Transactions</div>
                    <div class="text-4xl font-bold text-[#839958] mt-2">{{ $recentTransactions->count() ?? 0 }}</div>
                </div>
                <div class="p-3 bg-[#839958] bg-opacity-10 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#839958]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 3 4 4-4 4"></path><path d="M8 7h12"></path><path d="m8 13-4 4 4 4"></path><path d="M20 17H4"></path></svg>
                </div>
            </div>
        </div>

        <div class="card mb-8">
            <h3 class="text-lg font-semibold mb-6 text-[#0A3323]">
                Quick Actions
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

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
  
        <div class="card">
            <h3 class="text-lg font-semibold mb-6 text-[#0A3323]">Recent Transactions</h3>

            @if($recentTransactions && $recentTransactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Product</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $txn)
                            <tr class="table-row">
                                <td class="table-cell text-[#0A3323]">{{ $txn->transaction_date->format('m/d/y') }}</td>
                                <td class="table-cell font-medium text-[#0A3323]">{{ $txn->product->name ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    @if($txn->type === 'in')
                                        <span class="badge-success text-[10px]">STOCK IN</span>
                                    @else
                                        <span class="badge-danger text-[10px]">STOCK OUT</span>
                                    @endif
                                </td>
                                <td class="table-cell font-bold text-[#0A3323]">{{ $txn->quantity }}</td>
                                <td class="table-cell text-[#839958]">{{ $txn->user->name ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-center">
                <img src="{{ asset('images/transaction-empty.png') }}" alt="No transactions" class="w-40 sm:w-48 h-auto mb-5 opacity-80">
                    <h4 class="text-[#0A3323] font-semibold text-lg">No transactions yet</h4>
                    <p class="text-[#839958] text-sm max-w-xs mt-2">
                        Start by adding products and inventory items to see your activity logs here.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>