@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Inventory Report</h2>
    <p class="text-muted">Generated on: {{ now()->format('F d, Y h:i A') }}</p>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h2>{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Inventory Value</h5>
                    <h2>₱{{ number_format($totalValue, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Low Stock Items</h5>
                    <h2>{{ $lowStockItems->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Items -->
    <h4 class="mt-5 mb-3">Low Stock Items</h4>
    <div class="table-responsive">
        <table class="table table-striped table-danger">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Current Stock</th>
                    <th>Reorder Level</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lowStockItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->reorder_level }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted">No low stock items</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Transactions -->
    <h4 class="mt-5 mb-3">Recent Transactions</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $txn)
                    <tr>
                        <td>{{ $txn->transaction_date->format('m/d/Y') }}</td>
                        <td>{{ $txn->product->name }}</td>
                        <td><span class="badge {{ $txn->type === 'in' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($txn->type) }}</span></td>
                        <td>{{ $txn->quantity }}</td>
                        <td>{{ $txn->user->name }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No transactions</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
