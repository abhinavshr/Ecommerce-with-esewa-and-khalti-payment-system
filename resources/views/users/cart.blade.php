@if (count($cartItems) > 0)

@else
    <tr>
    </tr>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
</head>

<body>
    <div class="topnav">
        @include('shared.nav')
    </div>
    <div class="cart-container">
        <table class="cart-table">
            <tr>
                <td colspan="5" style="border: none; text-align:left">
                    <h1>Cart</h1>
                </td>
            </tr>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            @if (count($cartItems) > 0)
                @for ($i = 0; $i < count($cartItems); $i++)
                <tr>
                    <td>
                        <img src="{{ asset('storage/images/products/' . $cartItems[$i]->product->product_image) }}"
                            class="product-img">
                        {{ $cartItems[$i]->product->product_name }}
                    </td>
                    <td>Rs {{ $cartItems[$i]->product->product_price }}</td>
                    <td>
                        <form action="{{ route('user.cart.update', ['id' => $cartItems[$i]->id, 'product' => $cartItems[$i]->product_id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" value="{{ $cartItems[$i]->quantity }}" class="cart-input"
                                name="quantity">
                            <button class="update-cart-btn">Update Cart</button>
                        </form>
                    </td>
                    <td>Rs {{ $cartItems[$i]->product->discounted_price > 0 ? ($cartItems[$i]->product->product_price - ($cartItems[$i]->product->product_price * $cartItems[$i]->product->discounted_price / 100)) * $cartItems[$i]->quantity : $cartItems[$i]->product->product_price * $cartItems[$i]->quantity }}</td>
                    <td>
                        <form action="{{ route('user.cart.destroy', ['id' => $cartItems[$i]->id, 'productId' => $cartItems[$i]->product_id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="remove-cart-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endfor
            @else
                <tr>
                    <td colspan="5" style="border: none; text-align:left">Your cart is empty.</td>
                </tr>
            @endif
        </table>
        <div class="coupon-section">
            <form action=" {{ route('user.applycoupon') }} " method="POST">
                @csrf
                <input type="text" name="coupon_code" class="coupon-input" placeholder="Enter coupon code">
                <button class="apply-coupon-btn">Apply</button>
            </form>
        </div>

        <div class="cart-summary">
            <h2 style="background-color: #ffffff; margin-top: 20px; font-weight: bold; font-size: 50px">Cart totals</h2>
            <p>Subtotal
                <span>
                    Rs @php
                        $total = 0;
                        foreach ($cartItems as $item) {
                            $productPrice = $item->product->product_price;
                            $discountedPrice = $item->product->discounted_price;

                            if ($discountedPrice > 0) {
                                $total += ($productPrice - ($productPrice * $discountedPrice / 100)) * $item->quantity;
                            } else {
                                $total += $productPrice * $item->quantity;
                            }
                        }
                        echo $total;
                    @endphp
                </span>
            </p>
            @if (session()->has('coupon'))
                @php
                    $discountAmount = 0;
                    foreach ($cartItems as $item) {
                        $productPrice = $item->product->product_price;
                        $discountedPrice = $item->product->discounted_price;

                        if ($discountedPrice > 0) {
                            $discountAmount += ($productPrice - ($productPrice * $discountedPrice / 100)) * $item->quantity * session()->get('coupon')['coupon_discount'] / 100;
                        } else {
                            $discountAmount += $productPrice * $item->quantity * session()->get('coupon')['coupon_discount'] / 100;
                        }
                    }
                @endphp
                <p>Coupon: {{ session()->get('coupon')['coupon_name'] }}
                    <span>
                        -  Rs.{{ $discountAmount }}
                    </span>
                </p>
            @endif
            <p>Total - <span>
                Rs
                @php
                    $total = 0;
                    foreach ($cartItems as $item) {
                        $productPrice = $item->product->product_price;
                        $discountedPrice = $item->product->discounted_price;

                        if ($discountedPrice > 0) {
                            $total += ($productPrice - ($productPrice * $discountedPrice / 100)) * $item->quantity;
                        } else {
                            $total += $productPrice * $item->quantity;
                        }
                    }

                    if (session()->has('coupon')) {
                        $total -= ($total * session()->get('coupon')['coupon_discount']) / 100;
                    }
                @endphp
                {{ $total }}
            </span></p>
            @if ($cartItems->count() > 0)
                <a href=" {{ route('user.checkout', ['id' => auth()->user()->id, 'productId' => $cartItems->first()->product_id]) }} " style="text-decoration: none"><button class="proceed-btn">Proceed to Checkout</button></a>
            @endif
        </div>

    </div>
    <div class="footer">
        @include('Shared.Footer')
    </div>

</body>

</html>




