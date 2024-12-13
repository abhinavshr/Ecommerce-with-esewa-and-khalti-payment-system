<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Product.css') }}">
</head>
<body>
    @include('Admin.Admin-Nav')
    <div class="container">
        <div class="left">
            <h1 style=" margin-left: 1vw;">Product List</h1>
        </div>
        <div class="right">
            <a href="{{ route('addproduct') }}"><button class="add-button">Add Product</button></a>
        </div>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search Product..." class="search-barr">
    </div>
    <div class="product-list">
        @foreach($products as $product)
        <div class="product-card">
            <div class="product-image">
                <img src="{{ asset('storage/images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
            </div>
            <div class="product-details">
                <h2>{{ $product->product_name }}</h2>
                @if($product->product_quantity == 0)
                    <p style="color: red; font-weight: bold; font-size: larger;">Out of Stock</p>
                @else
                    <p>{{ $product->product_short_description }}</p>
                    <p>
                        Price:
                        @if($product->discounted_price > 0)
                            <span style="text-decoration: line-through; color: red;">Rs. {{ $product->product_price }} @if($product->product_category == 'Fruit') Per Kg @endif</span>
                            <span style="color: green;">Rs. {{ $product->product_price - ($product->product_price * $product->discounted_price / 100) }} @if($product->product_category == 'Fruit') Per Kg @endif ({{ $product->discounted_price }}% off)</span>
                        @else
                            Rs. {{ $product->product_price }} @if($product->product_category == 'Fruit') Per Kg @endif
                        @endif
                    </p>
                    <p>Quantity: {{ $product->product_quantity }}@if($product->product_category == 'Fruit') Kg @endif</p>
                    <p>Category: {{ $product->product_category }}</p>
                    <p>Product Seller: {{ $product->admin->name }}</p>
                @endif
            </div>
            <div class="product-actions">
                <a href="{{ route('product.edit', ['id' => $product->id]) }}"><button class="edit-button">Edit</button></a>
                <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
