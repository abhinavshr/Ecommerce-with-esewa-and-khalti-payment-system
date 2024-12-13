<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function view(){
        return view('users.register');
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
            'phone_number' => 'required|min:10|numeric',
            'address' => 'required',
            'profile_image' => 'required|mimetypes:image/jpeg,image/png,image/webp|max:2048',
        ]);

        $image = $request->file('profile_image');
        $imageName = $request->input('username') . '.' . $image->getClientOriginalExtension();
        $request->file('profile_image')->storeAs('public/images/users', $imageName);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'profile_image' => $imageName
        ]);

        event(new Registered($user));

        return redirect()->route('user.userlogin')->with('success', 'User registered successfully!');

    }

    public function login(){
        return view('users.login');
    }

    public function logincheck(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('user.home')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials!');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('user.home')->with('success', 'Logout successful!');
    }
}
