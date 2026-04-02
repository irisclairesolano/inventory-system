@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $category->name }}</h2>
    <p>{{ $category->description ?? 'No description' }}</p>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
