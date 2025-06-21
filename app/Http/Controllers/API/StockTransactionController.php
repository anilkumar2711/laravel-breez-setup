<?php
namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    public function index() {
        $transactions = StockTransaction::with('product', 'user')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);

        if ($validated['type'] === 'out' && $product->quantity < $validated['quantity']) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        $transaction = StockTransaction::create([
            'product_id' => $validated['product_id'],
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
        ]);

        $product->quantity += $validated['type'] === 'in' ? $validated['quantity'] : -$validated['quantity'];
        $product->save();

        return $transaction;
    }

    public function show(StockTransaction $transaction) {
        return $transaction->load('product', 'user');
    }

    public function destroy(StockTransaction $transaction) {
        $transaction->delete();
        return response()->noContent();
    }
}
// This controller provides basic CRUD operations for stock transactions, including validation and stock management.