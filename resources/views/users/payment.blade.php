@if ($orders->where('payment_status', 'pending')->count() > 0)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order Success</title>
        <link rel="stylesheet" href="{{ asset('css/user/ordersuccess.css') }}">
    </head>

    <body>
        <div class="container">
            <h1>Order Successful!</h1>
            <p>Thank you for your order. Below are the details of your purchase:</p>

            <div class="order-details">
                <ul style="list-style: none; padding: 0;">
                    @foreach ($orders as $order)
                        <li style="margin-bottom: 10px;">
                            <strong>Product Name:</strong> {{ $order->cart_product_name }}
                            <br>
                            <strong>Quantity:</strong> {{ $order->cart_product_quantity }}
                        </li>
                    @endforeach
                </ul>
                <p><strong>Total Price:</strong> Rs. {{ $orders->sum('total') }}</p>
            </div>

            <div class="payment-method">
                <h3>Payment method</h3>
                <div>
                    <input type="radio" id="esewa" name="payment" checked onchange="showPaymentMethod('esewa')">
                    <label for="esewa">eSewa</label>
                </div>
                <div>
                    <input type="radio" id="khalti" name="payment" onchange="showPaymentMethod('khalti')">
                    <label for="khalti">Khalti</label>
                </div>
                <div id="esewa-payment-method" style="display: block;">
                    <form action="{{ route('user.esewa') }}" method="GET">
                        @csrf
                        <p>Pay through eSewa.</p>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button class="btn" type="submit">Proceed to eSewa Payment</button>
                    </form>
                </div>
                <div id="khalti-payment-method" style="display: none;">
                    <form action="{{ url('/khalti/verify') }}" method="POST">
                        @csrf
                    <p>Pay through Khalti.</p>
                    <button class="btn" type="submit" formaction="">Proceed to Khalti Payment</button>
                </form>
                </div>

                <script>
                    function showPaymentMethod(paymentMethod) {
                        if (paymentMethod === 'esewa') {
                            document.getElementById('esewa-payment-method').style.display = 'block';
                            document.getElementById('khalti-payment-method').style.display = 'none';
                        } else {
                            document.getElementById('esewa-payment-method').style.display = 'none';
                            document.getElementById('khalti-payment-method').style.display = 'block';
                        }
                    }

                    // Khalti Checkout
                    var khaltiConfig = {
                        publicKey: "{{ config('khalti.4c7ec7c9a3a2478fb327553da3fdfc2d') }}",
                        productIdentity: "{{ $orders->first()->id }}",
                        productName: "Order Payment",
                        productUrl: "{{ url('/orders') }}",
                        eventHandler: {
                            onSuccess(payload) {
                                fetch('/khalti/verify', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        token: payload.token,
                                        amount: {{ $orders->sum('total') * 100 }},
                                        order_id: "{{ $orders->first()->id }}"
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.message) {
                                        alert(data.message);
                                    } else {
                                        console.error(data.error);
                                    }
                                });
                            },
                            onError(error) {
                                console.error("Payment error: ", error);
                            },
                            onClose() {
                                console.log("Khalti widget closed.");
                            }
                        }
                    };
                    var khaltiCheckout = new KhaltiCheckout(khaltiConfig);
                    document.getElementById("khalti-button").onclick = function () {
                        khaltiCheckout.show({ amount: {{ $orders->sum('total') * 100 }} }); // Convert total to paisa
                    };
                </script>
            </div>
        </div>
    </body>

    </html>
@else
    <h1>Error</h1>
    <p>There is no pending order.</p>
@endif
