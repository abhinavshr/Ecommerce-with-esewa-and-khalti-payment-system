<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop-ecommerce</title>
    <link rel="stylesheet" href="{{ asset('css/user/everything.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Nav/Side-Nav.css') }}">
</head>

<body>
    <div class="topnav-container">
        @include('Shared.Nav')
    </div>
    <div class="sidenav-container" style="display: flex;">
        <div class="sidenav">
            <div class="container">
                <form action=" {{ route('user.products.search') }}" method="GET">
                <input type="search" name="searchProduct" id="searchProduct" class="searchProduct"
                    placeholder="Search Product...">
                </form>
                <h2>Filter By Price</h2>
                <?php
                $maxPrice = \App\Models\Product::max('product_price');
                ?>
                <input type="range" id="priceSlider" min="0" max="{{ $maxPrice }}" step="10"
                    value="{{ $maxPrice }}" oninput="updatePrice(this.value)" class="slider"
                    oninput="updatePrice(this.value)" class="slider" />
                <div class="price-range">
                    <input type="text" id="minPrice" value="Rs 0" class="minPrice" readonly
                        style="border: none; background: transparent; font-size: 14px;" />
                    <input type="text" id="maxPrice" value="Rs {{ $maxPrice }}" class="maxPrice" readonly
                        style="border: none; background: transparent; font-size: 14px; text-align: right;" />
                </div>
                <div class="links">
                    <a href=" {{ route('user.fruit') }} ">Fruits
                        ({{ \App\Models\Product::where('product_category', 'Fruit')->count() }})</a><br>
                    <a href=" {{ route('user.drink') }} ">Juice
                        ({{ \App\Models\Product::where('product_category', 'Drink')->count() }})</a>
                    </ul>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div class="product-container" style="margin: auto;">
                        <?php
                        $product = \App\Models\Product::orderBy('discounted_price', 'desc')->first();
                        ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('storage/images/products/' . $product->product_image) }}"
                                    alt="{{ $product->product_name }}">
                            </div>
                            <div class="product-info">
                                <h2>{{ $product->product_name }}</h2>
                                <p>Price: Rs.
                                    {{ $product->discounted_price > 0 ? $product->product_price - ($product->product_price * $product->discounted_price) / 100 : $product->product_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <script>
                        function updatePrice(value) {
                            document.getElementById('maxPrice').value = `Rs ${value}`;
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="right">
            <h1 class="heading">Shop</h1>
            <div class="sorting">
                <form action="{{ route('user.everythingdisplay') }}" method="GET" style="float: right;">
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="Default" {{ request('sort') == 'Default' ? 'selected' : '' }}>Default
                            Sorting</option>
                        <option value="Latest" {{ request('sort') == 'Latest' ? 'selected' : '' }}>Latest</option>
                        <option value="PriceLow" {{ request('sort') == 'PriceLow' ? 'selected' : '' }}>Price: Low
                            to High</option>
                        <option value="PriceHigh" {{ request('sort') == 'PriceHigh' ? 'selected' : '' }}>Price:
                            High to Low</option>
                    </select>
                </form>

                @if ($products->count() > 0)
                    <div class="pagination-info" style="float: left;">
                        <p>
                            {{ __('Showing') }}
                            <span class="font-medium">{{ $products->firstItem() }}</span>
                            {{ __('to') }}
                            <span class="font-medium">{{ $products->lastItem() }}</span>
                            {{ __('of') }}
                            <span class="font-medium">{{ $products->total() }}</span>
                            {{ __('results') }}
                        </p>
                    </div>
                @endif
            </div>
            <div class="product-list">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <a href=" {{ route('user.product', ['id' => $product->id]) }} ">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('storage/images/products/' . $product->product_image) }}"
                                        alt="{{ $product->product_name }}">
                                </div>
                                <div class="product-details">
                                    <h2>{{ $product->product_name }}</h2>
                                    @if ($product->product_quantity == 0)
                                        <p style="color: red; font-weight: bold; font-size: larger;">Out of Stock</p>
                                    @else
                                        <p>{{ $product->product_short_description }}</p>
                                        <p>
                                            Price:
                                            @if ($product->discounted_price > 0)
                                                <span style="text-decoration: line-through; color: red;">Rs.
                                                    {{ $product->product_price }} @if ($product->product_category == 'Fruit')
                                                        Per Kg
                                                    @endif
                                                </span>
                                                <span style="color: green;">Rs.
                                                    {{ $product->product_price - ($product->product_price * $product->discounted_price) / 100 }}
                                                    @if ($product->product_category == 'Fruit')
                                                        Per Kg
                                                    @endif ({{ $product->discounted_price }}%
                                                    off)
                                                </span>
                                            @else
                                                Rs. {{ $product->product_price }} @if ($product->product_category == 'Fruit')
                                                    Per Kg
                                                @endif
                                            @endif
                                        </p>
                                        <p>Quantity: {{ $product->product_quantity }}@if ($product->product_category == 'Fruit')
                                                Kg
                                            @endif
                                        </p>
                                        <p>Category: {{ $product->product_category }}</p>
                                        <p>Product Seller: {{ $product->admin->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>No product found</p>
                @endif
            </div>
            <div class="custom-pagination">
                {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
            <div class="footer" >
                @include('Shared.Footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/search.js') }}"></script>
</body>

</html>
