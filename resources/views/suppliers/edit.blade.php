@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Supplier</h2>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $supplier->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $supplier->email) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $supplier->phone) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
