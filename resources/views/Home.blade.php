<link rel="stylesheet" href="{{ asset('css/Home.css') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
@include('Shared.Nav')

<div class="hero-section">
    <div class="image-container">
        <img src="{{ asset('images/organic-product.svg') }}" alt="Organic Image" class="organic-image">
    </div>
    <div class="content-container">
        <img src="{{ asset('images/leaf.png') }}" alt="Leaf Image" class="leaf-image">
        <h3>Best Qualtity Product</h3>
        <h1 style="font-size: 3vw;">Join The Organic Movement</h1>
        <p style="font-size: 1vw;">Join the organic movement and be part of a healthier, more sustainable future!</p>
        <button class="Shop-Button"><span class="material-symbols-outlined">shopping_cart</span>Shop Now</button>
    </div>
</div>
<div class="container1">
    <div class="container1-1">
        <div class="left-icon">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">local_shipping</span>
        </div>
        <div class="right-content">
            <h2>Free Shipping</h2>
            <p style="margin-top: -16px;">Above RS. 999 Only</p>
        </div>
    </div>
    <div class="container1-2">
        <div class="left-icon">
            <span class="material-symbols-outlined">license</span>
        </div>
        <div class="right-content">
            <h2>Certified Organic</h2>
            <p style="margin-top: -16px;">100% Guarantee</p>
        </div>
    </div>
    <div class="container1-3">
        <div class="left-icon">
            <span class="material-symbols-outlined">payments</span>
        </div>
        <div class="right-content">
            <h2>Huge Saving</h2>
            <p style="margin-top: -16px;">At Lowest Price</p>
        </div>
    </div>
    <div class="container1-4">
        <div class="left-icon">
            <span class="material-symbols-outlined">recycling</span>
        </div>
        <div class="right-content">
            <h2>Esay Return</h2>
            <p style="margin-top: -16px;">No Question Asked</p>
        </div>
    </div>
</div>
<div class="best-selling-product">
    <h1>Best Selling Product</h1>
    <img src="{{ asset('images/leaf.png') }}" alt="Leaf Image" class="leaf-image">

    <div class="product-container">
        @php
            $topReviewedProducts = \App\Models\Product::withCount('reviews')
                                    ->orderBy('reviews_count', 'desc')
                                    ->limit(3)
                                    ->get();
        @endphp
        @foreach ($topReviewedProducts as $product)
            <div class="product-card">
                <a href="{{ route('user.product', ['id' => $product->id]) }}"><img src="{{ asset('storage/images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="product-image" ></a>
                <h2>{{ $product->product_name }}</h2>
                <p>{{ $product->reviews_count > 0 ? $product->reviews_count . ' Reviews' : 'No Reviews' }}</p>
                <p>Price: Rs. {{ $product->product_price }}</p>
            </div>
        @endforeach
    </div>
</div>
<div class="footer">
    @include('Shared.Footer')
</div>
