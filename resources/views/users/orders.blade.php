<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="{{ asset('css/user/checkout.css') }}">
</head>

<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <div class="coupon-section">
            <form action="{{ route('user.applycoupon') }}" method="POST">
                @csrf
                <input type="text" name="coupon_code" class="coupon-input" placeholder="Enter coupon code">
                <button class="apply-coupon-btn">Apply</button>
            </form>
        </div>

        <form class="billing-form" action="{{ route('user.payment.store') }}" method="POST">
            @csrf
            <h2>Billing Details</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="first_name">First Name <span>*</span></label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name <span>*</span></label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name (optional)</label>
                <input type="text" id="company_name" name="company_name">
            </div>

            <div class="form-group">
                <label for="country">Country / Region <span>*</span></label>
                <select id="country" name="country" required>
                    <option value="" disabled selected>Select your country</option>
                    <option value="Nepal">Nepal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="state">State / Zone <span>*</span></label>
                <select id="state" name="state" required>
                    <option value="" disabled selected>Select your state</option>
                    <option value="Bagmati">Bagmati</option>
                </select>
            </div>

            <div class="form-group">
                <label for="city">Town / City <span>*</span></label>
                <select id="city" name="city" required onchange="updateLocationPrice(this.value)">
                    <option value="" disabled selected>Select your city</option>
                    @foreach ($Locations as $location)
                        <option value="{{ $location->price }}">{{ $location->location }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="street_address">Street Address <span>*</span></label>
                <input type="text" id="street_address" name="street_address" required>
            </div>

            <div class="form-group">
                <label for="postcode">Postcode / ZIP (optional)</label>
                <input type="text" id="postcode" name="postcode">
            </div>

            <div class="form-group">
                <label for="phone">Phone <span>*</span></label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address <span>*</span></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="order-notes">Order Notes (optional)</label>
                <textarea id="order-notes" name="order-notes"></textarea>
            </div>

            <div class="order-summary">
                <h2>Your Order</h2>
                <div class="order-item">
                    <span>Product</span>
                    <span>Subtotal</span>
                </div>
                <div class="order-item-list">
                    @if (count($cartItems) > 0)
                        @foreach ($cartItems as $cartitem)
                            <div class="order-item">
                                <span>{{ $cartitem->product->product_name }} × {{ $cartitem->quantity }}</span>
                                <span>
                                    Rs
                                    @if ($cartitem->product->discounted_price > 0)
                                        {{ ($cartitem->product->product_price - ($cartitem->product->product_price * $cartitem->product->discounted_price) / 100) * $cartitem->quantity }}
                                    @else
                                        {{ $cartitem->product->product_price * $cartitem->quantity }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                        <div class="order-item">
                            <span>Delivery Price:</span>
                            <span id="location-price-value">Rs 0</span>
                        </div>
                        @if (session()->has('coupon'))
                            @php
                                $discountAmount = 0;
                                foreach ($cartItems as $item) {
                                    $productPrice = $item->product->product_price;
                                    $discountedPrice = $item->product->discounted_price;

                                    if ($discountedPrice > 0) {
                                        $discountAmount +=
                                            (($productPrice - ($productPrice * $discountedPrice) / 100) *
                                                $item->quantity *
                                                session()->get('coupon')['coupon_discount']) /
                                            100;
                                    } else {
                                        $discountAmount +=
                                            ($productPrice *
                                                $item->quantity *
                                                session()->get('coupon')['coupon_discount']) /
                                            100;
                                    }
                                }
                            @endphp
                            <div class="order-item">
                                <span>Coupon: {{ session()->get('coupon')['coupon_name'] }}</span>
                                <span>- Rs {{ $discountAmount }}</span>
                            </div>
                        @endif
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>

                <div class="order-total">
                    <span>Total</span>
                    <span id="total-price">Rs 0</span>
                    <input type="hidden" id="hidden-total-price" name="total_price" value="0">
                </div>
                @foreach ($cartItems as $item)
                    <input type="hidden" name="product_name[]" value="{{ $item->product->product_name }}">
                    <input type="hidden" name="order_quantity[]" value="{{ $item->quantity }}">
                @endforeach

                <button class="btn" type="submit">Proceed to Payment</button>
            </div>
        </form>
    </div>

    <script>
        function updateLocationPrice(selectedPrice) {
            let totalPrice = 0;
            let finalPrice = 0;
            if (selectedPrice) {
                document.getElementById('location-price-value').innerText = `Rs ${selectedPrice}`;

                @if (count($cartItems) > 0)
                    @foreach ($cartItems as $cartitem)
                        @if ($cartitem->product->discounted_price > 0)
                            totalPrice += ({{ $cartitem->product->product_price }} - (
                                {{ $cartitem->product->product_price }} *
                                {{ $cartitem->product->discounted_price }} / 100)) * {{ $cartitem->quantity }};
                        @else
                            totalPrice += {{ $cartitem->product->product_price * $cartitem->quantity }};
                        @endif
                    @endforeach
                    @if (session()->has('coupon'))
                        totalPrice -= {{ $discountAmount }};
                    @endif
                @endif

                finalPrice = totalPrice + parseInt(selectedPrice);
                document.getElementById('total-price').innerText = `Rs ${finalPrice}`;
                document.getElementById('hidden-total-price').value = finalPrice;
            }
        }

        // document.querySelector('.billing-form').addEventListener('submit', function(event) {
        //     const hiddenTotalPrice = document.getElementById('hidden-total-price');
        //     if (hiddenTotalPrice.value === "0" || hiddenTotalPrice.value === "") {
        //         // Recalculate total price if not set
        //         let totalPrice = 0;

        //         @if (count($cartItems) > 0)
        //             @foreach ($cartItems as $cartitem)
        //                 totalPrice += {{ $cartitem->product->product_price * $cartitem->quantity }};
        //             @endforeach
        //             @if (session()->has('coupon'))
        //                 totalPrice -=
        //                     {{ session()->has('coupon') ? (session()->get('coupon')['coupon_discount'] / 100) * (array_sum(array_column($cartItems->toArray(), 'product_price')) * array_sum(array_column($cartItems->toArray(), 'quantity'))) : 0 }};
        //             @endif
        //         @endif

        //         const selectedPrice = parseInt(document.getElementById('city').value || 0);
        //         const finalPrice = totalPrice + selectedPrice;

        //         document.getElementById('total-price').innerText = `Rs ${finalPrice}`;
        //         hiddenTotalPrice.value = finalPrice;
        //     }
        // });
    </script>

</body>

</html>
