<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products with live search & sort.
     */
public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', "%{$request->search}%");
    }

    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc'); break;
            case 'name_desc':
                $query->orderBy('name', 'desc'); break;
            case 'newest':
                $query->orderBy('created_at', 'desc'); break;
            default:
                $query->latest();
        }
    } else {
        $query->latest();
    }

    $products = $query->paginate(10)->withQueryString();

    if ($request->ajax()) {
        return view('products.partials.product_table', compact('products'))->render();
    }

    return view('products.index', compact('products'));
}





    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Handle gallery uploads
        $galleryArr = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $img) {
                $galleryArr[] = $img->store('products', 'public');
            }
        }
        $data['gallery'] = $galleryArr;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $galleryArr = $product->gallery ?? [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $img) {
                $galleryArr[] = $img->store('products', 'public');
            }
        }

        $data['gallery'] = $galleryArr;

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete images from storage
        if ($product->gallery) {
            foreach ($product->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
