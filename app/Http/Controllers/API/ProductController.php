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

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
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
        // Check if request come same domain then redirect to web route
        if (request()->is('api/*')) {
            return response()->json([
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ], 200);
        } else {
            return view('products.show', compact('product'));
        }
    }

    public function update(Request $request, Product $product) {
        $product->update($request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]));
        // Check if request come same domain then redirect to web route
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $product,
                'message' => 'Product updated successfully'
            ], 200);
        } else {
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        }
    }

    public function destroy(Product $product) {
        $product->delete();
        // Check if request come same domain then redirect to web route
        if (request()->is('api/*')) {
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 204);
        } else {
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
    }
}
// This controller provides basic CRUD operations for products.