@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Add Product</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Category -->
            <div>
                <label class="block font-medium text-gray-700">Category *</label>
                <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Product Name -->
            <div>
                <label class="block font-medium text-gray-700">Product Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Type -->
                <div>
                    <label class="block font-medium text-gray-700">Type *</label>
                    <select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select</option>
                        <option value="TypeA" {{ old('type')=='TypeA'?'selected':'' }}>TypeA</option>
                        <option value="TypeB" {{ old('type')=='TypeB'?'selected':'' }}>TypeB</option>
                        <option value="TypeC" {{ old('type')=='TypeC'?'selected':'' }}>TypeC</option>
                    </select>
                    @error('type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Look -->
                <div>
                    <label class="block font-medium text-gray-700">Look *</label>
                    <select name="look" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select</option>
                        <option value="Casual" {{ old('look')=='Casual'?'selected':'' }}>Casual</option>
                        <option value="Formal" {{ old('look')=='Formal'?'selected':'' }}>Formal</option>
                    </select>
                    @error('look') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Finish -->
                <div>
                    <label class="block font-medium text-gray-700">Finish *</label>
                    <select name="finish" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select</option>
                        <option value="Matte" {{ old('finish')=='Matte'?'selected':'' }}>Matte</option>
                        <option value="Gloss" {{ old('finish')=='Gloss'?'selected':'' }}>Gloss</option>
                    </select>
                    @error('finish') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Size -->
                <div>
                    <label class="block font-medium text-gray-700">Size *</label>
                    <input type="text" name="size" value="{{ old('size') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('size') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Color -->
                <div>
                    <label class="block font-medium text-gray-700">Color *</label>
                    <input type="text" name="color" value="{{ old('color') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('color') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium text-gray-700">Description *</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Collection -->
            <div>
                <label class="block font-medium text-gray-700">Collection (optional)</label>
                <input type="text" name="collection" value="{{ old('collection') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('collection') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Technical Spec -->
            <div>
                <label class="block font-medium text-gray-700">Technical Specification (optional)</label>
                <textarea id="technical_spec" name="technical_spec" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('technical_spec') }}</textarea>
                @error('technical_spec') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Gallery -->
            <div>
                <label class="block font-medium text-gray-700">Gallery Images * (jpg, png, webp | max 2MB each)</label>
                <input type="file" name="gallery[]" class="mt-1 block w-full" multiple accept=".jpg,.jpeg,.png,.webp" required>
                @error('gallery') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                @error('gallery.*') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Buttons -->
          <div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-success">Save Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        if (document.getElementById('technical_spec')) {
            CKEDITOR.replace('technical_spec');
        }
    });
</script>
@endpush
@endsection
