@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Product Details</h3>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h4>{{ $product->name }}</h4>
            <p><strong>Category:</strong> {{ $product->category?->name ?? '-' }}</p>
            <p><strong>Type:</strong> {{ $product->type }}</p>
            <p><strong>Look:</strong> {{ $product->look }}</p>
            <p><strong>Finish:</strong> {{ $product->finish }}</p>
            <p><strong>Size:</strong> {{ $product->size }}</p>
            <p><strong>Color:</strong> {{ $product->color }}</p>
            <p><strong>Collection:</strong> {{ $product->collection ?? '-' }}</p>

            <hr>
            <h6>Description</h6>
            <p>{{ $product->description }}</p>

            <hr>
            <h6>Technical Specification</h6>
            <div>{!! $product->technical_spec ?? '<em>Not provided</em>' !!}</div>

            <hr>
            <h6>Gallery</h6>
            <div class="row g-2 mt-2">
                @if($product->gallery && is_array($product->gallery))
                    @foreach($product->gallery as $img)
                        <div class="col-md-3">
                            <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                <img src="{{ asset('storage/'.$img) }}" class="img-fluid" style="height:140px; object-fit:cover;">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">No images uploaded.</div>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
