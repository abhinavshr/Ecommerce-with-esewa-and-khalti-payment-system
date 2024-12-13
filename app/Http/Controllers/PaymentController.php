<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Orders::where('user_id', Auth::id())->where('payment_status', 'pending')->get();
        return view('users.payment', compact('orders'));
    }
}
