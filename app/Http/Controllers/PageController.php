<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function aboutindex()
    {
        return view('users.aboutus');
    }

    public function contactindex()
    {
        return view('users.contactus');
    }

    public function contactusstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $contact = ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function profileindex()
    {
        $Orders = Orders::where('user_id', Auth::id())->where('payment_status', 'pending')->get();
        $user = User::where('id', Auth::id())->get();
        return view('users.profile', compact('Orders', 'user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');

        // If password is provided, update it
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Save the updated user
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function privacypolicyindex() {
        return view('users.privacypolicy');
    }

    public function termsconditionindex() {
        return view('users.termsandcondition');
    }
}
