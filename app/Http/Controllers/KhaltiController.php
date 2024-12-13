<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KhaltiController extends Controller
{
    public function verifyPayment(Request $request)
    {
        // Step 1: Retrieve the order using the order ID
        $order = Orders::find($request->order_id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found!'
            ], 404);
        }

        // Step 2: Check if the payment amount matches the order amount
        $expectedAmount = $order->amount * 100; // Convert to paisa
        if ($expectedAmount != $request->amount) {
            return response()->json([
                'message' => 'Invalid payment amount!'
            ], 400);
        }

        // Step 3: Verify payment with Khalti API
        $url = config('khalti.base_url') . 'payment/verify/';
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('khalti.secret_key')
        ])->post($url, [
            'token' => $request->token,
            'amount' => $request->amount
        ]);

        if ($response->successful()) {
            // Step 4: Update the order status to 'paid'
            $order->status = 'paid';
            $order->save();

            return response()->json([
                'message' => 'Payment successful!',
                'data' => $response->json()
            ]);
        }

        return response()->json([
            'message' => 'Payment verification failed!',
            'error' => $response->json()
        ], 400);
    }
}
