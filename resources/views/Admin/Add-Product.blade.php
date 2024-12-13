<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Add-Product.css') }}">
</head>

<body>
    <div class="container">
        <form action=" {{  route('addproduct.store') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Add Product</h1>
            <table>
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="product_name" id="product_name" placeholder="Enter product name" value="{{ old('product_name') }}"></td>
                    <td style="color:red;">{{ $errors->first('product_name') }}</td>
                </tr>
                <tr>
                    <td>Product Short Description:</td>
                    <td><input type="text" name="product_short_description" id="product_short_description" placeholder="Enter product short description" value="{{ old('product_short_description') }}"></td>
                    <td style="color:red;">{{ $errors->first('product_short_description') }}</td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td><input type="file" name="product_image" id="product_image" placeholder="Enter product image"></td>
                    <td style="color:red;">{{ $errors->first('product_image') }}</td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td><input type="number" name="product_price" id="product_price" placeholder="Enter product price" value="{{ old('product_price') }}"></td>
                    <td style="color:red;">{{ $errors->first('product_price') }}</td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td><input type="text" name="product_category" id="product_category" placeholder="Enter product category" value="{{ old('product_category') }}"></td>
                    <td style="color:red;">{{ $errors->first('product_category') }}</td>
                </tr>
                <tr>
                    <td>Product Quantity:</td>
                    <td><input type="number" name="product_quantity" id="product_quantity" placeholder="Enter product quantity" value="{{ old('product_quantity') }}"></td>
                    <td style="color:red;">{{ $errors->first('product_quantity') }}</td>
                </tr>
                <tr>
                    <td>Discount Percentage:</td>
                    <td><input type="number" name="discounted_price" id="discounted_price" placeholder="Enter discount percentage" value="{{ old('discounted_price') }}"></td>
                    <td style="color:red;">{{ $errors->first('discounted_price') }}</td>
                </tr>
                <tr>
                    <td>Product Status:</td>
                    <td>
                        <select name="product_status" id="productstatus" required>
                            <option value="" disabled selected>Select a status</option>
                            <option value="In-Stock" {{ old('product_status') == 'In-Stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="Out-of-Stock" {{ old('product_status') == 'Out-of-Stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </td>
                    <td style="color:red;">{{ $errors->first('product_status') }}</td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td><textarea name="product_description" id="product_description" cols="40" rows="10" placeholder="Enter product description">{{ old('product_description') }}</textarea></td>
                    <td style="color:red;">{{ $errors->first('product_description') }}</td>
                </tr>
            </table>
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>

</html>

