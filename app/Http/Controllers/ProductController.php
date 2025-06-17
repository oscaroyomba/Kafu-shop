<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products with optional search and tag filtering.
     */
    public function index(Request $request)
    {
        $query = Product::with('tags');

        // ✅ Optional: Tag filter
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        // ✅ Optional: Search filter
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12);
        $tags = Tag::all();

        return view('products.index', [
            'products' => $products,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the specified product along with reviews and related products.
     */
    public function show($id)
    {
        $product = Product::with(['tags', 'reviews.user'])->findOrFail($id);
        $averageRating = $product->reviews()->avg('rating');

        // ✅ Find related products based on shared tags
        $relatedProducts = collect();
        if ($product->tags->isNotEmpty()) {
            $tagIds = $product->tags->pluck('id');

            $relatedProducts = Product::with('tags')
                ->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                })
                ->where('id', '!=', $product->id)
                ->distinct()
                ->limit(6)
                ->get();
        }

        return view('products.show', [
            'product' => $product,
            'averageRating' => $averageRating,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Optional route-based tag filter (e.g., /tags/{tag})
     */
    public function filterByTag(Tag $tag)
    {
        $products = $tag->products()->paginate(12);
        $tags = Tag::all();

        return view('products.index', [
            'products' => $products,
            'tags' => $tags,
            'activeTag' => $tag,
        ]);
    }

    /**
     * Show the form for editing a product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            // Store new image
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}