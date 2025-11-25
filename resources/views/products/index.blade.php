@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Products</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('categories.create') }}" class="btn btn-success">+ Add Category</a>
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
        </div>
    </div>

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search & Sort --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="search" class="form-control" placeholder="Search by name">
        </div>
        <div class="col-md-3">
            <select id="sort" class="form-select">
                <option value="">Sort</option>
                <option value="name_asc">Name ↑</option>
                <option value="name_desc">Name ↓</option>
                <option value="newest">Newest</option>
            </select>
        </div>
    </div>

    {{-- Products Table --}}
    <div class="card shadow-sm" id="product-table">
        @include('products.partials.product_table', ['products' => $products])
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    let typingTimer;

    function fetchProducts(page = 1){
        let query = $('#search').val();
        let sort = $('#sort').val();

        $.ajax({
            url: "{{ route('products.index') }}",
            type: 'GET',
            data: { search: query, sort: sort, page: page },
            success: function(data){
                $('#product-table').html(data);

                // Update URL
                let newUrl = "{{ route('products.index') }}" + "?page=" + page + "&search=" + query + "&sort=" + sort;
                history.pushState(null, '', newUrl);
            }
        });
    }

    // Live search with debounce
    $('#search').on('keyup', function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function(){
            fetchProducts();
        }, 300);
    });

    // Sort
    $('#sort').on('change', function(){
        fetchProducts();
    });

    // Pagination links
    $(document).on('click', '#product-table .pagination a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchProducts(page);
    });

});
</script>
@endpush
