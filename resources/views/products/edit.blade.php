@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Edit Product</h3>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm mt-3">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Category *</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id)==$cat->id?'selected':'' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Type *</label>
                <select name="type" class="form-select" required>
                    <option value="TypeA" {{ old('type', $product->type)=='TypeA'?'selected':'' }}>TypeA</option>
                    <option value="TypeB" {{ old('type', $product->type)=='TypeB'?'selected':'' }}>TypeB</option>
                    <option value="TypeC" {{ old('type', $product->type)=='TypeC'?'selected':'' }}>TypeC</option>
                </select>
                @error('type') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Look *</label>
                <select name="look" class="form-select" required>
                    <option value="Casual" {{ old('look', $product->look)=='Casual'?'selected':'' }}>Casual</option>
                    <option value="Formal" {{ old('look', $product->look)=='Formal'?'selected':'' }}>Formal</option>
                </select>
                @error('look') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Finish *</label>
                <select name="finish" class="form-select" required>
                    <option value="Matte" {{ old('finish', $product->finish)=='Matte'?'selected':'' }}>Matte</option>
                    <option value="Gloss" {{ old('finish', $product->finish)=='Gloss'?'selected':'' }}>Gloss</option>
                </select>
                @error('finish') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Size *</label>
                <input type="text" name="size" value="{{ old('size', $product->size) }}" class="form-control" required>
                @error('size') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Color *</label>
                <input type="text" name="color" value="{{ old('color', $product->color) }}" class="form-control" required>
                @error('color') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Description *</label>
                <textarea name="description" rows="4" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Collection (optional)</label>
                <input type="text" name="collection" value="{{ old('collection', $product->collection) }}" class="form-control">
                @error('collection') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Technical Specification (optional)</label>
                <textarea id="technical_spec" name="technical_spec" class="form-control" rows="5">{{ old('technical_spec', $product->technical_spec) }}</textarea>
                @error('technical_spec') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Upload More Images (optional)</label>
                <input type="file" name="gallery[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.webp">
                @error('gallery.*') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>

    <hr class="my-4">
    <h5>Existing Images</h5>
    <div class="row g-2">
        @if($product->gallery && is_array($product->gallery))
            @foreach($product->gallery as $img)
                <div class="col-md-3">
                    <div class="border p-2">
                        <img src="{{ asset('storage/'.$img) }}" class="img-fluid mb-2" style="height:140px; object-fit:cover;">
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">No images</div>
        @endif
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
