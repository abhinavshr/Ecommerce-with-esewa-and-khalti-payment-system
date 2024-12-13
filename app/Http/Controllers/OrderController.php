<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\DeliveryLocations;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $Locations = DeliveryLocations::all();
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        return view('users.orders', compact('Locations', 'cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'street_address' => 'required|string',
            'postcode' => 'nullable|string',
            'total_price' => 'required',
            'product_name' => 'required|array',
            'order_quantity' => 'required|array',
        ]);

        $total = $request->input('total');
        $productNames = implode(',', $request->input('product_name'));
        $productQuantities = implode(',', $request->input('order_quantity'));

        $order = Orders::create([
            'user_id' => Auth::id(),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'company_name' => $request->input('company_name'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'street_address' => $request->input('street_address'),
            'postcode' => $request->input('postcode'),
            'order_notes' => $request->input('order-notes'),
            'total' => $request->input('total_price'),
            'cart_product_name' => $productNames,
            'cart_product_quantity' => $productQuantities,
            'payment_status' => 'pending',
        ]);

        foreach ($request->input('product_name') as $key => $product) {
            $item = CartItem::where('user_id', Auth::id())->where('product_id', $product)->first();
            if ($item) {
                $item->product->decrement('product_quantity', $request->input('cart_product_quantity')[$key]);
                $item->product->save();
            }
        }

        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('user.payment')->with('success', 'Order placed successfully!');
    }
}
