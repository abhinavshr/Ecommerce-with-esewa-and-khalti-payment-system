<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    public function view(){
        return view('Admin.adminregister');
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        event(new Registered($admin));

        return redirect()->route('admin.adminlogin')->with('success', 'Admin registered successfully!');
        }
    }
