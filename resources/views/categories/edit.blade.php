@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Category</h3>

    <form action="{{ route('categories.update', $category) }}" method="POST" class="card p-4 shadow-sm mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
