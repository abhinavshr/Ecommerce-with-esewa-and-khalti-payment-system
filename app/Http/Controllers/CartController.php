<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $quantity = $request->input('quantity', 1);
        if ($quantity > $product->product_quantity) {
            return redirect()->back()->withErrors("The quantity exceeds available stock.");
        }

        $userId = auth()->check() ? auth()->id() : null;

        $cartItem = CartItem::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->price = $product->price * $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->product_price * $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function index(){
        $userId = auth()->check() ? auth()->id() : null;
        $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
        return view('users.cart', compact('cartItems'));
    }

    public function update(Request $request, $id, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cartItem = CartItem::where('id', $id)->where('product_id', $productId)->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        $cartItem->quantity = $request->input('quantity');
        $cartItem->price = $cartItem->product->product_price * $request->input('quantity');
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart item updated.');
    }

    public function destroy($id, $productId){
        $cartItem = CartItem::where('id', $id)->where('product_id', $productId)->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Cart item deleted.');
    }
}
