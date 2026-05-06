@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-[#111827] mb-8">{{ $category->name }}</h1>

    <div class="card mb-6">
        <h3 class="text-lg font-semibold text-[#111827] mb-4">Description</h3>
        <p class="text-sm text-[#6B7280] leading-relaxed">
            {{ $category->description ?? 'No description available' }}
        </p>
    </div>

    <a href="{{ route('categories.index') }}" class="btn-secondary">
        Back to Categories
    </a>
</div>
@endsection
