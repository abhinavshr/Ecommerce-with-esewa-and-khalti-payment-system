<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductListCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('admin')->get();
        if (auth('admin')->check()) {
            return view('admin.product', compact('products'));
        }

        return redirect()->route('adminlogin');
    }

    public function addProduct()
    {
        return view('admin.add-product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'product_name' => 'required',
            'product_short_description' => 'required',
            'product_image' => 'required|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'product_price' => 'required|min:1',
            'product_category' => 'required',
            'product_quantity' => 'required|min:1',
            'disconted_price' => 'nullable',
            'product_status' => 'required',
            'product_description' => 'required|min:100',
        ]);

        $image = $request->file('product_image');
        $imageName = $request->input('product_name') . '.' . $image->getClientOriginalExtension();
        $request->file('product_image')->storeAs('public/images/products', $imageName);


        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'product_short_description' => $request->input('product_short_description'),
            'product_image' => $imageName,
            'product_price' => $request->input('product_price'),
            'product_category' => $request->input('product_category'),
            'product_quantity' => $request->input('product_quantity'),
            'discounted_price' => $request->input('discounted_price') ?? null,
            'product_status' => $request->input('product_status'),
            'product_description' => $request->input('product_description'),
            'admin_id' => Auth::guard('admin')->id(),

        ]);


        event(new Registered($product));

        return redirect()->route('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_short_description' => 'required',
            'product_price' => 'required|min:1',
            'product_category' => 'required',
            'product_quantity' => 'required|min:1',
            'discounted_price' => 'nullable',
            'product_status' => 'required',
            'product_description' => 'required|min:100',
        ]);

        $product = Product::findOrFail($id);

        if ($product->admin_id !== Auth::id()) {
            return redirect()->route('product')->with('error', 'Unauthorized action.');
        }

        $product->product_name = $request->input('product_name');
        $product->product_short_description = $request->input('product_short_description');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_quantity = $request->input('product_quantity');
        $product->discounted_price = $request->input('discounted_price') ?? null;
        $product->product_status = $request->input('product_status');
        $product->product_description = $request->input('product_description');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = $request->input('product_name') . '.' . $image->getClientOriginalExtension();
            $request->file('product_image')->storeAs('public/images/products', $imageName);

            if (Storage::exists('public/images/products/' . $product->product_image)) {
                Storage::delete('public/images/products/' . $product->product_image);
            }

            $product->product_image = $imageName;
        }

        $product->save();

        return redirect()->route('product')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->admin_id !== Auth::id()) {
            return redirect()->route('product')->with('error', 'Unauthorized action.');
        }

        if (Storage::exists('public/images/products/' . $product->product_image)) {
            Storage::delete('public/images/products/' . $product->product_image);
        }

        $product->delete();

        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }
}
