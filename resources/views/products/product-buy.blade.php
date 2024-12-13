<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($product) ? $product->product_name : 'Product Not Found' }}</title>
    <link rel="stylesheet" href="{{ asset('css/user/product-buy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/review.css') }}">
</head>

<body>
    <div class="topnav">
        @include('shared.nav')
    </div>
    <div class="container">
        @if (isset($product))
            <div class="image-section">
                @if ($product->discounted_price > 0)
                    <div class="sale-badge">Sale!</div>
                @endif
                <img src="{{ asset('storage/images/products/' . $product->product_image) }}"
                    alt="{{ $product->product_name }}">
            </div>
            <div class="details-section">
                <h1 style="font-size: 30px">{{ $product->product_name }}</h1>
                <p class="price" style="font-size: 24px">
                    @if ($product->discounted_price > 0)
                        <del>Rs. {{ $product->product_price }}</del>
                        Rs. {{ $product->product_price - ($product->product_price * $product->discounted_price) / 100 }}
                        @if ($product->product_category == 'Fruit')
                            Per Kg
                        @endif
                    @else
                        Rs. {{ $product->product_price }}
                        @if ($product->product_category == 'Fruit')
                            Per Kg
                        @endif
                    @endif
                </p>
                <p class="description" style="font-size: 16px">{{ $product->product_short_description }}</p>
                <p class="availability" style="font-size: 16px">
                    Availability:
                    {{ $product->product_quantity }}{{ $product->product_category == 'Fruit' ? ' Per Kg' : '' }} in
                    stock
                </p>
                <div class="add-to-cart">
                    <form action="{{ route('user.cart.store', ['productId' => $product->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->product_quantity }}">

                        @if (Auth::check())
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <button type="submit">Add to Cart</button>
                        @else
                            <a href="{{ route('user.userlogin') }}">
                                <button type="button">Add to Cart</button>
                            </a>
                        @endif
                    </form>
                </div>

                <hr style="color: #333;">
                <p class="category">Category: {{ $product->product_category }}</p>
            </div>
        @else
            <h1>Product Not Found</h1>
            <p>Sorry, the product you are looking for does not exist.</p>
        @endif
    </div>
    <div class="review-section">
        <div class="tabs">
            <button class="tab active" onclick="showTab('description')">Description</button>
            <button class="tab" onclick="showTab('reviews')">
                Reviews ({{ $product->reviews->count() }})
            </button>
        </div>

        <div id="description" class="tab-content active">
            <h3>{{ $product->product_name }}</h3>
            <p>{{ $product->product_description }}</p>
        </div>

        <div id="reviews" class="tab-content">
            @if ($product->reviews->count() > 0)
                @foreach ($product->reviews as $review)
                    <div class="review">
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <span>★</span>
                                @else
                                    <span>☆</span>
                                @endif
                            @endfor
                        </div>
                        <p>{{ $review->comment }}</p>
                        <p>By {{ $review->user->username }} on {{ $review->created_at->format('d M, Y') }}</p>
                    </div>
                @endforeach
            @else
                <p>There are no reviews yet.</p>
            @endif

            <form class="review-form" action="{{ route('user.reviews.store', ['id' => $product->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @if ($product->reviews->count() == 0)
                    <h2>Be the first to review “{{ $product->product_name }}”</h2>
                @endif
                <label for="rating">Your rating *</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                </div>

                <label for="comment">Your review *</label>
                <textarea id="comment" name="comment" rows="4" placeholder="Write your review here..."></textarea>

                <button type="submit" class="submit-button">Submit</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showTab(tabName) {
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));

            document.getElementById(tabName).classList.add('active');
            const activeTab = document.querySelector(`button[onclick="showTab('${tabName}')"]`);
            activeTab.classList.add('active');
        }
    </script>

</body>

</html>
