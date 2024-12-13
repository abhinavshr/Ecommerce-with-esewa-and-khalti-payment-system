<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{

    public function view(){
        if (auth()->guard('admin')->check()) {
            return redirect()->route('product');
        }
        return view('Admin.adminlogin');
    }

    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended('/admin/product');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Email or Password does not match',
        ]);

    }

    public function destory() {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.adminlogin');
    }
}
