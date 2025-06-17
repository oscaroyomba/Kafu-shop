<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new product review.
     */
    public function store(Request $request, Product $product)
    {
        // ✅ Validation: Ensures proper rating and safe comment
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // ✅ Create the review tied to product & user
        $product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()
            ->route('product.show', $product->id)
            ->with('success', 'Review submitted successfully!');
    }
}