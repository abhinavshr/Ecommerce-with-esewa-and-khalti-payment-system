<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function everythingindex(Request $request){
        $query = Product::query();

    if ($request->has('sort')) {
        switch ($request->input('sort')) {
            case 'Latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'PriceLow':
                $query->orderBy('product_price', 'asc');
                break;
            case 'PriceHigh':
                $query->orderBy('product_price', 'desc');
                break;
            default:
                break;
        }
    }
    $products = $query->paginate(6);


    return view('products.everything', compact('products'));
    }


    public function fruitdisplay(Request $request)
    {
        $query = Product::where('product_category', 'Fruit');

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'Latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'PriceLow':
                    $query->orderBy('product_price', 'asc');
                    break;
                case 'PriceHigh':
                    $query->orderBy('product_price', 'desc');
                    break;
                default:
                    break;
            }
        }
        $products = $query->paginate(6);

        return view('products.fruit', compact('products'));
    }

    public function drinkdisplay(Request $request)
    {
        $query = Product::where('product_category', 'Drink');

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'Latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'PriceLow':
                    $query->orderBy('product_price', 'asc');
                    break;
                case 'PriceHigh':
                    $query->orderBy('product_price', 'desc');
                    break;
                default:
                    break;
            }
        }
        $products = $query->paginate(6);

        return view('products.drink', compact('products'));
    }

    public function productdisplay($id)
    {
        $product = Product::find($id);
        $product = Product::with('reviews.user')->findOrFail($id);

        return view('products.product-buy', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:500',
        ]);

        $review = new Review();
        $review->product_id = $validated['product_id'];
        $review->user_id = Auth::id();
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->save();

        return back()->with('success', 'Your review has been submitted successfully.');
    }
}
