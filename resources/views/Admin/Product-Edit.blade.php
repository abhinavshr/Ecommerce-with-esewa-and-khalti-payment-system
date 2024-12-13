<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Edit</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Add-Product.css') }}">
</head>

<body>
    <div class="container">
        <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Edit Product</h1>
            <table>
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="product_name" id="product_name" placeholder="{{ $errors->first('product_name') ? $errors->first('product_name') : 'Enter product name' }}" value="{{ old('product_name', $product->product_name) }}" style="{{ $errors->first('product_name') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Short Description:</td>
                    <td><input type="text" name="product_short_description" id="product_short_description" placeholder="{{ $errors->first('product_short_description') ? $errors->first('product_short_description') : 'Enter product short description' }}" value="{{ old('product_short_description', $product->product_short_description) }}" style="{{ $errors->first('product_short_description') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td><img src="{{ asset('storage/images/products/' . $product->product_image) }}" width="200px" height="200px" alt="{{ $product->product_name }}"><input type="file" name="product_image" id="product_image" placeholder="{{ $errors->first('product_image') ? $errors->first('product_image') : 'Enter product image' }}" style="{{ $errors->first('product_image') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td><input type="number" name="product_price" id="product_price" placeholder="{{ $errors->first('product_price') ? $errors->first('product_price') : 'Enter product price' }}" value="{{ old('product_price', $product->product_price) }}" style="{{ $errors->first('product_price') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td><input type="text" name="product_category" id="product_category" placeholder="{{ $errors->first('product_category') ? $errors->first('product_category') : 'Enter product category' }}" value="{{ old('product_category', $product->product_category) }}" style="{{ $errors->first('product_category') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Quantity:</td>
                    <td><input type="number" name="product_quantity" id="product_quantity" placeholder="{{ $errors->first('product_quantity') ? $errors->first('product_quantity') : 'Enter product quantity' }}" value="{{ old('product_quantity', $product->product_quantity) }}" style="{{ $errors->first('product_quantity') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Discount Percentage:</td>
                    <td><input type="number" name="discounted_price" id="discounted_price" placeholder="{{ $errors->first('discounted_price') ? $errors->first('discounted_price') : 'Enter discount percentage' }}" value="{{ old('discounted_price', $product->discounted_price) }}" style="{{ $errors->first('discounted_price') ? 'border-color: red;' : '' }}"></td>
                </tr>
                <tr>
                    <td>Product Status:</td>
                    <td>
                        <select name="product_status" id="productstatus" required>
                            <option value="" disabled>Select a status</option>
                            <option value="In-Stock" {{ old('product_status', $product->product_status) == 'In-Stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="Out-of-Stock" {{ old('product_status', $product->product_status) == 'Out-of-Stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td><textarea name="product_description" id="product_description" cols="40" rows="10" placeholder="{{ $errors->first('product_description') ? $errors->first('product_description') : 'Enter product description' }}">{{ old('product_description', $product->product_description) }}</textarea></td>
                </tr>
            </table>
            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>

