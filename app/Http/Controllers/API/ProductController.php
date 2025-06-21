<?php
namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);
        $row = Product::create($validated);
        // Check if request come same domain then redirect to web route
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $row,
                'message' => 'Product created successfully'
            ], 201);
        } else {
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }
    }

    public function show(Product $product) {
        return $product;
    }

    public function update(Request $request, Product $product) {
        $product->update($request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]));

        return $product;
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->noContent();
    }
}
// This controller provides basic CRUD operations for products.