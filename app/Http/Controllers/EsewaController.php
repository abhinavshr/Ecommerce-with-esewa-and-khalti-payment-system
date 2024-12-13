<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


// Init composer autoloader.
// require dirname(__DIR__) . '../vendor/autoload.php';
require '../vendor/autoload.php';


use RemoteMerge\Esewa\Client;


class EsewaController extends Controller
{
    public function esewapay(Request $request)
    {
        $orderId = $request->order_id;
        $order = Orders::find($orderId);

        if (!$order) {
            Log::error('Order not found: ' . $orderId);
            return redirect()->route('user.payment.fail')->with('error', 'Order not found.');
        }

        $price = $order->total;

        $paymentData = [
            'amt' => $price,
            'psc' => 0,
            'txAmt' => 0,
            'pdc' => 0,
            'tAmt' => $price,
            'pid' => 'ORDER_' . $orderId . '_' . time(),
            'scd' => 'EPAYTEST',
            'su' => route('user.payment.success', ['order_id' => $orderId]),
            'fu' => route('user.payment.fail'),
        ];


        $queryString = http_build_query($paymentData);

        Log::info('esewa query string: ' . $queryString);

        // Redirect to eSewa with the generated query string
        return redirect()->away('https://uat.esewa.com.np/epay/main?' . $queryString);
        // return redirect()->away('https://uat.esewa.com.np/epay/transrec?' . $queryString);

    }

    // public function success(Request $request)
    // {
    //     $orderId = $request->order_id;
    //     $order = Orders::find($orderId);

    //     if (!$order) {
    //         return redirect()->route('user.payment.fail')->with('error', 'Order not found.');
    //     }

    //     // if (!$request->refId) {
    //     //     Log::error('Missing refId from eSewa.');
    //     //     return redirect()->route('user.payment.fail')->with('error', 'Missing refId.');
    //     // }

    //     $pid = 'ORDER_' . $orderId . '_' . $order->created_at->timestamp;
    //     $amt = number_format($order->total, 2, '.', '');


    //     // Verify payment with eSewa API
    //     $response = Http::post('https://uat.esewa.com.np/epay/transrec', [
    //         'amt' => $amt,
    //         'pid' => $pid,
    //         'scd' => 'EPAYTEST',
    //         'rid' => $request->refId,
    //     ]);

    //     Log::info('eSewa Verification Request Data:', [
    //         'amt' => $amt,
    //         'pid' => $pid,
    //         'scd' => 'EPAYTEST',
    //         'rid' => $request->refId,
    //     ]);

    //     // Log::info('eSewa API Response: ' . $response->body());

    //     if (strpos($response->body(), 'Success') !== false) {
    //         $order->payment_status = 'Paid';
    //         $order->save();

    //         return view('users.successpayment');
    //     }

    //     // Log::error('Payment verification failed for Order ID: ' . $orderId);

    //     return redirect()->route('user.payment.fail')->with('error', 'Payment verification failed.');
    // }

    public function success(Request $request)
    {
        $orderId = $request->input('order_id');

        if ($orderId) {
            $order = Orders::find($orderId);

            if ($order) {
                $order->payment_status = 'paid';
                $order->save();
            } else {
                return redirect()->back()->withErrors(['error' => 'Order not found']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Order ID is missing']);
        }

        return view('users.successpayment');
    }


    // Failure route if payment fails
    public function fail(Request $request)
    {
        $error = $request->input('error_message', 'Payment failed. Please try again.');

        return view('users.paymentfail', compact('error'));
    }

    // Cancel route if payment is canceled
    public function cancel(Request $request)
    {
        // Handle canceled payment
        // Store cancel message in session
        session()->flash('message', 'Payment was canceled by the user.');

        // Redirect to a page (like the homepage or order details page) with the cancel message
        return redirect()->route('user.home')->with('message', 'Payment was canceled.');
    }
}
