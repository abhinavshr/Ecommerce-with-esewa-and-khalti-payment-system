<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin-setting');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . auth()->guard('admin')->id(),
            'password' => 'nullable|confirmed|min:8',
        ]);

        $admin = auth()->guard('admin')->user();

        if (!$admin) {
            return back()->withErrors(['error' => 'Admin not authenticated.']);
        }

        $updatedAdmin = tap($admin)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $admin->password,
        ]);

        return back()->with('success', 'Admin updated successfully!');
    }

    public function destroy(Request $request){
        $admin = Admin::findOrFail($request->id);

        $products = $admin->products;
        foreach ($products as $product) {
            if (Storage::exists('public/images/products/' . $product->product_image)) {
                Storage::delete('public/images/products/' . $product->product_image);
            }
            $product->delete();
        }

        $admin->delete();
        return redirect()->route('admin.adminlogin')->with('success', 'Admin deleted successfully!');
    }
}
