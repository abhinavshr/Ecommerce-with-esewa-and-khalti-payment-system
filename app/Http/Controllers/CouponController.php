<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();
        return view('admin.coupon', compact('coupons'));
    }

    public function addcoupanindex(){
        return view('admin.add-coupon');
    }

    public function store(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required|integer|min:1|max:100',
            'min_price' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        Coupon::create([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'min_price' => $request->min_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('coupon')->with('success', 'Coupon added successfully!');
    }


    public function applyCoupon(Request $request){
        $coupon_name = $request->coupon_code;
        $coupon = Coupon::where('coupon_name', $coupon_name)->first();
        if($coupon){
            if($coupon->end_date >= date('Y-m-d')){
                session()->put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount
                ]);
                return redirect()->back()->with('success', 'Coupon applied successfully!');
            }else{
                return redirect()->back()->with('error', 'Coupon expired!');
            }
        }else{
            return redirect()->back()->with('error', 'Invalid coupon!');
        }
    }
}
