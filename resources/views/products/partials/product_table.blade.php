<div class="card-body p-0">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Size</th>
                <th>Color</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <th>{{ $p->id }}</th>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category?->name ?? '-' }}</td>
                <td>{{ $p->type }}</td>
                <td>{{ $p->size }}</td>
                <td>{{ $p->color }}</td>
                <td class="text-center">
                    <a href="{{ route('products.show', $p) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-3">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
